<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades;
use App\Http\Models\User;
use App\Http\Models\Shop;
use App\Models\Review;

class ReviewController extends Controller
{
    //
    public function create(){
        return view('review.review');
    }

    public function store(Request $request){

        $review = $request -> input('review');
        $comment = $request -> input('comment');
        
        Review::store([
        'review' => $review,
        'comment' => $comment,
        ]);

        return view('review.review_complete');
    }
}
