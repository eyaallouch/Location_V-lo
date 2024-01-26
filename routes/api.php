<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\VeloController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function() {
    Route::resource('client',ClientController::class);

});
Route::middleware('api')->group(function() {
    Route::resource('location',LocationController::class);

});
// Exemple dans web.php pour une application web

Route::post('/verifierDisponibiliteVelo',[LocationController::class, 'verifierDisponibiliteVelo'] );


Route::middleware('api')->group(function() {
    Route::resource('modele',ModeleController::class);

});
Route::middleware('api')->group(function() {
    Route::resource('velo',VeloController::class);

});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/findIdUserByEmail/{email}', [UserController::class, 'findIdUserByEmail']);
Route::get('/findIdClientBycin/{cin}',[ClientController::class,'findIdClientBycin' ]);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,
'logout']);
Route::middleware('api')->group(function($router) {

    Route::post('/createpayment', [PaymentController::class,
    
    'createPaymentIntent']);
    
    });
