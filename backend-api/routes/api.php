<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Admin\UserController;
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

Route::post('/checkusername', [RegisterController::class, 'checkUsername']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/getuser', [ProfileController::class, 'getUser']);
    Route::post('/updateprofile', [ProwfileController::class, 'updateProfile']);
    Route::post('/updateprofilephoto', [ProfileController::class, 'updateProfilePhoto']);
    Route::post('/getuser', [ProfileController::class, 'getUser']);
    Route::post('/user/add', [UserController::class, 'store']);
    Route::get('/user/get', [UserController::class, 'get']);

});
