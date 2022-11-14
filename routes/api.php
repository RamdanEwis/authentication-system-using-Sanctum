<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PhoneNumberVerifyController;
use App\Http\Controllers\Api\TagController;
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


/*Authentication User */
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);

/*phone verification With twilio auth_token */
Route::get('phone/verify', [PhoneNumberVerifyController::class,'show'])->name('phone_verification.show');
Route::post('phone/verify', [PhoneNumberVerifyController::class,'verify'])->name('phone_verification.verify');

/*group apiResource Posts And Tags */
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('tags', TagController::class);
});

