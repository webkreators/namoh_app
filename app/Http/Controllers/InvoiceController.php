<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function list(Request $request) {
        
        return view('admin.invoices.list');
    }
    
    public function addInvoices(Request $request){
        $invoices = DB::table('invoice')->get();
        return view('admin.invoices.add', compact('invoices'));
    }
}
