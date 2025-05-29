<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AcountController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('acount.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('acount.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('acount.show', ['id' => $user->id])
                         ->with('success', 'ユーザー情報を更新しました');
    }
}
