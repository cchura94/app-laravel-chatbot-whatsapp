@extends('adminlte::page')


@section('title', 'Lista de Contactos')

@section('content_header')
    <h1>Lista de Contactos</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <a href="/contacto/crear" class="btn btn-primary">Nuevo Contacto</a>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>NRO WHATSAPP</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contactos as $cont)
                <tr>
                    <td>{{ $cont->id }}</td>
                    <td>{{ $cont->nombre }}</td>
                    <td>{{ $cont->nro_whatsapp }}</td>
                    <td>
                        <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@stop
