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
                        <form action="/api/mensaje/enviar" method="post">
                            <input type="hidden" name="number" value="{{ $cont->nro_whatsapp }}" id="number">
                            <input type="hidden" name="type" value="text" id="type">
                            <div class="input-group">
                                <input type="text" name="message" class="form-control" id="mensaje">
                                <input type="submit" value="Enviar" class="btn btn-success">
                                <button type="button" onclick="enviarMensaje('{{ $cont->nro_whatsapp }}')" class="btn btn-warning">Enviar Javascript</button>
                            </div>
                        </form>
                        <!--
                        <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@stop

<script>
    async function enviarMensaje(number){
        
        // const number = document.getElementById("number").value;
        const type = document.getElementById("type").value;
        const mensaje = document.getElementById("mensaje").value;

        await fetch("/api/mensaje/enviar", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                "number": number,
                "type": "text",
                "message": mensaje
            }), 
        });

    }
</script>