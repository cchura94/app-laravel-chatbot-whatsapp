<?php

use App\Http\Controllers\MensajeController;
use App\Http\Controllers\OpenaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/mensaje/enviar", [MensajeController::class, "funEnviarMensaje"]);

Route::post("/openai/text", [OpenaiController::class, "funRespuestaIA"]);
