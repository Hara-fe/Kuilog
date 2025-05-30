<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class SearchController extends Controller
{
    public function index()
    {
        $shops = collect(); // 空のコレクションを渡す

        return view('search.index', compact('shops'));
    }

    public function result(Request $request)
    {
        $query = Shop::query()->with('area', 'category');

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->input('area_id'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('rating')) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->havingRaw('AVG(review) >= ?', [$request->input('rating')]);
            });
        }

        $shops = $query->get();

        return view('search.result', compact('shops'));
    }
}
