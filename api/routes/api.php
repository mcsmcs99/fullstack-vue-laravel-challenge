<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/purchases', [PurchaseController::class, 'index']);
