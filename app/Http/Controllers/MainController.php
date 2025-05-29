<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades;
use App\Models\Shop;

class MainController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = \App\Models\Shop::with('category')->where('active', 1);

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $shops = $query->paginate(10);

        return view('main.index', compact('shops'));
    }

   public function create()
{
    return view('main.create'); // 作成フォーム
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'information' => 'required|string',
        'filename' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'category_id' => 'required|exists:categories,id',
        'area_id' => 'required|integer',
        'local' => 'required|string|max:255',
        'on_off' => 'required|boolean',
        'active' => 'required|in:0,1',
    ]);

    if ($request->hasFile('filename')) {
        $path = $request->file('filename')->store('images', 'public');
        $validated['filename'] = basename($path);
    } else {
        $validated['filename'] = '';
    }

    $validated['owner_id'] = Auth::id();

    Shop::create($validated);

    return redirect()->route('main.index')->with('success', '店舗を登録しました。');
}
}