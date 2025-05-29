<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades;

class AcountController extends Controller
{
    //
    public function show($id){

        $user = User::findOrfail($id);
        return view('acount/show',compact('user'));
        
    }

    public function edit($id){
        $user = User::findOrfail($id);
        return view('acount/edit',compact('user'));
    }

    public function update(Request $request, $id){

        $user = User::findOrfail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
       if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

        $user->save();
        return redirect()->route('acount/show')->with('success','ユーザー情報を更新しました');
    }
}
