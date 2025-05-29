<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;

class ReviewController extends Controller
{
    public function create($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        return view('review.review', compact('shop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|numeric|min:0|max:5',
            'comment' => 'nullable|string|max:1000',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->input('shop_id'),
            'review' => $request->input('review'),
            'comment' => $request->input('comment'),
        ]);

        $shop = Shop::find($review->shop_id);

        return view('review.review_complete', compact('shop'));
    }

}
