<?php

use App\Http\Controllers\Api\Auth\AdminLoginController;
use App\Http\Controllers\Api\Auth\ModeratorLoginController;
use App\Http\Controllers\Api\Auth\FinancialLoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::controller(AdminLoginController::class)->group(function () {
    Route::post('admin/register', 'register');
    Route::post('admin/login', 'login');
});

Route::group(['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin']], function () {
    Route::post('admin-detail', [AdminLoginController::class, 'getAdminDetail']);
    Route::post('logout', [AdminLoginController::class, 'logout']);
    Route::apiResource('users', UserController::class);
});

// MODERATOR
Route::controller(ModeratorLoginController::class)->group(function () {
    Route::post('moderator/register', 'register');
    Route::post('moderator/login', 'login');
});

Route::group(['prefix' => 'moderator','middleware' => ['auth:moderator-api','scopes:moderator']], function () {
    Route::post('moderator-detail', [ModeratorLoginController::class, 'getModeratorDetail']);
    Route::post('logout', [ModeratorLoginController::class, 'logout']);
    Route::apiResource('users', UserController::class);
});

// FINANCIAL
Route::controller(FinancialLoginController::class)->group(function () {
    Route::post('financial/register', 'register');
    Route::post('financial/login', 'login');
});

Route::group(['prefix' => 'financial','middleware' => ['auth:financial-api','scopes:financial']], function () {
    Route::post('financial-detail', [FinancialLoginController::class, 'getFinancialDetail']);
    Route::post('logout', [FinancialLoginController::class, 'logout']);
    Route::apiResource('users', UserController::class);
});

