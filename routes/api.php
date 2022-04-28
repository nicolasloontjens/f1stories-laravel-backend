<?php

use App\Http\Controllers\CommentApiController;
use App\Http\Controllers\RaceApiController;
use App\Http\Controllers\StoryApiController;
use App\Http\Controllers\UserApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post("/users/register",[UserApiController::class,"register"]);
Route::post("/users/login",[UserApiController::class,'login']);
Route::get("/users/{id}",[UserApiController::class,"getUser"]);
Route::post("/users/{id}/race",[UserApiController::class,"addRace"]);
Route::get('/users/{id}/likes',[UserApiController::class,'getLikes']);

Route::get("/stories",[StoryApiController::class,"all"]);
Route::post("/stories",[StoryApiController::class,"add"]);
Route::put("/stories/{id}",[StoryApiController::class,"update"]);
Route::delete("/stories/{id}",[StoryApiController::class,"delete"]);
Route::post("/stories/{id}/interact",[StoryApiController::class,"interact"]);

Route::get("/stories/{id}/comments",[CommentApiController::class,"all"]);
Route::post("/stories/{id}/comments",[CommentApiController::class,"post"]);
Route::put("/comments/{id}",[CommentApiController::class,"update"]);
Route::delete("/comments/{id}",[CommentApiController::class,"delete"]);

Route::get("/races",[RaceApiController::class,"get"]);
