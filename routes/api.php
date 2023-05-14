<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\PlaylistController;

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

//Gest Route
Route::post('register', [AuthController::class, 'register']);



// To protect routes so that all incoming requests must be authenticated
Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users/{id}', [UserController::class, 'show']);  //done
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::put('/{id}', 'App\Http\Controllers\UserManagementController@update_user');
});

Route::middleware(['admin.api'])->prefix('admin')->group(function () {
    Route::post('register', [AdminController::class, 'register']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// ini buat playlist #aji 
Route::post('create-playlist',[PlaylistController::class,'create_playlist']);

// Route::post('/', 'App\Http\Controllers\PlaylistManagementController@create_playlist');
