<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



// To protect routes so that all incoming requests must be authenticated
Route::middleware('auth:sanctum')->group(function () {

    Route::post('song', [SongController::class,'create_song']);




    
    Route::get('users/{id}', [UserController::class, 'show']);  //done
    Route::put('users/{id}', [UserController::class, 'update']);
    
    
    Route::put('/{id}', 'App\Http\Controllers\UserManagementController@update_user');
    
    Route::post('logout', [AuthController::class, 'logout']);

});

// ini buat playlist #aji 
Route::post('create-playlist',[PlaylistController::class,'create_playlist']);

// Route::post('/', 'App\Http\Controllers\PlaylistManagementController@create_playlist');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
