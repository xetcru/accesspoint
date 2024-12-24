<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\File;

// Редирект с корневого пути на /register
Route::get('/', function () {
    //return redirect('/register'); // можно просто переадресовать
    return view('index');
});

// Отдача React
Route::get('/{any}', function ($any) {
    $path = public_path("build/{$any}");
    if (File::exists($path) && !File::isDirectory($path)) {
        // Если запрашивается файл, отдаём его
        return response()->file($path);
    }
    // Если файл не найден, отдаём index.html
    return response()->file(public_path('build/index.html'));
})->where('any', '.*');

// Роуты для блейдов
/*Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});*/
