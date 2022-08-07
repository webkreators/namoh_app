<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;

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
        $operators = Operator::all();
        return view('admin.customers.add', compact('operators'));
    }
    
    public function importCustomers(Request $request) {
      return view('admin.customers.import');
    }
  
    public function processImport(Request $request) {
      if ($request->hasFile('customers')) {
        $fileName = time() . '_' . $request->customers->getClientOriginalName();
        $request->file('customers')->storeAs('uploads', $fileName, 'public');
        $file = storage_path("app/public/uploads/{$fileName}");
        $rows = SimpleExcelReader::create($file)->getRows();
        $rows->each(function(array $rowProperties) {
          if (!Customer::where('customer_email', $rowProperties['ClientID'])->exists()) {
            Customer::create([
              'customer_email' => $rowProperties['ClientID'],
              'customer_name' => $rowProperties['ClientName/FirmName'],
              'customer_address' => $rowProperties['Address'],
              'customer_contact_number' => (string)$rowProperties['ContactNoOne'],
              'contact_number_two' => (string)$rowProperties['WhatsappNumber'],
              'gstin_no' => $rowProperties['GSTINNumber'],
              'connection_date' => $rowProperties['ConnectionDate'],
              'static_ip' => $rowProperties['StaticIP'],
              'aadhar_no' => (string)$rowProperties['AadharNumber']
            ]);
          }
        });
        return back()->with('alert', 'Customers have been imported.');
      } else {
        return back()->with('error', 'Please choose file to import customers');
      }
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
        $operators = Operator::all();
        return view('admin.customers.edit', compact('customer', 'operators'));
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
