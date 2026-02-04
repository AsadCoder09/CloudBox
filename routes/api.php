<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:sanctum');
    Route::post('verify-email', 'AuthController@verifyEmail')->middleware('auth:sanctum');
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::get('me', 'AuthController@me')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('files/upload', 'FileController@upload');
    Route::get('files/{id}', 'FileController@show');
    Route::get('files/{id}/download', 'FileController@download')->middleware('signed');
    Route::patch('files/{id}', 'FileController@update');
    Route::delete('files/{id}', 'FileController@trash');
    Route::post('files/{id}/restore', 'FileController@restore');

    Route::post('folders', 'FolderController@store');
    Route::get('folders/{id}', 'FolderController@show');
    Route::patch('folders/{id}', 'FolderController@update');
    Route::delete('folders/{id}', 'FolderController@trash');
    Route::post('folders/{id}/restore', 'FolderController@restore');

    Route::post('share', 'ShareController@store');
    Route::get('share/{token}/logs', 'ShareController@logs');
});

Route::get('share/{token}', 'ShareController@show')->middleware('signed');
Route::post('share/{token}/verify', 'ShareController@verify')->middleware('throttle:share');

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('users', 'AdminController@users');
    Route::get('storage', 'AdminController@storage');
    Route::get('logs', 'AdminController@logs');
});
