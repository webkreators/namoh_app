<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;

class OperatorController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('operators')->orderBy('company_name', 'asc');
        if ($request->filled('squery')) $query = $query->where('operators.company_name', 'like', '%'.$request->squery.'%')
            ->orWhere('operator_name', 'like', '%'.$request->squery.'%');
        $count = $query->count();
        $type = $request->type;
        $operators = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin/operators/list', compact('operators', 'count', 'type'));
    }
    
    public function addCustomer(Request $request) {
        return view('admin/operators/add');
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
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|unique:operators|max:255',
            'operator_name' => 'required',
            'contact_number' => 'required',
            'secondary_number' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'aadhaar_number' => 'required',
            'licence' => 'required',
            'agreement' => 'required',
            'gstin_number' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $request->all();
        if ($request->filled('dob')) $params['dob'] = Carbon::CreateFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $operator = Operator::create($params);
        $this->uploadFiles($request, $operator);
        Session::flash('alert', 'Operator has been added successfully!');
        return redirect(route('operators'));
    }
    
    private function uploadFiles(Request $request, $operator) {
        if ($request->hasFile('licence')) {
            $fileName = time() . '_' . $request->licence->getClientOriginalName();
            $request->file('licence')->storeAs('uploads', $fileName, 'public');
            $licenceFile = "public/uploads/{$fileName}";
            $operator->licence = $licenceFile;
        }
        if ($request->hasFile('agreement')) {
            $fileName = time() . '_' . $request->agreement->getClientOriginalName();
            $request->file('agreement')->storeAs('uploads', $fileName, 'public');
            $agreementFile = "public/uploads/{$fileName}";
            $operator->agreement = $agreementFile;
        }
        $operator->update();
    }
    
    public function downloadFile(Request $request) {
        return Storage::download($request->path);
    }
    
    public function edit(Request $request, $id) {
        $operator = Operator::find($id);
        return view('admin/operators/edit', compact('operator'));
    }
    
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|unique:operators,id,' . $id,
            'operator_name' => 'required',
            'contact_number' => 'required',
            'secondary_number' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'aadhaar_number' => 'required',
            'gstin_number' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $operator = Operator::find($id);
        $params = $request->all();
        if ($request->filled('dob')) $params['dob'] = Carbon::CreateFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $operator->update($params);
        $this->uploadFiles($request, $operator);
        Session::flash('alert', 'Operator has been updated successfully!');
        return redirect(route('operators'));
    }
    
    public function delete(Request $request, $id) {
        Customer::find($id)->delete();
        Session::flash('alert', 'Customer has been deleted successfully!');
        return redirect(route('customers'));
    }
}
