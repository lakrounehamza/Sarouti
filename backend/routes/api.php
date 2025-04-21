<?php

use Illuminate\Http\Request;
use  App\Http\Controllers\API\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use  App\Http\Controllers\API\AnnonceController;
use  App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DomendeController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SignaleController;

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::middleware(['auth:'])->group(function () {
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::post('forgot-password', [UserAuthController::class, 'forgot']);
    Route::post('reset-password', [UserAuthController::class, 'reste']);
    Route::post('verify-email', [UserAuthController::class, 'verifyEmail']);

    // Route::post('annonces',[AnnonceController::class,'store']);
});
// Route::middleware(['auth:seller'])
Route::middleware(['auth:client'])->group(function () {

    Route::get('domendes/client/{id}', [DomendeController::class, 'getDomendesByClient']);
    Route::POST('domendes', [DomendeController::class, 'store']);
    Route::put('domendes/{id}', [DomendeController::class, 'update']);
    Route::delete('domendes/{id}', [DomendeController::class, 'destroy']);
    Route::PATCH('domendes/{id}/reject', [DomendeController::class, 'rejectDomende']);
    Route::get('users/{id}', [UserController::class, 'show']);
});
Route::middleware(['auth:admin'])->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
    Route::get('categories/{categoryId}', [CategoryController::class, 'show']);
    Route::put('categories/{categoryId}', [CategoryController::class, 'update']);
    Route::get('domendes', [DomendeController::class, 'index']);
    Route::get('users', [UserController::class, 'index']);
    Route::patch('users/{id}/actif', [UserController::class, 'actifUser']);
    Route::patch('users/{id}/suspendre', [UserController::class, 'suspendreUser']);
    Route::get('annonces/admin/domendes', [AnnonceController::class, 'annoncesForAdmin']);

    Route::PATCH('annonces/{id}/accept', [AnnonceController::class, 'acceptAnnonce']);
    Route::PATCH('annonces/{id}/reject', [AnnonceController::class, 'rejectAnnonce']);
    Route::get('statistic/admin', [AnnonceController::class, 'satatisticAdmin']);
    Route::patch('/roles/{id}/accept', [RoleController::class, 'acceptRole']);
    Route::patch('/roles/{id}/annule', [RoleController::class, 'annuleRole']);
    Route::delete('/roles', [RoleController::class, 'destroy']);
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::post('/roles/{id}', [RoleController::class, 'store']);
    Route::get('/signales', [SignaleController::class, 'index']);
    Route::post('/signales', [SignaleController::class, 'store']);
    Route::get('/signales/{id}', [SignaleController::class, 'show']);
    Route::patch('/signales/{id}/accept', [SignaleController::class, 'acceptRole']);
    Route::patch('/signales/{id}/annule', [SignaleController::class, 'annuleRole']);
});
Route::middleware(['auth:seller'])->group(function () {

    Route::get('domendes/seller/{sellerId}', [DomendeController::class, 'getDomendesBySeller']);
    // Route::post('annonces', [AnnonceController::class, 'store']);
    // Route::delete('annonces/{annonceId}', [AnnonceController::class, 'destroy']);

    Route::PATCH('domendes/{id}/accept', [DomendeController::class, 'acceptDomende']);
    Route::PATCH('domendes/{id}/reject', [DomendeController::class, 'rejectDomende']);
    Route::get('users/{id}', [UserController::class, 'show']);
});
Route::get('statistic/seller/{id}', [AnnonceController::class, 'statisticSeller']);
Route::post('annonces', [AnnonceController::class, 'store']);
Route::get('annonces', [AnnonceController::class, 'index']);
Route::get('annonces/{annonceId}', [AnnonceController::class, 'show']);
Route::put('annonces/{annonceId}', [AnnonceController::class, 'update']);
Route::get('annonces/category/{categoryName}', [AnnonceController::class, 'getAnnonceByCategoryName']);
Route::get('annonces/seller/{sellerId}', [AnnonceController::class, 'getAnnonceBySellerId']);
// Route::get('categories', [CategoryController::class, 'index']);
Route::post('likes', [LikeController::class, 'store']);
Route::delete('likes/{likeId}', [LikeController::class, 'destroy']);
Route::get('annonces/{annonceId}/comments', [AnnonceController::class, 'getCommentsByAnnonceId']);
Route::post('messages/detaile', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);
Route::get('messages/{id}', [MessageController::class, 'show']);
Route::put('messages/{id}', [MessageController::class, 'update']);
Route::delete('messages/{id}', [MessageController::class, 'destroy']);
Route::get('messages/user/{id}', [MessageController::class, 'getAllMessagesBySenderId']);  
// Route::middleware(['auth:seller'])->controller(CategoryController::class)->group(function () {
// Route::get('categories','index');
// Route::get('categories/{category}','show');
// Route::post('categories','store');
// Route::put('categories/{categoryId}','update');
// Route::delete('categories/{categoryId}','destroy');
// });