<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class MainController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = \App\Models\Shop::with(['category','area'])->where('active', 1);

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

    $filename = null;

    if ($request->hasFile('filename')) {
        $filename = $request->file('filename')->store('shops', 'public');
        info('ファイルアップロード成功: ' . $filename);
    } else {
        info('ファイルアップロードなし');
    }

    $shop = Shop::create([
        'name' => $validated['name'],
        'information' => $validated['information'],
        'category_id' => $validated['category_id'],
        'area_id' => $validated['area_id'],
        'local' => $validated['local'],
        'on_off' => $validated['on_off'],
        'active' => $validated['active'],
        'owner_id' => Auth::id(),
        // 'filename' => $filename, ← 不要なら削除
    ]);


    if ($filename) {
        Image::create([
            'shop_id' => $shop->id,
            'filename' => $filename,
            'title' => $shop->name
        ]);
    }

    return redirect()->route('main.index')->with('success', '店舗を登録しました。');
}
}