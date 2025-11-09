<?php

use App\Http\Controllers\MensajeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/mensaje/enviar", [MensajeController::class, "funEnviarMensaje"]);
