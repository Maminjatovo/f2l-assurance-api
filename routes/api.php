<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DocumentController;


use Illuminate\Support\Facades\Cache;


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

Route::apiResource('projects', ProjectController::class);

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::delete('users/{id}', [UserController::class, 'destroy']);
Route::post('users/info', [UserController::class, 'updateInfo']);
Route::post('users/email/{id}', [UserController::class, 'updateEmail']);
Route::post('users/password/{id}', [UserController::class, 'updatePassword']);
Route::get('clients', [UserController::class, 'findAllClients']);
Route::get('clientInfo/{id}', [UserController::class, 'getDetailsClient']);
Route::post('search', [UserController::class, 'searchUser']);

Route::get('send-email', [SendEmailController::class, 'index']);
Route::post('sendemail', [SendEmailController::class, 'sendEmail']);

Route::get('contrats/{id}', [ContratController::class, 'index']);
Route::post('contrats', [ContratController::class, 'store']);
Route::delete('contrats/{id}', [ContratController::class, 'destroy']);
Route::post('contrats/info', [ContratController::class, 'updateInfo']);

Route::post('documents', [DocumentController::class, 'store']);
Route::post('upload', [DocumentController::class, 'upload']);
Route::delete('documents/{id}', [DocumentController::class, 'destroy']);
Route::get('documents/{id}', [DocumentController::class, 'getByContrat']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('checkToken', [AuthController::class,'checkToken']);
Route::post('logCli', [AuthController::class,'loginClient']);
Route::post('validateLog', [AuthController::class,'validateLogin']);
Route::post('registerCli', [AuthController::class,'registerClient']);
Route::post('validateReg', [AuthController::class,'validateRegister']);


Route::post('optCode', [OtpController::class,'sendOtpCode']);
Route::post('verifyCode', [OtpController::class,'verifyOTP']);





