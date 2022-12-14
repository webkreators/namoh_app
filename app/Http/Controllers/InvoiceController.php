<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Service;
use App\Models\TaxSlab;
use App\Models\Invoice;
use App\Models\User;
use App\Models\InvoiceDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    public function list(Request $request) {
        $filters = array_merge(['operator_id' => ''], $request->all());
        $query = DB::table('invoice')->select('invoice.*', 'customer.customer_email', 'customer.customer_name', 'customer.customer_contact_number', 'customer.customer_address')->join('customer', 'invoice.client_id', '=', 'customer.client_id')->orderBy('invoice_id', 'DESC');
        if ($request->filled('client_params')) $query = $query->where('customer.customer_name', 'like', '%'.$request->client_params.'%')->orWhere('customer.customer_contact_number', 'like', '%'.$request->client_params.'%')->orWhere('customer.customer_email', 'like', '%'.$request->client_params.'%');
        if ($request->filled('paid_unpaid')) $query = $query->where('invoice.paid_unpaid', $request->paid_unpaid == 'unpaid' ? 0 : 1);
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query = $query->whereDate('invoice.invoice_date', ">=", Carbon::createFromFormat('d/m/Y', $request->date_from)->format('Y-m-d'));
            $query = $query->whereDate('invoice.invoice_date', "<=", Carbon::createFromFormat('d/m/Y', $request->date_to)->format('Y-m-d'));
        }
        if ($request->filled('operator_id')) {
            $query = $query->where('customer.operator_id', $request->operator_id);
        }
        if ($request->excel_export == 1) {
            $file = fopen(public_path("csv_files/invoices.csv"), "w");
            fputcsv($file, array('Invoice#', 'Client#', 'Payment Status', 'Client Name', 'Grand Total', 'Valid From', 'Valid Till', 'Connection Date', 'Mobile', 'Address', 'Remarks'));
            $invoices = $query->get();
            foreach ($invoices as $invoice) {
                fputcsv($file, array(
                    $invoice->invoice_id,
                    $invoice->customer_email,
                    $invoice->paid_unpaid == 0 ? 'Unpaid' : 'Paid',
                    $invoice->customer_name,
                    number_format($invoice->grand_total, 2),
                    $invoice->start_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->start_date)->format('d/m/Y') : '-',
                    $invoice->end_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->end_date)->format('d/m/Y') : '-',
                    $invoice->connection_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->connection_date)->format('d/m/Y') : '-',
                    $invoice->customer_contact_number,
                    $invoice->customer_address,
                    $invoice->remarks
                ));
            }
            fclose($file);
            return response()->download(public_path("csv_files/invoices.csv"))->deleteFileAfterSend(true);
        } else {
            $operators = Operator::all();
            $pay_1 = clone $query;
            $pay_2 = clone $query;
            $invoices_count = $query->count();
            $invoices = $query->paginate(env('ITEMS_PER_PAGE'));
            $paid_amount = $pay_1->where('paid_unpaid', 1)->sum('grand_total');
            $math = 100 + 18;
            $unpaid_amount = $pay_2->where('paid_unpaid', 0)->sum('grand_total');
            $gross_amount = ($paid_amount + $unpaid_amount) * 100 / $math;
            $gst_amt = $gross_amount * 18 / 100;
            return view('admin.invoices.list', compact('invoices', 'invoices_count', 'filters', 'paid_amount', 'unpaid_amount', 'gross_amount', 'gst_amt', 'operators'));
        }
    }
    
    public function create(Request $request) {
        $customers = Customer::all();
        $services = Service::all();
        $tax_slabs = TaxSlab::all();
        $now = \Carbon\Carbon::now();
        $start = 982;
        $invoice = Invoice::where(array('status' => 0, 'invoice_type' => 1))->orderBy('invoice_id', 'desc')->limit(1)->first();
        if ($now->month > 3) {
            $year = $now->format('y')."-".($now->format('y') + 1);
        } else {
            $year = ($now->format('y') - 1)."-".$now->format('y');
        }
        if ($invoice != null) $start = $invoice->invoice_no + 1;
        $invoice_number = "NNUPL/{$year}/{$start}";
        $financial_year = "NNUPL/{$year}/";
        $invoice_no = $start;
        return view('admin.invoices.add', compact('customers', 'services', 'tax_slabs', 'invoice_number', 'financial_year', 'invoice_no'));
    }
    
    public function store(Request $request) {
        $params = $request->only('client_id', 'total_amount', 'remarks', 'tax_slab', 'invoice_date', 'connection_date', 'start_date', 'end_date', 
        'financial_year', 'invoice_no', 'grand_total', 'discount', 'service_time', 'paid_unpaid', 'discount_in');
        $tax_slab = TaxSlab::find($request->tax_slab);
        $params['CGST'] = $params['SGST'] = $tax_slab->tax_per / 2;
        $params['tax_per'] = $tax_slab->tax_per;
        $params['bank_id'] = $params['invoice_type'] = 1;
        $params['router_free'] = $params['bill_type'] = 0;
        $params['payment_comment'] = '-';
        foreach (array('connection_date', 'invoice_date', 'start_date', 'end_date') as $date) {
            $params[$date] = Carbon::CreateFromFormat('d/m/Y', $params[$date])->format('Y-m-d');
        }
        if ($params['service_time'] == 2) $params['router_free'] = 1;
        if (!$request->filled('remarks')) $params['remarks'] = '';
        $invoice = Invoice::create($params);
        # Creating invoice items
        for ($i = 0; $i < $request->no_items; $i++) {
            InvoiceDetail::create(array(
                'invoice_no' => $invoice->invoice_no,
                'insert_id' => $invoice->invoice_id,
                'goods_id' => $request->{"item_id_{$i}"},
                'goods_amount' => $request->{"item_price_{$i}"},
                'invoice_date' => $params['invoice_date']
            ));
        }
        Session::flash('alert', 'Invoice has been added successfully!');
        return redirect(route('invoices'));
    }
    
    public function edit(Request $request, $id) {
        $invoice = Invoice::find($id);
        $customers = Customer::all();
        $tax_slabs = TaxSlab::all();
        $services = Service::all();
        return view('admin.invoices.edit', compact('invoice', 'customers', 'tax_slabs', 'services'));
    }
    
    public function update(Request $request, $id) {
        $params = $request->only('client_id', 'total_amount', 'remarks', 'tax_slab', 'invoice_date', 'connection_date', 'start_date', 'end_date', 
        'financial_year', 'invoice_no', 'grand_total', 'discount', 'service_time', 'paid_unpaid', 'discount_in');
        $tax_slab = TaxSlab::find($request->tax_slab);
        $params['CGST'] = $params['SGST'] = $tax_slab->tax_per / 2;
        $params['tax_per'] = $tax_slab->tax_per;
        $params['bank_id'] = $params['invoice_type'] = 1;
        $params['router_free'] = $params['bill_type'] = 0;
        $params['payment_comment'] = '-';
        foreach (array('connection_date', 'invoice_date', 'start_date', 'end_date') as $date) {
            $params[$date] = Carbon::CreateFromFormat('d/m/Y', $params[$date])->format('Y-m-d');
        }
        if ($params['service_time'] == 2) $params['router_free'] = 1;
        if (!$request->filled('remarks')) $params['remarks'] = '';
        $invoice = Invoice::find($id);
        $invoice->update($params);
        $invoice->items()->delete();
        # Creating invoice items
        for ($i = 0; $i < $request->no_items; $i++) {
            InvoiceDetail::create(array(
                'invoice_no' => $invoice->invoice_no,
                'insert_id' => $invoice->invoice_id,
                'goods_id' => $request->{"item_id_{$i}"},
                'goods_amount' => $request->{"item_price_{$i}"},
                'invoice_date' => $params['invoice_date']
            ));
        }
        Session::flash('alert', 'Invoice has been updated successfully!');
        return redirect(route('invoices'));
    }
    
    public function getConnectionStartEndDates(Request $request) {
        $plan = $request->plan;
        $invoice_date = $request->invoice_date;
        if ($plan == 1) {
            $date = strtotime($invoice_date);
            $end_date = Carbon::CreateFromFormat('d/m/Y', $invoice_date)->add(30, 'days')->format('d/m/Y');
        } else if ($plan == 2) {
            $date = strtotime($invoice_date);
            $end_date = Carbon::CreateFromFormat('d/m/Y', $invoice_date)->addYear()->format('d/m/Y');
        } else if ($plan == 3) {
            $date = strtotime($invoice_date);
            $end_date = Carbon::CreateFromFormat('d/m/Y', $invoice_date)->add(90, 'days')->format('d/m/Y');
        } else if ($plan == 4) {
            $date = strtotime($invoice_date);
            $end_date = Carbon::CreateFromFormat('d/m/Y', $invoice_date)->add(180, 'days')->format('d/m/Y');
        } else if ($plan == 5) {
            $date = strtotime($invoice_date);
            $end_date = Carbon::CreateFromFormat('d/m/Y', $invoice_date)->addYears(2)->format('d/m/Y');
        }
        return response()->json(array('start_date' => $invoice_date, 'end_date' => $end_date));
    }
    
    public function generateBulkInvoices(Request $request) {
        $filters = $request->all();
        $query = Invoice::orderBy('invoice_id', 'DESC');
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query = $query->whereDate('invoice.invoice_date', ">=", Carbon::createFromFormat('d/m/Y', $request->date_from)->format('Y-m-d'));
            $query = $query->whereDate('invoice.invoice_date', "<=", Carbon::createFromFormat('d/m/Y', $request->date_to)->format('Y-m-d'));
        }
        $invoices = $query->get();
        $user = User::find(1);
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'mode' => 'c', 'tempDir' => storage_path('tempdir')]);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        foreach ($invoices as $key => $invoice) {
            $amount_after_discount = $invoice->total_amount;
            $type = '';
            if ($invoice->discount > 0) {
                if ($invoice->discount_in == 1) {
                    $type = "%";
                    $rupee = $invoice->total_amount * $invoice->dicscount / 100;
                    $amount_after_discount = $invoice->total_amount - $rupee;
                } else if ($invoice->discount_in == 2) {
                    $type = "Rupee";
                    $amount_after_discount = $invoice->total_amount - $invoice->discount;
                }
            }
            $number = $invoice->grand_total;
            $no = round($number);
            $point = round($number - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array('0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety');
            $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
            while ($i < $digits_1) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str [] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred;
                } else $str[] = null;
            }
            $str = array_reverse($str);
            $in_words = implode('', $str);
            $terms = DB::table('terms_condition')->get();
            $bank_details = Db::table('bank_details')->first();
            #return view('admin.invoices.invoice')->with(compact('invoice', 'user', 'amount_after_discount', 'type', 'in_words', 'terms', 'bank_details'));
            $html = view('admin.invoices.invoice')->with(compact('invoice', 'user', 'amount_after_discount', 'type', 'in_words', 'terms', 'bank_details'))->render();
            $mpdf->WriteHTML($html);
            if ($key != count($invoices) - 1) $mpdf->AddPage('P', '', '', '', '', 5, 5, 5, 5, 10, 10);
        }
        $mpdf->Output();
    }
    
    public function generateInvoice(Request $request, $id) {
        $invoice = Invoice::find($id);
        $user = User::find(1);
        $amount_after_discount = $invoice->total_amount;
        $type = '';
        if ($invoice->discount > 0) {
            if ($invoice->discount_in == 1) {
                $type = "%";
                $rupee = $invoice->total_amount * $invoice->dicscount / 100;
                $amount_after_discount = $invoice->total_amount - $rupee;
            } else if ($invoice->discount_in == 2) {
                $type = "Rupee";
                $amount_after_discount = $invoice->total_amount - $invoice->discount;
            }
        }
        $number = $invoice->grand_total;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy',
        '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $in_words = implode('', $str);
        $terms = DB::table('terms_condition')->get();
        $bank_details = Db::table('bank_details')->first();
        #return view('admin.invoices.invoice')->with(compact('invoice', 'user', 'amount_after_discount', 'type', 'in_words', 'terms', 'bank_details'));
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'mode' => 'c', 'tempDir' => storage_path('tempdir')]);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $html = view('admin.invoices.invoice')->with(compact('invoice', 'user', 'amount_after_discount', 'type', 'in_words', 'terms', 'bank_details'))->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output(str_replace(" ", "_", $invoice->customer->customer_name) . "_" . $invoice->invoice_no . '.pdf', 'I');
    }
    
    public function delete(Request $request, $id) {
        Invoice::find($id)->delete();
        Session::flash('alert', 'Invoice has been deleted successfully!');
        return redirect(route('invoices'));
    }

    public function getInvoicePaymentMeta(Request $request, $id) {
        $invoice = Invoice::find($id);
        $html = view('admin.modals.invoice-status')->with(compact('invoice'))->render();
        return response()->json(array('html' => $html));
    }

    public function updateInvoicePaymentMeta(Request $request, $id) {
        $invoice = Invoice::find($id);
        $invoice->paid_unpaid = $request->paid_unpaid;
        $invoice->payment_comment = $request->payment_comment;
        $invoice->update();
        return response()->json(array('status' => 'success'));
    }
}
