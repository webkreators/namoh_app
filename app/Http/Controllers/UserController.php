<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('users');
        if ($request->filled('squery')) $query = $query->where('users.company_name', 'like', '%'.$request->squery.'%')->orWhere('users.company_mobile', 'like', '%'.$request->squery.'%');
        $users_count = $query->count();
        $user_details = $query->orderBy('users.id', 'DESC')->get();
        $type = $request->type;
        $users = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.users.list', compact('users', 'users_count', 'type'));
    }
}
