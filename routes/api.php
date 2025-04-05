<?php

use Illuminate\Http\Request;
use  App\Http\Controllers\API\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::middleware(['auth.jwt:'])->group(function () {
Route::post('logout',[UserAuthController::class,'logout']);
Route::post('refresh',[UserAuthController::class,'refresh']);
Route::post('forgot-password',[UserAuthController::class,'forgot']);
Route::post('reset-password',[UserAuthController::class,'reste']);
});
Route::post('verify-email',[UserAuthController::class,'verifyEmail']);