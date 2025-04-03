<?php

use Illuminate\Http\Request;
use  App\Http\Controllers\API\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::middleware([AuthMiddleware::class])->group(function () {
Route::post('logout',[UserAuthController::class,'logout']);
Route::post('refresh',[UserAuthController::class,'refresh']);
Route::post('password/forgot',[UserAuthController::class,'forgot']);
Route::post('password/reste',[UserAuthController::class,'reste']);

});