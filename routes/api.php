<?php
namespace App;

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->group(function(){
    Route::resource('task',TaskController::class);
    Route::get('user',[UserController::class,'index']);
    Route::get('task',[TaskController::class,'index']);
    Route::get('user/task',[TaskController::class,'taskByUser']);
    Route::resource('user',UserController::class);
});

Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);
