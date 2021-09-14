<?php

use Illuminate\Support\Facades\Route;

Route::get('/about-us', function () {
    return view('aboutus');
});

Route::get('/contact-us', function () {
    return view('contactus');
});
