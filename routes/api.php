<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facause App\Http\Controllers\UserController;
use App\Http\Controllers\UserController;


Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']); // Create a new user
    Route::get('/', [UserController::class, 'index']); // Get all users
    Route::get('/{id}', [UserController::class, 'show']); // Get a specific user
    Route::put('/{id}', [UserController::class, 'update']); // Update a user
    Route::delete('/{id}', [UserController::class, 'destroy']); // Delete a user
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
