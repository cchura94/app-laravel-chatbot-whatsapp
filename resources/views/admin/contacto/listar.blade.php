@extends('adminlte::page')


@section('title', 'Lista de Contactos')

@section('content_header')
<h1>Lista de Contactos</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <a href="/contacto/create" class="btn btn-primary">Nuevo Contacto</a>

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
                                <input type="text" name="message" class="form-control" id="mensaje-{{ $cont->id }}">
                                <input type="submit" value="Enviar" class="btn btn-success">
                                <button type="button" onclick="enviarMensaje('{{ $cont->nro_whatsapp }}', '{{$cont->id}}')" class="btn btn-warning">Enviar Javascript</button>
                                <button type="button" onclick="enviarMensajeConIA('{{ $cont->nro_whatsapp }}', '{{$cont->id}}')" class="btn btn-info ml-2">Enviar con IA</button>


                                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{$cont->id}}">
  Historial Mensaje
</button>

<!-- Modal -->
<div class="modal fade" id="modal-{{$cont->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mensajes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Mensaje</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cont->mensajes as $msg)
                <tr>
                    <td>{{ $msg->mensaje }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
    async function enviarMensaje(number, id) {

        // const number = document.getElementById("number").value;
        const type = document.getElementById("type").value;
        const mensaje = document.getElementById(`mensaje-${id}`).value;

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

    async function enviarMensajeConIA(number, id) {

        // const number = document.getElementById("number").value;
        const type = document.getElementById("type").value;
        const mensaje = document.getElementById(`mensaje-${id}`).value;

        // procesar con IA
        fetch("/api/openai/text", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    "mensaje": mensaje
                }),
            }).then(res => res.json())
            .then(async json => {
                let mensajeProcesadoConIA = json.response;

                // enviar a whatsapp

                await fetch("/api/mensaje/enviar", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        "number": number,
                        "type": "text",
                        "message": mensajeProcesadoConIA
                    }),
                });

            });



    }
</script>