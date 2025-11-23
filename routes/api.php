<?php

use App\Http\Controllers\MensajeController;
use App\Http\Controllers\OpenaiController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/mensaje/enviar", [MensajeController::class, "funEnviarMensaje"]);

Route::post("/openai/text", [OpenaiController::class, "funRespuestaIA"]);

// webhook
Route::post("/webhook-evolution", [WebhookController::class, "recibirMensajeWebhook"]);

// enviar mensajes con Laravel desde Whatsapp Cloud API

Route::get("/enviar-mensaje-texto", [WhatsappController::class, "enviarMensajeTexto"]);
Route::get("/enviar-mensaje-buttons", [WhatsappController::class, "enviarMensajeBotones"]);
Route::get("/enviar-mensaje-lista", [WhatsappController::class, "enviarMensajeLista"]);

