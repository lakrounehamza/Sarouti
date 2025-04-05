<?php

use Illuminate\Http\Request;
use  App\Http\Controllers\API\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use  App\Http\Controllers\API\AnnonceController;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::middleware(['auth:'])->group(function () {
Route::post('logout',[UserAuthController::class,'logout']);
Route::post('refresh',[UserAuthController::class,'refresh']);
Route::post('forgot-password',[UserAuthController::class,'forgot']);
Route::post('reset-password',[UserAuthController::class,'reste']);
Route::post('verify-email',[UserAuthController::class,'verifyEmail']);
});
// Route::middleware(['auth:seller'])
Route::get('annonces',[AnnonceController::class,'index']);
Route::get('annonces/{annonce}',[AnnonceController::class,'show']);
Route::post('annonces',[AnnonceController::class,'store']);
Route::put('annonces/{annonce}',[AnnonceController::class,'update']);
Route::delete('annonces/{annonce}',[AnnonceController::class,'destroy']);