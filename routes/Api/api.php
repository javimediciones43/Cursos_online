<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Controller;
use Illuminate\Routing\Route;

// login
Route::post('login', [AuthController::class,'login']);

// logout
Route::middleware('auth:sanctum')->group(function () 
{
    Route::post('logout', [AuthController::class,'logout']);

    // Aquí irán las rutas protegidas (cursos, categorías, etc)

});    
 