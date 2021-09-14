<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CancelOrdersController;
use App\Http\Controllers\OrderReturnsController;

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

require __DIR__ . '/fix.php';
require __DIR__ . '/admin.php';

Route::get('/invoice', function () {
    return view('orders.invoice');
});

Route::get('/', [HomeController::class, 'index'])->name('home');


## Brands Related Routes
Route::get('/brands/{brand:slug}', [BrandsController::class, 'show'])->name('brands.show');

## Products Related Routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');
Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('products.show');
Route::post('/products/{product:slug}/{varient}/add-to-cart', [ProductsController::class, 'addToCart'])->name('products.addToCart')->middleware(['auth']);


## Categories Related Routes
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');


## Quotes Related Routes
Route::get('/quotes', [QuotesController::class, 'index'])->name('quotes.index')->middleware(['auth']);
Route::get('/quotes/create', [QuotesController::class, 'create'])->name('quotes.create')->middleware(['auth']);
Route::post('/quotes', [QuotesController::class, 'store'])->name('quotes.store')->middleware(['auth']);

## Users Related Routes
Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit')->middleware(['auth']);
Route::patch('/users/{user}', [UsersController::class, 'update'])->name('users.update')->middleware(['auth']);

## Carts Related Routes
Route::get('/cart', [CartsController::class, 'index'])->name('carts.index')->middleware(['auth']);

## Orders Related Routes
Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index')->middleware(['auth']);
Route::get('/orders/confirm', [OrdersController::class, 'confirm'])->name('orders.confirm')->middleware(['auth']);
Route::post('/orders/place', [OrdersController::class, 'placeOrder'])->name('orders.placeOrder')->middleware(['auth']);
Route::get('/orders/{order}/checkout', [OrdersController::class, 'checkout'])->name('orders.checkout')->middleware(['auth']);
Route::post('/orders/pay', [OrdersController::class, 'pay'])->name('orders.pay')->middleware(['auth']);
Route::get('/orders/invoice/{order}', [OrdersController::class, 'invoice'])->name('orders.invoice')->middleware(['auth', 'can:view,order']);


## Orders cancel Related Routes
Route::get('/orders/cancels', [CancelOrdersController::class, 'index'])->name('orders.cancel.index')->middleware(['auth']);
Route::get('/orders/{order}/cancel', [CancelOrdersController::class, 'create'])->name('orders.cancel')->middleware(['auth', 'can:cancel,order']);
Route::post('/orders/{order}/cancel', [CancelOrdersController::class, 'store'])->name('orders.cancelPost')->middleware(['auth', 'can:cancel,order']);

## Orders Return Related Routes
Route::get('/orders/returns', [OrderReturnsController::class, 'index'])->name('orders.return.index')->middleware(['auth']);
Route::get('/orders/{order}/return', [OrderReturnsController::class, 'create'])->name('orders.return.create')->middleware(['auth', 'can:return,order']);
Route::post('/orders/{order}/return', [OrderReturnsController::class, 'store'])->name('orders.return.store')->middleware(['auth', 'can:return,order']);

## Questions Related Routes
Route::post('/products/{product}', [QuestionsController::class, 'store'])->name('questions.store')->middleware(['auth']);

## For query form given in footer
Route::post('/queries', [QueriesController::class, 'store'])->name('queries.store');

require __DIR__ . '/auth.php';
