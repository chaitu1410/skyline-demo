<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\QuotesController;
use App\Http\Controllers\Admin\PincodesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\admin\SubcategoriesController;

//Route::get('/admin', [AdminsController::class, 'login'])->name('admin.login')->middleware('guest');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {

    Route::get('/', [AdminsController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/information', [AdminsController::class, 'edit'])->name('admin.edit');
    Route::patch('/information', [AdminsController::class, 'update'])->name('admin.update');

    Route::post('/banner', [AdminsController::class, 'storeBanner'])->name('admin.banner.store');
    Route::delete('/banner/{banner}', [AdminsController::class, 'destroyBanner'])->name('admin.banner.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/download', [UsersController::class, 'download'])->name('admin.users.download');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('admin.categories.show');
    Route::get('/categories/{category}/subcategories/{subcategory}', [CategoriesController::class, 'showSubcategory'])->name('admin.categories.showSubcategory');
    Route::patch('/categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/categories/{category}/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
    Route::post('/categories/{category}/products', [ProductsController::class, 'store'])->name('admin.products.store');
    //varient
    Route::get('/products/add-varient', [ProductsController::class, 'addVarient'])->name('admin.products.addVarient');
    Route::post('/products/{product}/add-varient', [ProductsController::class, 'storeVarient'])->name('admin.products.storeVarient');
    Route::patch('/products/{product}/add-varient/{varient}', [ProductsController::class, 'updateVarient'])->name('admin.products.updateVarient');
    //end varient
    Route::get('/products/{product}', [ProductsController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
    Route::patch('/products/{product}', [ProductsController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('admin.products.destroy');



    Route::get('/brands', [BrandsController::class, 'index'])->name('admin.brands.index');
    Route::post('/brands', [BrandsController::class, 'store'])->name('admin.brands.store');
    Route::patch('/brands/{brand}', [BrandsController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/{brand}', [BrandsController::class, 'destroy'])->name('admin.brands.destroy');

    Route::post('/categories/{category}/subcategories', [SubcategoriesController::class, 'store'])->name('admin.subcategories.store');
    Route::patch('/categories/subcategories/{subcategory}', [SubcategoriesController::class, 'update'])->name('admin.subcategories.update');
    Route::delete('/categories/{category}/subcategories/{subcategory}', [SubcategoriesController::class, 'destroy'])->name('admin.subcategories.destroy');

    Route::get('/pincodes', [PincodesController::class, 'index'])->name('admin.pincodes.index');
    Route::post('/pincodes', [PincodesController::class, 'store'])->name('admin.pincodes.store');
    Route::patch('/pincodes/{pincode}', [PincodesController::class, 'update'])->name('admin.pincodes.update');
    Route::delete('/pincodes/{pincode}', [PincodesController::class, 'destroy'])->name('admin.pincodes.destroy');

    Route::get('/questions', [QuestionsController::class, 'index'])->name('admin.questions.index');
    Route::patch('/questions/{question}', [QuestionsController::class, 'update'])->name('admin.questions.update');

    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::patch('/orders/{order}/confirm', [OrdersController::class, 'confirm'])->name('admin.orders.confirm');
    Route::patch('/orders/{order}/cancel', [OrdersController::class, 'cancel'])->name('admin.orders.cancel');
    Route::patch('/orders/{order}/update', [OrdersController::class, 'update'])->name('admin.orders.update');
    Route::patch('/orders/{order}/cancelReply', [OrdersController::class, 'cancelReply'])->name('admin.orders.cancelReply');
    Route::patch('/orders/{returnOrder}/returnReply', [OrdersController::class, 'returnReply'])->name('admin.orders.returnReply');

    Route::get('/quotes', [QuotesController::class, 'index'])->name('admin.quotes.index');
    Route::post('/quotes/{quote}/reply', [QuotesController::class, 'reply'])->name('admin.quotes.reply');
});
