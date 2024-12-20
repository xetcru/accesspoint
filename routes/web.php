<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/{path?}', function () {
    return view('welcome');
})->where('path', '.*');

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');
