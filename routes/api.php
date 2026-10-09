<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| All routes here are prefixed with /api automatically by Laravel.
| Token issuance is public (no middleware). Everything else requires
| a valid Sanctum bearer token via auth:sanctum.
|
*/

// --- Token management (public) ---
Route::post('/tokens/create', [TokenController::class, 'create']);
Route::post('/logout', [TokenController::class, 'destroy'])->middleware('auth:sanctum');

// --- Protected student endpoints ---
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{student}', [StudentController::class, 'show']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{student}', [StudentController::class, 'update']);
    Route::delete('/students/{student}', [StudentController::class, 'destroy']);
});
