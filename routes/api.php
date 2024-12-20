<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//Route::middleware('api')->group(function () {
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});