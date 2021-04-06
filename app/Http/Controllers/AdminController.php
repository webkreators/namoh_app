<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Service;
use App\User;
use App\Order;
use App\Permission;
use App\WidgetRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class AdminController extends Controller
{
    public function dashboard(Request $request) {
        $customer_counts = Customer::count();
        return view('admin.dashboard', compact('customer_counts'));
    }

    public function settings(Request $request) {
        $bank_details = DB::table('bank_details')->first();
        return view('admin.settings', compact('bank_details'));
    }

    public function updateSettings(Request $request) {
        DB::table('bank_details')->where('bank_id', 1)->update($request->only('beneficiary_name', 'bank_name', 'account_no', 'branch', 'ifsc_code'));
        return redirect(route('settings'));
    }
}
