<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SettingsController;
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
Route::get('/settings', [SettingsController::class, 'getSettings']);

Route::middleware(['auth:api'])->group(function () {
    //Logout
    Route::post('/logout', [LoginController::class, 'logout']);
    //Get user for token control
    Route::post('/getuser', [ProfileController::class, 'getUser']);
    //Profile updating
    Route::post('/updateprofile', [ProfileController::class, 'updateProfile']);
    Route::post('/updateprofilephoto', [ProfileController::class, 'updateProfilePhoto']);
    Route::post('/getuser', [ProfileController::class, 'getUser']);
    //User listing for admins
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/user/get', [UserController::class, 'get']);
        //User adding for admins
        Route::post('/user/add', [UserController::class, 'store']);
        //User delete
        Route::delete('/user/{id}/delete', [UserController::class, 'delete']);
        //User updating
        Route::get('/user/{id}/get', [UserController::class, 'getUser']);
        Route::post('/user/update', [UserController::class, 'update']);
        //Website Settings update
        Route::post('/updatesettings', [SettingsController::class, 'update']);
    });
});
