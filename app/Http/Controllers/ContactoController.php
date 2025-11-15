<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactos = Contacto::get();
        return view("admin.contacto.listar", compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.contacto.crear");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nro_whatsapp" => "required|unique:contactos"
        ]);

        $contacto = new Contacto();
        $contacto->nombre = $request->nombre;
        $contacto->nro_whatsapp = $request->nro_whatsapp;
        $contacto->nro_identificacion = $request->nro_identificacion;
        $contacto->direccion = $request->direccion;
        $contacto->save();

        return redirect("/contacto");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
