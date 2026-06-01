<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Load API routes (keeps simple apps working without a RouteServiceProvider)
if (file_exists(__DIR__.'/api.php')) {
    require __DIR__.'/api.php';
}
