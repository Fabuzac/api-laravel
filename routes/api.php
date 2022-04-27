<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PictureController;
use App\Models\Picture;

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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/pictures', [PictureController::class, 'index']);
Route::get('/pictures/{id}', [PictureController::class, 'show'])->middleware('frontend');
Route::post('/pictures', [PictureController::class, 'store'])->middleware('frontend');