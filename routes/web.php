<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AcountController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


    Route::get('/register/complete', function () {
    return view('register.complete');
})->name('register.complete');
    // Route::get('main',function(){
    //     return view('main.main');
    // })->middleware(['auth'])->name('main');
    Route::get('/main', function() {return view('main.main');})->name('main');
    Route::get('/shop/{shop}',[ShopController::class,'show'])->name('shop.show');
    
   Route::middleware(['auth','can:all_user'])->group(function(){    
        Route::get('/main',[MainController::class,'index'])->name('main.index');
        Route::get('/main/create', [MainController::class, 'create'])->name('main.create');
        Route::post('/main/store', [MainController::class, 'store'])->name('main.store');
        Route::get('/search',[SearchController::class,'index']);
        // Route::get('/acount',[AcountController::class,'show'])->name('acount');
        Route::get('/acount/{id}', [AcountController::class, 'show'])->name('acount.show');
        Route::get('/acount/edit/{id}',[AcountController::class,'edit'])->name('acount.edit');
        Route::post('/acount/update',[AcountController::class,'update'])->name('acount.update');
        Route::get('/shop',[ShopController::class,'show']);
        Route::get('/review',[ReviewController::class,'create'])->name('review.create');
        Route::get('/review/complete',[ReviewController::class,'store']);
    });

    Route::middleware(['auth','can:admin'])->group(function(){
        Route::post('/shop/register',[ShopController::class,'create']);
        Route::post('/shop/register/complete',[ShopController::class,'store']);
        Route::post('/shop/edit',[ShopController::class,'edit']);
        Route::post('/shop/update',[ShopController::class,'update']);
        Route::post('/shop/review_seeing',[ShopController::class,'seeing']);
        Route::post('/admin_acount',[AdminController::class,'index']);
        Route::post('/admin_acount/edit',[AdminController::class,'edit']);
        Route::post('/admin_acount/update',[AdminController::class,'update']);
    });

require __DIR__.'/auth.php';


Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shops.show');
