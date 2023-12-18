<?php

use App\Http\Controllers\ApiMobileController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/mobile/informasi', [ApiMobileController::class, 'informasi']);
Route::get('/mobile/chapter', [ApiMobileController::class, 'chapter']);
Route::get('/mobile/user', [ApiMobileController::class, 'user']);
Route::post('/mobile/modul/{id}', [ApiMobileController::class, 'modul']);
Route::post('/mobile/login', [ApiMobileController::class, 'login']);
Route::post('/mobile/register', [ApiMobileController::class, 'register']);
Route::post('/mobile/logout', [ApiMobileController::class, 'logout']);
