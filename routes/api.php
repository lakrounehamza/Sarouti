<?php

use Illuminate\Http\Request;
use  App\Http\Controllers\API\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use  App\Http\Controllers\API\AnnonceController;
use  App\Http\Controllers\API\CategoryController;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::middleware(['auth:'])->group(function () {
Route::post('logout',[UserAuthController::class,'logout']);
Route::post('refresh',[UserAuthController::class,'refresh']);
Route::post('forgot-password',[UserAuthController::class,'forgot']);
Route::post('reset-password',[UserAuthController::class,'reste']);
Route::post('verify-email',[UserAuthController::class,'verifyEmail']);

Route::post('annonces',[AnnonceController::class,'store']);
});
// Route::middleware(['auth:seller'])
Route::get('annonces',[AnnonceController::class,'index']);
Route::get('annonces/{annonceId}',[AnnonceController::class,'show']);
Route::put('annonces/{annonceId}',[AnnonceController::class,'update']);
Route::delete('annonces/{annonceId}',[AnnonceController::class,'destroy']);
Route::get('annonces/category/{categoryName}',[AnnonceController::class,'getAnnonceByCategoryName']);
Route::get('annonces/seller/{sellerId}',[AnnonceController::class,'getAnnonceBySellerId']);
Route::get('categories',[CategoryController::class,'index']);
// Route::middleware(['auth:seller'])->controller(CategoryController::class)->group(function () {
// Route::get('categories','index');
// Route::get('categories/{category}','show');
// Route::post('categories','store');
// Route::put('categories/{categoryId}','update');
// Route::delete('categories/{categoryId}','destroy');
// });