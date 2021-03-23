<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    
    public function list(Request $request) {
        
        return view('admin.services.list');
    }
    
    public function addServices(Request $request){
        $services = DB::table('services')->get();
        return view('admin.services.add', compact('services'));
    }
}
