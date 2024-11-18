<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;


Route::post('/register', [AuthController::class, 'register']);

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('permissions', PermissionController::class);

Route::post('/users/{user}/roles', [UserController::class, 'assignRole']);
Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermission']);

