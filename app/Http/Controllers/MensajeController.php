<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MensajeController extends Controller
{
    public function funEnviarMensaje(Request $request){
        
        $request->validate([
            "number" => "required|string",
            "type" => "required|string|in:text,image,document,video,audio",
            "message" => "nullable|string",
            "file_url" => "nullable|url"
        ]);

        // url evolution api
        $baseurl = "http://127.0.0.1:7777";
        $instancia = "aplicacion1";
        $token = "9A8851D24A05-4058-AABD-4DA74214CA35";

        // $endpointText = "/message/sendText/{$instancia}";
        $endpoints = [
            'text' => "/message/sendText/{$instancia}",
            'image' => "/message/sendMedia/{$instancia}",
            'document' => "/message/sendMedia/{$instancia}"
        ];

        // $url = $baseurl . $endpointText;
        $url = $baseurl . $endpoints[$request->type];
        

        $payload = ["number" => $request->number];
        $message = $request->message ?? '';
        $file_url = $request->file_url ?? null;

        switch ($request->type) {
            case 'text':
                $payload += [
                    'text' => $message
                ];
                break;
            case 'image':
                $payload += [
                    'mediatype' => 'image',
                    'caption' => $message,
                    'media' => $file_url
                ];
                break;
            case 'document':
                $payload += [
                    'mediatype' => 'document',
                    'caption' => $message,
                    'media' => $file_url
                ];
                break;
            
            default:
                # code...
                break;
        }

        // enviar mensaje
        $respuesta = Http::withHeaders([
            'Content-Type' => 'application/json',
            'apikey' => $token
        ])->post($url, $payload);

        $contacto = Contacto::where('nro_whatsapp', $request->number)->first();

        $msg = new Mensaje();
        $msg->mensaje = $message;
        $msg->generado_por = "SYSTEM";
        $msg->from_me = true;
        $msg->contacto_id = $contacto->id;
        $msg->save();
                
        return response()->json([
            'status' => $respuesta->status(),
            'response' => $respuesta->json()
        ]);

    }

    public function panelWhatsapp(Request $request){
        return view("admin.panel.chat-whatsapp");
    }
}
