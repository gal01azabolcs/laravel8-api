<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//index
Route::get('/posts',[PostController::class,'index']);

//stroer
Route::post('/post',[PostController::class,'store']);

Route::get('/posts/{id}',[PostController::class,'show']);

//update
Route::put('/posts/{id}',[PostController::class,'update']);
//delete
Route::delete('/posts/{id}',[PostController::class,'destroy']);