<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DesaController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\api\KejadianController;
use App\Http\Controllers\api\KecamatanController;
use App\Http\Controllers\api\PenangananController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::Resource('/users', UsersController::class);
Route::Resource('/kecamatan', KecamatanController::class);
Route::Resource('/desa', DesaController::class);
Route::Resource('/kejadian', KejadianController::class);
Route::Resource('/penanganan', PenangananController::class);

