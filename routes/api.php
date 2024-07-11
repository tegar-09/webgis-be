<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DesaController;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\KejadianController;
use App\Http\Controllers\api\KecamatanController;
use App\Http\Controllers\api\PenangananController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

// Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('/users', UsersController::class);
    Route::resource('/kecamatan', KecamatanController::class);
    Route::resource('/desa', DesaController::class);
    Route::resource('/kejadian', KejadianController::class);
    Route::resource('/penanganan', PenangananController::class);
// });

Route::post('/kejadian', [KejadianController::class, 'store']); // ->middleware('permission:add kejadian')
Route::post('/penanganan', [PenangananController::class, 'store']); // ->middleware('permission:add penanganan')


