<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\OpenaiController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/contacto');
});

Route::get("/saludo", function(){
    return "Hola Saludos desde Laravel";
});

Route::get("/tecnologias", function(){
    return ["PHP", "JAVA", "PYTHON"];
}); 

/*
Route::get("/usuario", function(){
    return view("admin.usuario.listar");
});
*/

Route::get("usuario", [UsuarioController::class, "funListar"]); // listar
Route::get("usuario/crear", [UsuarioController::class, "funCrear"]); // crear
Route::post("usuario", [UsuarioController::class, "funGuardar"]); // guardar
Route::get("usuario/{id}", [UsuarioController::class, "funMostrar"]); // mostrar
Route::get("usuario/{id}/editar", [UsuarioController::class, "funEditar"]); // editar
Route::put("usuario/{id}", [UsuarioController::class, "funModificar"]); // modificar
Route::delete("usuario/{id}", [UsuarioController::class, "funEliminar"]); // eliminar

Route::resource("contacto", ContactoController::class)->middleware('auth');

Route::get("consultas", [OpenaiController::class, "panelChat"]);
Route::get("consultas-whatsapp", [MensajeController::class, "panelWhatsapp"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


