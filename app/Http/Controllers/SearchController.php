<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();
        $categories = Category::all();

        $query = Shop::with(['area', 'category', 'reviews'])->where('active', 1);

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->area_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('rating')) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->selectRaw('AVG(review) as avg_rating')
                  ->groupBy('shop_id')
                  ->havingRaw('AVG(review) >= ?', [$request->rating]);
            });
        }

        $shops = $query->get();

        return view('search.index', compact('shops', 'areas', 'categories'));
    }
    public function result(Request $request)
    {
        $query = Shop::query()->with(['area', 'category'])
            ->withAvg('reviews', 'review');

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->input('area_id'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('rating')) {
            $query->having('reviews_avg_review', '>=', $request->input('rating')); // ★ havingはwithAvgに対して使える
        }

        $shops = $query->get();

        return view('search.result', compact('shops'));
    }

}
