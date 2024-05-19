<?php


$mostrarPie = false;

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/css/productos.css">
    <title>Checkout - Proceder al Pago</title>
    <style>
        /* Estilos para el modal lo puedes pasar a un archivo css */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #1f2029;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #000;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos para la notificación */
        .notification {
            display: none;
            background-color: green;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            z-index: 1;
            width: 100%;
            top: 30%;
            transform: translateY(-50%);
        }

        /* Estilos para el botón de cerrar notificación */
        .close-notification {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body class="body-checkout">
    <h1>Checkout - Proceder al Pago</h1>
    <?php if (!empty($cart)) : ?>
        <table class="invoice">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cart as $cart_item) :
                    $product = $cart_item['product'];
                    $quantity = $cart_item['quantity'];
                    $total += $cart_item['total_price'];
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product->nombre_producto); ?></td>
                        <td><?php echo htmlspecialchars($product->precio); ?>€</td>
                        <td><?php echo htmlspecialchars($quantity); ?></td>
                        <td><?php echo htmlspecialchars($cart_item['total_price']); ?>€</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">Total del Carrito: <?php echo htmlspecialchars($total); ?>€</div>
    <?php else : ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>

    <form class="form2" action="/carrito/finalizar" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br>
        <label for="num_tarjeta">Número de Tarjeta:</label>
        <input type="text" id="num_tarjeta" name="num_tarjeta" required><br>
        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" required><br>
        <label for="cvc">CVC:</label>
        <input type="text" id="cvc" name="cvc" required><br>
        <label for="codigo_postal">Código Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal" required><br>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br>
        <!-- Agrega este botón para activar el modal -->
        <button type="button" class="finalizar-compra" onclick="mostrarModal()">Finalizar Compra</button>
    </form>

    <!-- Modal -->
    <div id="purchaseModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <p>¿Estás seguro de que deseas finalizar la compra?</p>
            <button class="finalizar-compra" onclick="finalizarCompra()">Sí</button>
            <button class="finalizar-compra" onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>

    <!-- Notificación -->
    <div id="notification" class="notification">
        <span class="close-notification" onclick="cerrarNotificacion()">&times;</span>
        <p id="notification-message"></p>
    </div>

    <script>
// Función para mostrar el modal
function mostrarModal() {
    document.getElementById('purchaseModal').style.display = 'block';
}

// Función para cerrar el modal
function cerrarModal() {
    document.getElementById('purchaseModal').style.display = 'none';
}

// Función para finalizar la compra
function finalizarCompra() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/carrito/finalizar", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Cerrar el modal
            cerrarModal();
            // Limpiar el carrito
            limpiarCarrito();
        }
    };
    // Enviar la solicitud POST
    xhr.send();
}

// Función para limpiar el carrito
function limpiarCarrito() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/carrito/eliminar-todos", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Mostrar notificación
            mostrarNotificacion("La compra ha sido realizada con éxito. ¡Gracias por su compra!");
            // Redirigir a la página del carrito después de 3 segundos
            setTimeout(function () {
                window.location.href = "/carrito";
            }, 3000);
        }
    };
    xhr.send();
}

// Función para mostrar la notificación
function mostrarNotificacion(mensaje) {
    var notificationMessage = document.getElementById("notification-message");
    notificationMessage.textContent = mensaje;
    var notification = document.getElementById("notification");
    notification.style.display = "block";
}

// Función para cerrar la notificación
function cerrarNotificacion() {
    document.getElementById("notification").style.display = "none";
}

    </script>
</body>

</html>