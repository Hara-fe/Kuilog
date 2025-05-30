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
use App\Models\Area;

class ShopController extends Controller
{
    //
    public function show($id)
    {
        $shop = Shop::with('images','reviews.user')->findOrFail($id);
        return view('shop.show', compact('shop'));
    }


    public function edit($id)
{
    $shop = Shop::findOrFail($id);
    $areas = Area::all();
    return view('shop.edit', compact('shop','areas'));
}

   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'information' => 'required|string',
        'area_id' => 'required|exists:areas,id',
    ]);

    $shop = Shop::findOrFail($id);

    $shop->name = $request->input('name');
    $shop->information = $request->input('information');
    $shop->area_id = $request->input('area_id');
    $shop->active = $request->has('active') ? 1 : 0;

    $shop->save();

    return redirect()->route('shop.show', ['id' => $shop->id])
        ->with('success', '店舗情報を更新しました。');
}
}
