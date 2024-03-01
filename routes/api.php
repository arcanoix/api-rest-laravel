<?php

use App\Http\Controllers\Api\{ProductController, UserController, CategoryController};
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group( function () {
    

    Route::apiResource('users', UserController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});