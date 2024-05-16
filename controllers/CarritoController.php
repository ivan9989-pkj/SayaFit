<?php

namespace Controllers;

use Model\Carrito;
use Model\Producto;
use Model\Pedido;
use Model\DetallePedido;

class CarritoController {
    public function agregarProducto($idProducto, $cantidad) {
        session_start();
        $carrito = new Carrito();
        $carrito->agregarProducto($idProducto, $cantidad);
        header('Location: /carrito');
    }

    public function eliminarProducto() {
        session_start();
        $idProducto = $_POST['idProducto'];
        $carrito = new Carrito();
        $carrito->eliminarProducto($idProducto);
        header('Location: /carrito');
    }

    public function actualizarCantidad() {
        session_start();
        $idProducto = $_POST['idProducto'];
        $cantidad = $_POST['cantidad'];
        $carrito = new Carrito();
        $carrito->actualizarCantidad($idProducto, $cantidad);
        header('Location: /carrito');
    }

    public function mostrarCarrito() {
        session_start();
        $carrito = new Carrito();
        $productosEnCarrito = $carrito->obtenerProductos();
        require_once 'views/carrito/carrito.php';
    }

    public function finalizarCompra() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $metodo_pago = $_POST['metodo_pago'];
            $id_usuario = $_SESSION['usuario_id']; // Asumiendo que el usuario está logueado

            // Crear el pedido
            $pedido = new Pedido([
                'id_usuario' => $id_usuario,
                'nombre' => $nombre,
                'direccion' => $direccion,
                'metodo_pago' => $metodo_pago
            ]);
            $id_pedido = $pedido->guardar();

            // Obtener los productos del carrito
            $carrito = new Carrito();
            $productosEnCarrito = $carrito->obtenerProductos();

            // Guardar los detalles del pedido
            foreach ($productosEnCarrito as $producto) {
                $detallePedido = new DetallePedido([
                    'id_pedido' => $id_pedido,
                    'id_producto' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['precio']
                ]);
                $detallePedido->guardar();
            }

            // Vaciar el carrito después de finalizar la compra
            $carrito->vaciarCarrito();

            echo "Compra finalizada. Gracias por su compra.";
        } else {
            $carrito = new Carrito();
            $productosEnCarrito = $carrito->obtenerProductos();
            require_once 'views/carrito/finalizar_compra.php';
        }
    }
}
