<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function enviarMensajeTexto()
    {
        $token = "EAAVjsZBdnm3EBQJUKqPy4zyijpPXyjTVQa7l8otneNDzCu2gYrZB2viTNvTMvs2ofilDFTGdol7mm7PpOMJFm0uBaRTE58kFIZA2pyHT5kJ7OdLs3ZCUHivPKzGlRA7A7lUIj5sDqCj6s8Ipw7ZBs3LBwWNj9GZAH0znhLvphobi5qQg5TbZBjbdn6rKo6hKDmAvCet7ufXnfNZBS5PT17qehe03GtZAXBjXWgm36FiBljXJEEQ9TGn1OxZBBiEiEE6yPlachZCQzSuQBcarkZA2aht1ScZBX";
        $phone_ID = "388467921024360";

        Http::withToken($token)->post("https://graph.facebook.com/v22.0/388467921024360/messages", [

            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => "59173277937",
            "type" => "text",
            "text" => [
                "preview_url" => true,
                "body" => "Hola desde Whatsapp Cloud API"
            ]

        ]);
    }

    public function enviarMensajeBotones()
    {
        $token = "EAAVjsZBdnm3EBQJUKqPy4zyijpPXyjTVQa7l8otneNDzCu2gYrZB2viTNvTMvs2ofilDFTGdol7mm7PpOMJFm0uBaRTE58kFIZA2pyHT5kJ7OdLs3ZCUHivPKzGlRA7A7lUIj5sDqCj6s8Ipw7ZBs3LBwWNj9GZAH0znhLvphobi5qQg5TbZBjbdn6rKo6hKDmAvCet7ufXnfNZBS5PT17qehe03GtZAXBjXWgm36FiBljXJEEQ9TGn1OxZBBiEiEE6yPlachZCQzSuQBcarkZA2aht1ScZBX";
        $phone_ID = "388467921024360";

        Http::withToken($token)->post("https://graph.facebook.com/v22.0/388467921024360/messages", [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => "59173277937",
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                // "header" => "Mi cabecera",
                "body" => [
                    "text" => "Texto body"
                ],
                "footer" => [
                    "text" => "footer"
                ],
                "action" => [
                    "buttons" => [
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "btn1",
                                "title" => "Boton 1"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "btn2",
                                "title" => "Boton 2"
                            ]
                        ]

                    ]
                ]
            ]
        ]);
    }


    public function enviarMensajeLista()
    {
        $token = "EAAVjsZBdnm3EBQJUKqPy4zyijpPXyjTVQa7l8otneNDzCu2gYrZB2viTNvTMvs2ofilDFTGdol7mm7PpOMJFm0uBaRTE58kFIZA2pyHT5kJ7OdLs3ZCUHivPKzGlRA7A7lUIj5sDqCj6s8Ipw7ZBs3LBwWNj9GZAH0znhLvphobi5qQg5TbZBjbdn6rKo6hKDmAvCet7ufXnfNZBS5PT17qehe03GtZAXBjXWgm36FiBljXJEEQ9TGn1OxZBBiEiEE6yPlachZCQzSuQBcarkZA2aht1ScZBX";
        $phone_ID = "388467921024360";

        Http::withToken($token)->post("https://graph.facebook.com/v22.0/388467921024360/messages",[
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => "59173277937",
            "type" => "interactive",
            "interactive" => [
                "type" => "list",
                "header" => [
                    "type" => "text",
                    "text" => "Hola, Bienvenido"
                ],
                "body" => [
                    "text" => "Este es un mensaje de ejemplo"
                ],
                "footer" => [
                    "text" => "saludos..."
                ],
                "action" => [
                    "button" => "Selecciona",
                    "sections" => [
                        [
                            "title" => "Primera opción",
                            "rows" => [
                                [
                                    "id" => "li1",
                                    "title" => "Opción 1",
                                    "description" => "prueba uno"
                                ],
                                [
                                    "id" => "li2",
                                    "title" => "Opción 2",
                                    "description" => "prueba dos"
                                ],
                                [
                                    "id" => "li3",
                                    "title" => "Opción 3",
                                    "description" => "prueba tres"
                                ],
                                [
                                    "id" => "li4",
                                    "title" => "Opción 4",
                                    "description" => "prueba cuatro"
                                ]
                                // Más filas aquí
                            ]
                        ]
                        // Más secciones aquí
                    ]
                ]
            ]
        ]
        );
    }
}
