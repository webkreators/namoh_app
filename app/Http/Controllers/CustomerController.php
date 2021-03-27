<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
  public function list(Request $request) {
    $query = DB::table('customers');
    if ($request->filled('squery')) $query = $query->where('customers.customer_name', 'like', '%'.$request->squery.'%')->orWhere('customers.customer_contact_number', 'like', '%'.$request->squery.'%');
    $customer_count = $query->count();
    $customer_details = $query->orderBy('customers.id', 'DESC')->get();
    $type = $request->type;
    $customers = $query->paginate(env('ITEMS_PER_PAGE'));
    return view('admin.customers.list', compact('customers', 'customer_count', 'type'));
  }
  public function addCustomer(Request $request) {
    return view('admin.customers.add');
  }

  public function create(Request $request) {
    Customer::create($request->all());
    return redirect(route('customers'));
  }

  public function edit(Request $request, $id) {
    $customer = Customer::find($id);
    return view('admin.customers.edit', compact('customer'));
  }

  public function update(Request $request, $id) {
    $customer = Customer::find($id);
    $params = $request->all();
    $customer->update($params);
    return redirect(route('customers'));
  }

  public function delete(Request $request, $id) {
    Customer::find($id)->delete();
    return redirect(route('customers'));
  }
}
