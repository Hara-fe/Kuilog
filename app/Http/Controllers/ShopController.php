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
        $shop = Shop::with('category')->findOrFail($id);
        return view('shop.show', compact('shop'));
    }

    public function edit(){ //お店の情報を編集

    }
    
    public function update(){ //編集の確認画面＋DBに送信

    }

    public function seeing(){ //口コミ閲覧

    }
}
