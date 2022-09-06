<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\verifyMobile;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::middleware('SetLocal')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])/*->middleware('verify.mobile')*/;
Route::post('/confirm', [AuthController::class, 'confirm']);
Route::get('/profile', [AuthController::class, 'profile']);
//Route::get('send-sms-notification', [NotificationController::class, 'sendSmsNotificaition']);
Route::middleware(['auth:api', 'SetLocal'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);

});

});