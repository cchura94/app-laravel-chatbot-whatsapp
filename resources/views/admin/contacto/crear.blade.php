
@extends('adminlte::page')


@section('title', 'Crear Nuevo Contacto')

@section('content_header')
    <h1>Crear Nuevo Contacto</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="/contacto" method="post">
                    @csrf
                    <label for="">Ingrese Nombre:</label>
                    <input type="text" name="nombre" class="form-control">
                    <br>
                    <label for="">Ingrese Nro Whatsapp:</label>
                    <input type="number" name="nro_whatsapp" class="form-control">
                    <br>
                    <label for="">Ingrese nro_identificacion:</label>
                    <input type="text" name="nro_identificacion" class="form-control">
                    <br>
                    <label for="">Ingrese Dirección:</label>
                    <input type="text" name="direccion" class="form-control">
                    
                    <br>
                    <input type="submit" value="Guardar Contacto" class="btn btn-primary">
                    
                </form>

            </div>
        </div>

    </div>
</div>
@stop
