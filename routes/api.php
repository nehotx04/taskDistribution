<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix'=>'users'],function(){
    Route::get('/',[UserController::class, 'getUsers']);
    Route::post('/',[UserController::class, 'store']);
    Route::put('/{user}',[UserController::class, 'update']);
    Route::delete('/{user}',[UserController::class, 'destroy']);
    Route::put('/complete/{user}',[UserController::class, 'completeDay']);
});

Route::group(['prefix'=>'tasks'],function(){
    Route::get('/',[TaskController::class, 'index']);
    Route::post('/',[TaskController::class, 'store']);
    Route::put('/{task}',[TaskController::class, 'update']);
    Route::put('/{task}',[TaskController::class, 'completeTask']);
    Route::delete('/{task}',[TaskController::class, 'destroy']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
