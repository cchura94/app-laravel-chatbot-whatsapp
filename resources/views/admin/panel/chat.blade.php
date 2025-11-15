<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con OpenAI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .messages {
            margin-bottom: 10px;
            max-height: 400px;
            overflow-y: auto;
        }

        .message {
            margin: 5px 0;
        }

        .message.user {
            color: blue;
        }

        .message.bot {
            color: green;
        }

        input[type="text"] {
            width: 80%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>Chat con OpenAI</h1>
        <div class="messages" id="messages">
            <!-- Aquí se mostrarán los mensajes -->
        </div>

        <form id="chat-form">
            @csrf
            <input type="text" name="mensaje" id="mensaje" placeholder="Escribe un mensaje..." required>
            <input type="submit" value="Enviar">
        </form>
    </div>

    <script>
        // Obtener el formulario y el contenedor de mensajes
        const form = document.getElementById('chat-form');
        const messagesContainer = document.getElementById('messages');
        const inputMensaje = document.getElementById('mensaje');

        // Función para mostrar los mensajes en el chat
        function displayMessage(content, role) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.classList.add(role);
            messageElement.innerHTML = `<strong>${role === 'user' ? 'Tú' : 'Bot'}:</strong> ${content}`;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Desplazar hacia abajo
        }

        // Manejar el envío del formulario
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            
            const mensaje = inputMensaje.value.trim();

            if (!mensaje) return; // No hacer nada si el mensaje está vacío

            // Mostrar mensaje del usuario
            displayMessage(mensaje, 'user');

            // Limpiar el campo de texto
            inputMensaje.value = '';

            // Obtener el token CSRF para la solicitud
            const csrfToken = document.querySelector('input[name="_token"]').value;

            try {
                // Hacer la solicitud con fetch
                const response = await fetch('/api/openai/text', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        mensaje: mensaje
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    // Mostrar la respuesta del bot
                    displayMessage(data.response, 'bot');
                } else {
                    // En caso de error en la respuesta
                    displayMessage('Ocurrió un error al procesar tu solicitud. Intenta de nuevo.', 'bot');
                }

            } catch (error) {
                // Manejo de error en la solicitud
                displayMessage('No se pudo conectar al servidor. Intenta más tarde.', 'bot');
            }
        });
    </script>
</body>
</html>
