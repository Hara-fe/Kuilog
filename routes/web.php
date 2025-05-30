<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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

// ダッシュボード
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 認証後プロフィール編集
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 登録完了ページ
Route::get('/register/complete', function () {
    return view('register.complete');
})->name('register.complete');

// メイン画面・検索・店舗詳細（全体公開）
Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/search', [SearchController::class, 'index']);
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');

// 全ユーザーがアクセス可能なルート（ログイン+権限）
Route::middleware(['auth', 'can:all_user'])->group(function () {
    Route::get('/main/create', [MainController::class, 'create'])->name('main.create');
    Route::post('/main/store', [MainController::class, 'store'])->name('main.store');

    // アカウント情報関連
    Route::get('/acount/{id}', [AcountController::class, 'show'])->name('acount.show');
    Route::get('/acount/edit/{id}', [AcountController::class, 'edit'])->name('acount.edit');
    Route::post('/acount/update', [AcountController::class, 'update'])->name('acount.update');

    // 口コミ投稿ページ
    Route::get('/review/{shop}', [ReviewController::class, 'create'])->name('review.create');
    // 口コミ保存処理
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});


// 管理者専用ルート
Route::middleware(['auth', 'can:admin'])->group(function () {
    // 管理画面（ユーザー一覧）
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // 店舗登録系
    Route::post('/shop/register', [ShopController::class, 'create']);
    Route::post('/shop/register/complete', [ShopController::class, 'store']);
    Route::post('/shop/review_seeing', [ShopController::class, 'seeing']);
});
    //店舗編集(管理者のみ)
    Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop/update/{id}', [ShopController::class, 'update'])->name('shop.update');
});



// Laravel Breeze の認証関連
require __DIR__.'/auth.php';
