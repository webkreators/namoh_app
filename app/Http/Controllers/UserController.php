<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function list(Request $request) {
        $query = DB::table('login');
        if ($request->filled('squery')) $query = $query->where('login.company_name', 'like', '%'.$request->squery.'%')->orWhere('login.company_mobile', 'like', '%'.$request->squery.'%');
        $users_count = $query->count();
        $type = $request->type;
        $users = $query->paginate(env('ITEMS_PER_PAGE'));
        return view('admin.users.list', compact('users', 'users_count', 'type'));
    }

    public function addUser(Request $request) {
        return view('admin.users.add');
    }

    public function create(Request $request) {
        User::create($request->all());
        Session::flash('alert', 'User has been added successfully!');
        return redirect(route('users'));
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $params = $request->all();
        if ($request->filled('password')) {
            $params['password'] = Hash::make($request->password);
        } else {
            unset($params['password']);
        }
        Session::flash('alert', 'User has been updated successfully!');
        $user->update($params);
        return redirect(route('users'));
    }

    public function delete(Request $request, $id) {
        User::find($id)->delete();
        Session::flash('alert', 'User has been deleted successfully!');
        return redirect(route('users'));
    }
}
