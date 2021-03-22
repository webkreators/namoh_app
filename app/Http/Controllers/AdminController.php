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
        return view('admin.settings');
    }
}
