<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ホーム画面（一覧表示）
Route::get('/home', [ProductController::class, 'index'])->name('home');

// ★ 追加: 商品一覧画面（/products アクセス用）
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品新規登録画面の表示
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 商品登録処理（フォーム送信先）
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品詳細画面の表示
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// 商品編集画面の表示
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// 商品更新処理（フォーム送信先）
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// 商品削除処理
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');