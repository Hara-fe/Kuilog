<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades;
use App\Http\Models\User;
use App\Models\Shop;
use App\Models\Review;

class ShopController extends Controller
{
    //
    public function show($id)
    {
        $shop = Shop::with('reviews.user')->findOrFail($id);
        return view('shop.show', compact('shop'));
    }


    public function edit($id)
{
    $shop = Shop::findOrFail($id);
    return view('shop.edit', compact('shop'));
}

    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        $shop->name = $request->input('name');
        $shop->information = $request->input('information');
        $shop->active = $request->input('active'); // ←追加

        $shop->save();

        return redirect()->route('shop.show', ['id' => $shop->id])->with('success', '店舗情報を更新しました。');
    }
}
