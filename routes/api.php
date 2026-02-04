<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ShareController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('verify-email', [AuthController::class, 'verifyEmail'])->middleware('auth:sanctum');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('files/upload', [FileController::class, 'upload']);
    Route::get('files/{id}', [FileController::class, 'show']);
    Route::get('files/{id}/download', [FileController::class, 'download'])->middleware('signed');
    Route::patch('files/{id}', [FileController::class, 'update']);
    Route::delete('files/{id}', [FileController::class, 'trash']);
    Route::post('files/{id}/restore', [FileController::class, 'restore']);

    Route::post('folders', [FolderController::class, 'store']);
    Route::get('folders/{id}', [FolderController::class, 'show']);
    Route::patch('folders/{id}', [FolderController::class, 'update']);
    Route::delete('folders/{id}', [FolderController::class, 'trash']);
    Route::post('folders/{id}/restore', [FolderController::class, 'restore']);

    Route::post('share', [ShareController::class, 'store']);
    Route::get('share/{token}/logs', [ShareController::class, 'logs']);
});

Route::get('share/{token}', [ShareController::class, 'show'])->middleware('signed');
Route::post('share/{token}/verify', [ShareController::class, 'verify'])->middleware('throttle:share');

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('users', [AdminController::class, 'users']);
    Route::get('storage', [AdminController::class, 'storage']);
    Route::get('logs', [AdminController::class, 'logs']);
});
