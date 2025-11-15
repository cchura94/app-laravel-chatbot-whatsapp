<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenaiController extends Controller
{

    /*
    public function funRespuestaIA(Request $request)
    {

        $contactos = Contacto::get();
        $contactos_lista =json_encode($contactos);

        $respuesta = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer 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"
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-4.1",
            "messages" => [
                [
                    "role" => "system",
                    "content" => 'Debes Otorgar información a los clientes de la lista de trabajadores. los clientes necesitan saber sus datos de contacto de los trbajadores: la lista de contactos es: '.$contactos_lista
                ],
                [
                    "role" => "user",
                    "content" => $request->mensaje
                ]
            ]
        ]);

        return response()->json([
            'status' => $respuesta->status(),
            'response' => $respuesta['choices'][0]['message']['content'],
        ]);
    }

    */

    
    public function funRespuestaIA(Request $request)
    {


        $respuesta = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer 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"
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-4.1",
            "messages" => [
                [
                    "role" => "system",
                    "content" => 'Necesitas dar información y pasos que deben seguir las empresas para apertura de una empresa. debes responder en no más de 50 palabras. estos son los pasos: 
                        1. SEPREC (Servicio de Registro de Comercio)

¿Qué hace?
Otorga la Matrícula de Comercio, que permite adquirir la calidad de comerciante con reconocimiento legal.

¿Para qué sirve?
Permite que una persona o entidad tenga el reconocimiento legal del Estado para operar como comerciante.

Pasos para la Inscripción:

Empresa Unipersonal: Persona natural que ejerce el comercio de forma individual.

Sociedad de Responsabilidad Limitada (SRL): Sociedad con responsabilidad limitada de los socios.

Sociedad Anónima (SA): Sociedad con capital representado por acciones.

Guías de trámite disponibles para cada tipo de empresa, detallando requisitos, procedimientos y costos.

2. Servicio Nacional de Impuestos Nacionales (SIN)

¿Qué hace?
Inscribe al Padrón Nacional de Contribuyentes y otorga el NIT (Número de Identificación Tributaria).

¿Para qué sirve?
Permite estar registrado y operar legalmente en el país.

Requisitos por Régimen:

Régimen General: Incluye requisitos como documento de identidad, factura de energía eléctrica, y registro en SEPREC.

Régimen Tributario Simplificado: Para artesanos, comerciantes minoristas y vivanderos con un capital de hasta 60,000 Bs.

Régimen Agropecuario Unificado: Para personas naturales y organizaciones de pequeños productores, con requisitos específicos de documentos y ubicación.

Procedimiento:

Entregar los documentos y formulario en el SIN.

Captura de información por un funcionario.

Revisión de reporte preliminar.

Firma y entrega del NIT.

3. Licencia de Funcionamiento

¿Qué hace?
Autoriza la apertura de una actividad económica.

¿Para qué sirve?
Permite operar legalmente a nivel municipal.

Requisitos:

Actividades Económicas en General: Declaración jurada, cédula de identidad, factura de luz, NIT y croquis del establecimiento.

Actividades Industriales: Requiere adicionales como plano del establecimiento, registro ambiental, autorización del propietario del inmueble, y otros certificados según el tipo de industria (alimentaria, ruidos, etc.).

Lugar de atención: Plataforma de atención al público en el Área de Ingresos Tributarios y Licencias de Funcionamiento.

4. Caja Nacional de Salud

¿Qué hace?
Afiliación del empleador y trabajador al sistema de salud.

¿Para qué sirve?
Brinda cobertura médica para enfermedades y accidentes comunes'
                ],
                [
                    "role" => "user",
                    "content" => $request->mensaje
                ]
            ]
        ]);

        return response()->json([
            'status' => $respuesta->status(),
            'response' => $respuesta['choices'][0]['message']['content'],
        ]);
    }
    


    public function panelChat()
    {
        return view("admin.panel.chat");
    }
}
