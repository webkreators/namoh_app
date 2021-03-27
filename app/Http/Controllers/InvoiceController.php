<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Service;
use App\Models\TaxSlab;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('invoices')->join('customers', 'invoices.client_id', '=', 'customers.id');
        if ($request->filled('client_name')) $query = $query->where('customers.customer_name', 'like', '%'.$request->squery.'%');
        $invoices_count = $query->count();
        $invoices = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.invoices.list', compact('invoices', 'invoices_count'));
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
        return view('admin.invoices.add', compact('customers', 'services', 'tax_slabs', 'invoice_number'));
    }

    public function store(Request $request) {
        $params = $request->only('client_id', 'total_amount', 'remarks', 'tax_slab', 'tax_per', 'invoice_date', 'connection_date', 'invoice_no', 'grand_total', 'discount_in', 'discount', 'service_time', 'router_free', 'start_date', 'end_date', 'bank_id', 'paid_unpaid', 'financial_year', 'invoice_type');
        $params['CGST'] = 
        Invoice::create($params);
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
