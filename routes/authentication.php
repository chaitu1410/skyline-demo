<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationsController;

Route::get('/login', [AuthenticationsController::class, 'login'])->name('authentications.login');
Route::get('/register', [AuthenticationsController::class, 'register'])->name('authentications.register');
Route::get('/password-reset', [AuthenticationsController::class, 'passwordReset'])->name('authentications.password.reset');
