<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TareaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Rutas para la autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::get('/tareas', [TareaController::class, 'index']);
Route::post('/tareas', [TareaController::class, 'store'])->middleware('auth:sanctum');
Route::get('/tareas/{id}', [TareaController::class, 'show']);
Route::put('/tareas/{id}', [TareaController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->middleware('auth:sanctum');