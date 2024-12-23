<?php
use App\Http\Controllers\AuthController;

// API маршруты
Route::post('register', [AuthController::class, 'apiRegister']);
Route::post('login', [AuthController::class, 'apiLogin']);
Route::get('user', [AuthController::class, 'apiUser'])->middleware('auth:api');
Route::post('logout', [AuthController::class, 'apiLogout'])->middleware('auth:api');
