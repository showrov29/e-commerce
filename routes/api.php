<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'/order'],function(){

    Route::get('/all',[OrderController::class,'getOrders']);
    Route::post('/add/{id}',[OrderController::class,'addOrder']);
    Route::put('/confirm/{id}',[OrderController::class,'confirmOrder']);
    Route::get('/{id}',[OrderController::class,'getOrderByOrderId']);
});

Route::group(['prefix'=>'/user'],function(){
    Route::get('/all',[UserController::class,'getAllUsers']);
    Route::put('/setactive/{id}',[UserController::class,'setActive']);
    Route::get('/inactive',[UserController::class,'getUserInactive']);
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
});


Route::group(['prefix'=>'/advertisement'],function(){
    Route::get('/all',[AdvertisementController::class,'getAllAdvertisement']);
    Route::post('/add',[AdvertisementController::class,'addAdvertisement']);
});
