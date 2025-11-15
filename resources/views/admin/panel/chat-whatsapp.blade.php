<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje a WhatsApp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
        }

        .form-container {
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 80%;
            max-width: 400px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .whatsapp-btn {
            background-color: #25D366; /* Color verde de WhatsApp */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            width: 80%;
            max-width: 400px;
        }

        .whatsapp-btn:hover {
            background-color: #128C7E; /* Color verde oscuro de WhatsApp */
        }

        .whatsapp-btn:active {
            background-color: #075E54; /* Color verde más oscuro */
        }
    </style>
</head>
<body>

    <h1>Envia un Mensaje a WhatsApp</h1>

    <div class="form-container">
        <!-- Formulario con input para el mensaje -->
        <input type="text" id="mensaje" placeholder="Escribe tu mensaje...">
        <!-- Botón para enviar a WhatsApp -->
        <a href="#" class="whatsapp-btn" id="whatsappBtn">Enviar a WhatsApp</a>
    </div>

    <script>
        // Obtener el botón de WhatsApp y el campo de texto
        const whatsappBtn = document.getElementById('whatsappBtn');
        const mensajeInput = document.getElementById('mensaje');

        // Función para redirigir a WhatsApp con el mensaje
        whatsappBtn.addEventListener('click', async function(e) {
            e.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

            const mensaje = mensajeInput.value; // Obtener y codificar el mensaje

            // Número de WhatsApp de destino (debes poner el número correcto, por ejemplo, +591 es el prefijo para Bolivia)
            const numeroWhatsApp = "59173277937"; // Reemplaza con el número de teléfono real

            await fetch("/api/mensaje/enviar", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    "number": numeroWhatsApp,
                    "type": "text",
                    "message": mensaje
                }), 
            });

        });
    </script>

</body>
</html>
