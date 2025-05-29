<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades;
use App\Http\Models\User;

class RegisterController extends Controller
{
    //
    public function create(){
        
        //アカウント登録　フォームに送る
        return view('register');
    }

    public function store(Request $request){

        $name = $request -> input('name');
        $email = $request -> input('email');
        $password = $request -> input('password');
        $role = $request -> input('role');

        return redirect()->route('register.complete');
    }
}
