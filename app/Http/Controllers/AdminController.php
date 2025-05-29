<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.admin',compact('users'));
    }


    public function edit(string $id){

        $user = User::findorFail($id);
        return view('admin.admin_edit',compact('user'));
    }

    
    public function update(Request $request,string $id){

        $user = User::findOrfail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
       if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

        $user->save();

        return redirect()->route('admin.index')->with('success','ユーザー情報を更新しました');
    }
}
