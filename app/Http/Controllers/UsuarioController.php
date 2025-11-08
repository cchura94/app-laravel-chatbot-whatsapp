<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function funListar(){

        $usuarios = User::get(); // select * from users

        return view("admin.usuario.listar", compact('usuarios'));
    }
    public function funCrear(){
        return view("admin.usuario.crear");
    }
    public function funGuardar(Request $request){

        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->save();

        return redirect("/usuario");

    }
    public function funMostrar($id){
        return view("admin.usuario.mostrar");
    }
    public function funEditar($id){
        return view("admin.usuario.editar");
    }
    public function funModificar($id, Request $request){

    }
    public function funEliminar($id){

    }
}
