<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Routing\Route;

// login
Route::post('login', [AuthController::class,'login']);

// logout
Route::middleware('auth:sanctum')->group(function () 
{
    Route::post('logout', [AuthController::class,'logout']);

    // Aquí irán las rutas protegidas (cursos, categorías, etc)
    // Categories
    Route::apiResource('categories', CategoryController::class);
    // Courses
    Route::apiResource('courses', CourseController::class);
});    
 