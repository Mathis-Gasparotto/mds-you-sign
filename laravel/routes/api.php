<?php

use App\Http\Controllers\Auth\SanctumAuthenticatedSessionController;
use App\Http\Controllers\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest:sanctum')->post('/login', [SanctumAuthenticatedSessionController::class, 'store']);

Route::middleware(['auth:sanctum'])->get('/users/me', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'student:sanctum'])->get('/lessons/', [LessonController::class, 'future']);
Route::middleware(['auth:sanctum', 'student:sanctum'])->get('/lessons/today', [LessonController::class, 'today']);
Route::middleware(['auth:sanctum', 'student:sanctum'])->get('/lessons/{id}', [LessonController::class, 'getItem'])->where('id', '[0-9]+');
Route::middleware(['auth:sanctum', 'student:sanctum'])->post('/lessons/{id}/scan', [LessonController::class, 'scan'])->where('id', '[0-9]+');
