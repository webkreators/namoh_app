<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('services');
        if ($request->filled('squery')) $query = $query->where('product_name', 'like', '%'.$request->squery.'%');
        $services_count = $query->count();
        $services = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.services.list', compact('services', 'services_count'));
    }
    
    public function create(Request $request) {
        return view('admin.services.add');
    }

    public function edit(Request $request, $id) {
        $service = Service::find($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id) {
        $service = Service::find($id);
        $service->update($request->all());
        Session::flash('alert', 'Service has been updated successfully!');
        return redirect(route('services'));
    }

    public function store(Request $request) {
        Service::create($request->all());
        Session::flash('alert', 'Service has been added successfully!');
        return redirect(route('services'));
    }

    public function destroy(Request $request, $id) {
        Service::find($id)->delete();
        Session::flash('alert', 'Service has been deleted successfully!');
        return redirect(route('services'));
    }
}
