<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{
    public function recibirMensajeWebhook(Request $request)
    {

        $eventType = $request->input('event');

        if ($eventType !== 'messages.upsert') {
            return response()->json(["estado" => "Sin data"]);
        }

        $data = $request->input('data', []);

        // ignorar mensajes enviados por nosotros
        if ($data['key']['fromMe'] ?? false) {
            return response()->json(['estado' => 'from me']);
        }

        $numero = $data['key']['remoteJid'] ?? null;
        $message = $data['message']['conversation'] ?? null;

        if (!$numero || !$message) {
            return response()->json(['estado' => "sin number"]);
        }

        $numeroLimpio = str_replace("@s.whatsapp.net", "", $numero);


        $menuData = [
            "main" => [
                "mensaje" => "👋 ¡Hola! Soy el asistente de *El Buen Sabor*. ¿En qué puedo ayudarte hoy?",
                "options" => [
                    "A" => [
                        "text" => "🍽️ Ver Menú del Día",
                        "respuesta" => [
                            "tipo" => "image",
                            "msg" => [
                                "url" => "https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg",
                                "caption" => "📋 *Menú del Día*\nAquí tienes nuestros platos disponibles hoy."
                            ]
                        ]
                    ],
                    "B" => [
                        "text" => "📦 Servicios del Restaurante",
                        "submenu" => "servicios"
                    ],
                    "C" => [
                        "text" => "💬 Hablar con un asesor",
                        "respuesta" => [
                            "tipo" => "text",
                            "msg" => [
                                "text" => "📞 Un asesor se comunicará contigo pronto.\nTeléfono: +59170000000"
                            ]
                        ]
                    ]
                ]
            ],
        
            "servicios" => [
                "mensaje" => "🍽️ Estos son nuestros servicios",
                "options" => [
                    "1" => [
                        "text" => "🚗 Delivery a domicilio",
                        "respuesta" => [
                            "tipo" => "document",
                            "msg" => [
                                "url" => "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf",
                                "fileName" => "Información_Delivery.pdf"
                            ]
                        ]
                    ],
                    "2" => [
                        "text" => "🎉 Reservas para eventos",
                        "respuesta" => [
                            "tipo" => "image",
                            "msg" => [
                                "url" => "https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg",
                                "caption" => "🎊 Organizamos tus eventos especiales: cumpleaños, aniversarios y más."
                            ]
                        ]
                    ],
                    "3" => [
                        "text" => "📚 Carta completa del restaurante",
                        "respuesta" => [
                            "tipo" => "document",
                            "msg" => [
                                "url" => "https://www.orimi.com/pdf-test.pdf",
                                "fileName" => "Carta_Completa.pdf"
                            ]
                        ]
                    ],
                    "4" => [
                        "text" => "🔙 Volver al menú principal",
                        "submenu" => "main"
                    ]
                ]
            ]
        ];
        

        /*
        $menuData = [
            "main" => [
                "mensaje" => "Hola soy un bot, en que puedo ayudarle",
                "options" => [
                    "A" => [
                        "text" => 'Ver promociones del Mes',
                        "respuesta" => [
                            "tipo" => "image",
                            "msg" => [
                                "url" => "https://back.blumbit.net/api/public/Posts%20.NET%20CORE%20Y%20ANGULAR.jpg",
                                "caption" => "Estas son nuestras promociones del mes de Noviembre"
                            ]
                        ]
                    ],
                    "B" => [
                        "text" => "Nuestros servicios",
                        "submenu" => "servicios"

                    ],
                    "C" => [
                        "text" => "Hablar con un asesor",
                        "respuesta" => [
                            "tipo" => "text",
                            "msg" => [
                                "text" => "Un asesor se comunicará contigo, Telefono: +59173277937"
                            ]
                        ]
                    ],
                ]
            ],
            "servicios" => [
                "mensaje" => "Nuestros servicios",
                "options" => [
                    "1" => [
                        "text" => 'Desarrollo de Software',
                        "respuesta" => [
                            "tipo" => "document",
                            "msg" => [
                                "url" => "https://www.gob.mx/cms/uploads/attachment/file/93387/Temarios.pdf",
                                "fileName" => "nuestro catalogo"
                            ]
                        ]
                    ],
                    "2" => [
                        "text" => 'Diseño de Páginas',
                        "respuesta" => [
                            "tipo" => "image",
                            "msg" => [
                                "url" => "https://back.blumbit.net/api/public/Posts%20.NET%20CORE%20Y%20ANGULAR.jpg",
                                "caption" => ""
                            ]
                        ]
                    ],
                    "3" => [
                        "text" => "Volver",
                        "submenu" => "main"

                    ]
                ]
            ]
        ];
        */

        $contacto = Contacto::firstOrCreate(["nro_whatsapp" => $numero], ["menu_actual" => "main"]);

        $menuActual = $contacto->menu_actual;
        $menu = $menuData[$menuActual];

        if ($message === "hola" || $message === "Hola" || $message === "HOLA") {
            $contacto->menu_actual = "main";
            $contacto->save();
            $this->enviarMenu($numero, $menuData["main"]);
            return response()->json(["estado" => "menu enviado"]);
        }

        $opcion = strtoupper(trim($message));
        $seleccion = $menu["options"][$opcion] ?? null;

        if (!$seleccion) {
            // enviar opcion invalida
        }

        if (isset($seleccion["respuesta"])) {
            $resp = $seleccion["respuesta"];
            $tipo = $resp["tipo"];
            $msg = $resp["msg"];

            if ($tipo === "text") {
                $instancia = 'aplicacion1';
                Http::withHeaders([
                    'Content-Type' => "application/json",
                    'apikey' => '9A8851D24A05-4058-AABD-4DA74214CA35'
                ])->post("http://127.0.0.1:7777/message/sendText/{$instancia}", [
                    "number" => $numero,
                    "text" => $msg["text"]
                ]);
            }

            if ($tipo === "image") {
                $instancia = 'aplicacion1';
                Http::withHeaders([
                    'Content-Type' => "application/json",
                    'apikey' => '9A8851D24A05-4058-AABD-4DA74214CA35'
                ])->post("http://127.0.0.1:7777/message/sendMedia/{$instancia}", [
                    "number" => $numero,
                    "mediatype" => "image",
                    "media" => $msg["url"],
                    "caption" => $msg["caption"]
                ]);
            }

            if ($tipo === "document") {
                $instancia = 'aplicacion1';
                Http::withHeaders([
                    'Content-Type' => "application/json",
                    'apikey' => '9A8851D24A05-4058-AABD-4DA74214CA35'
                ])->post("http://127.0.0.1:7777/message/sendMedia/{$instancia}", [
                    "number" => $numero,
                    "mediatype" => "document",
                    "media" => $msg["url"],
                    "fileName" => $msg["fileName"]
                ]);
            }
        }

        if(isset($seleccion["submenu"])){
            $contacto->menu_actual = $seleccion["submenu"];
            $contacto->save();
            $this->enviarMenu($numero, $menuData[$seleccion["submenu"]]);
        }

        return response()->json(["status" => "OK"]);
    }

    public function enviarMenu($numero, $menu)
    {
        $optionText = "";

        foreach ($menu["options"] as $key => $opt) {
            $optionText .= "- 👉 *{$key}*: {$opt["text"]}\n";
        }

        $menuMensaje = "{$menu['mensaje']}\n\n{$optionText}\n\n> *Indícanos una opción*";


        $baseUrl = "http://127.0.0.1:7777";
        $instancia = 'aplicacion1';
        $token = '9A8851D24A05-4058-AABD-4DA74214CA35';

        $url = $baseUrl . "/message/sendText/{$instancia}";

        Http::withHeaders([
            'Content-Type' => "application/json",
            'apikey' => $token
        ])->post($url, [
            "number" => $numero,
            "text" => $menuMensaje
        ]);
    }
}
