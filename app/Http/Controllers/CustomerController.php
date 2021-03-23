<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('customers');
        if ($request->filled('squery')) $query = $query->where('users.customer_name', 'like', '%'.$request->squery.'%')->orWhere('users.customer_contact_number', 'like', '%'.$request->squery.'%');
        $users_count = $query->count();
        $user_details = $query->orderBy('customers.id', 'DESC')->get();
        $type = $request->type;
        $customers = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.customers.list', compact('customers', 'users_count', 'type'));
    }
    public function addCustomer(Request $request)
    {
        return view('admin.customers.add');
    }
}
