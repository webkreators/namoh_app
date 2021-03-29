<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Service;
use App\Models\TaxSlab;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function list(Request $request) {
        $filters = $request->all();
        $query = DB::table('invoice')->join('customer', 'invoice.client_id', '=', 'customer.client_id');
        if ($request->filled('client_params')) $query = $query->where('customer.customer_name', 'like', '%'.$request->client_params.'%')->orWhere('customer.customer_contact_number', 'like', '%'.$request->client_params.'%')->orWhere('customer.customer_email', 'like', '%'.$request->client_params.'%');
        if ($request->filled('paid_unpaid')) $query = $query->where('invoice.paid_unpaid', $request->paid_unpaid == 'unpaid' ? 0 : 1);
        $invoices_count = $query->count();
        $invoices = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.invoices.list', compact('invoices', 'invoices_count', 'filters'));
    }
    
    public function create(Request $request) {
        $customers = Customer::all();
        $services = Service::all();
        $tax_slabs = TaxSlab::all();
        $now = \Carbon\Carbon::now();
        $start = 1;
        $invoice = Invoice::where(array('status' => 0, 'invoice_type' => 1))->latest()->first();
        if ($now->month > 3) {
            $year = $now->format('y')."-".($now->format('y') + 1);
        } else {
            $year = ($now->format('y') - 1)."-".$now->format('y');
        }
        if ($invoice != null) $start = $invoice->invoice_no + 1;
        $invoice_number = "NNUDR/{$year}/{$start}";
        $financial_year = "NNUDR/{$year}";
        $invoice_no = $start;
        return view('admin.invoices.add', compact('customers', 'services', 'tax_slabs', 'invoice_number', 'financial_year', 'invoice_no'));
    }

    public function store(Request $request) {
        $params = $request->only('client_id', 'total_amount', 'remarks', 'tax_slab', 'invoice_date', 'connection_date', 'start_date', 'end_date', 
        'financial_year', 'invoice_no', 'grand_total', 'discount', 'service_time', 'paid_unpaid');
        $tax_slab = TaxSlab::find($request->tax_slab);
        $params['CGST'] = $params['SGST'] = $tax_slab->tax_per / 2;
        $params['tax_per'] = $tax_slab->tax_per;
        $params['bank_id'] = $params['invoice_type'] = 1;
        $params['router_free'] = $params['bill_type'] = 0;
        $params['payment_comment'] = '-';
        if ($params['discount'] != 0) $params['discount_in'] = 1;
        foreach (array('connection_date', 'invoice_date', 'start_date', 'end_date') as $date) {
            $params[$date] = Carbon::CreateFromFormat('d/m/Y', $params[$date])->format('Y-m-d');
        }
        if ($params['service_time'] == 2) $params['router_free'] = 1;
        $invoice = Invoice::create($params);
        # Creating invoice items
        $iterator = new \MultipleIterator();
		$iterator->attachIterator(new \ArrayIterator($request->item_id));
		$iterator->attachIterator(new \ArrayIterator($request->item_price));
        foreach ($iterator as $item) {
            InvoiceDetail::create(array(
                'invoice_no' => $invoice->invoice_no,
                'insert_id' => $invoice->invoice_id,
                'goods_id' => $item[0],
                'goods_amount' => $item[1],
                'invoice_date' => $params['invoice_date']
            ));
        }
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
}
