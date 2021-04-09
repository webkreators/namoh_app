<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('customer')->orderBy('customer_name', 'asc');
        if ($request->filled('squery')) $query = $query->where('customer.customer_name', 'like', '%'.$request->squery.'%')->orWhere('customer.customer_contact_number', 'like', '%'.$request->squery.'%')->orWhere('customer.customer_email', 'like', '%'.$request->squery.'%');
        $customer_count = $query->count();
        $type = $request->type;
        $customers = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.customers.list', compact('customers', 'customer_count', 'type'));
    }
    
    public function addCustomer(Request $request) {
        return view('admin.customers.add');
    }
    
    public function create(Request $request) {
        $params = $request->all();
        if ($request->filled('connection_date')) $params['connection_date'] = Carbon::CreateFromFormat('d/m/Y', $request->connection_date)->format('Y-m-d');
        if ($request->filled('anniversary_date')) $params['anniversary_date'] = Carbon::CreateFromFormat('d/m/Y', $request->anniversary_date)->format('Y-m-d');
        if ($request->filled('dob')) $params['dob'] = Carbon::CreateFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        Customer::create($params);
        Session::flash('alert', 'Customer has been added successfully!');
        return redirect(route('customers'));
    }
    
    public function edit(Request $request, $id) {
        $customer = Customer::find($id);
        return view('admin.customers.edit', compact('customer'));
    }
    
    public function update(Request $request, $id) {
        $customer = Customer::find($id);
        $params = $request->all();
        if ($request->filled('connection_date')) $params['connection_date'] = Carbon::CreateFromFormat('d/m/Y', $request->connection_date)->format('Y-m-d');
        if ($request->filled('anniversary_date')) $params['anniversary_date'] = Carbon::CreateFromFormat('d/m/Y', $request->anniversary_date)->format('Y-m-d');
        if ($request->filled('dob')) $params['dob'] = Carbon::CreateFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $customer->update($params);
        Session::flash('alert', 'Customer has been updated successfully!');
        return redirect(route('customers'));
    }
    
    public function delete(Request $request, $id) {
        Customer::find($id)->delete();
        Session::flash('alert', 'Customer has been deleted successfully!');
        return redirect(route('customers'));
    }
}
