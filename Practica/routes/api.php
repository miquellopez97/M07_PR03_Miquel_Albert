<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserValidate;
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

Route::post('/register', [UserController::class, 'store'])->middleware(UserValidate::class);

Route::resource('/apartment', ApartmentController::class);

Route::get('/apartaments_premium', [ApartmentController::class, 'apartaments_premium']);

Route::get('/apartaments_rented', [ApartmentController::class, 'apartaments_rented']);
