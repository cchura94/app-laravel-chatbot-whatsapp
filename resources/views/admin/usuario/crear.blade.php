
@extends('adminlte::page')


@section('title', 'Crear Nuevo Usuario')

@section('content_header')
    <h1>Crear Nuevo Usuario</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="/usuario" method="post">
                    @csrf
                    <label for="">Ingrese Nombre:</label>
                    <input type="text" name="name" class="form-control">
                    <br>
                    <label for="">Ingrese Correo:</label>
                    <input type="email" name="email" class="form-control">
                    <br>
                    <label for="">Ingrese Contraseña:</label>
                    <input type="password" name="password" class="form-control">
                    <br>
                    <input type="submit" value="Guardar Usuario" class="btn btn-primary">
                    
                </form>

            </div>
        </div>

    </div>
</div>
@stop
