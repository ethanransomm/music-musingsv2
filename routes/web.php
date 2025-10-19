<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return "This is the about page.";
});

Route::get('/home', function () {
    return "This is the home page.";
});

Route::redirect('/home', '/about');

Route::get('user/{name}', function ($name=null) {
    return "Hello, " . ($name ?? 'Guest');
});

Route::get('/show/{input_string}', function (string $inputString) {
    return 'You wrote: ' . $inputString;
});