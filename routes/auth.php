<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationsController;

Route::get('/register', [AuthenticationsController::class, 'register'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [AuthenticationsController::class, 'registerPost'])
    ->middleware('guest')
    ->name('register.post');

Route::get('/login', [AuthenticationsController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticationsController::class, 'loginPost'])
    ->middleware('guest')
    ->name('login.post');

Route::get('/forgot-password', [AuthenticationsController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('forgot.password');

Route::post('/forgot-password', [AuthenticationsController::class, 'forgotPasswordPost'])
    ->middleware('guest')
    ->name('forgot.password.post');

Route::post('/logout', [AuthenticationsController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');





    /*

    use App\Http\Controllers\Auth\NewPasswordController;
    use App\Http\Controllers\Auth\VerifyEmailController;
    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\Auth\PasswordResetLinkController;
    use App\Http\Controllers\Auth\ConfirmablePasswordController;
    use App\Http\Controllers\Auth\AuthenticatedSessionController;
    use App\Http\Controllers\Auth\EmailVerificationPromptController;
    use App\Http\Controllers\Auth\EmailVerificationNotificationController;

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');
    */