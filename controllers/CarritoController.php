<?php

namespace Controllers;

use Model\Compra;
use Model\Productos;
use Model\Pedido;
use Model\DetallePedido;
use Model\ActiveRecord;
use MVC\Router;

// Controlador del Carrito
class CarritoController
{


    public static function mostrarCarrito(Router $router)
    {
        session_start(); // Asegúrate de que la sesión esté iniciada

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            // Obtener detalles del producto
            $producto = Productos::find($product_id);

            if ($producto) {
                // Calcular el precio total para este producto
                $total_price = $producto->precio * $quantity;

                // Crear un nuevo registro de compra
                $compra = new Compra([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'total_price' => $total_price
                ]);
                $compra->guardar();
            }

            header('Location: /carrito');
            exit();
        }

        // Obtener todos los registros de compras
        $compras = Compra::all();

        $cart = [];
        foreach ($compras as $compra) {
            $producto = Productos::find($compra->product_id);
            if ($producto) {
                $cart[] = [
                    'product' => $producto,
                    'quantity' => $compra->quantity,
                    'total_price' => $compra->total_price
                ];
            }
        }

        $router->render('/paginas/carrito/carrito', ['cart' => $cart]);
    }



    public static function finalizarCompra(Router $router)
    {
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
    public static function eliminarProducto(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['producto_id'];


            Compra::eliminarPorID($product_id);

            header('Location: /carrito');
            exit();
        }
    }
    public static function eliminarTodos(Router $router)
    {
        session_start();


        Compra::eliminarTodos();


        header('Location: /carrito');
        exit();
    }
    public static function mostrarCheckout(Router $router)
    {
        session_start();

        // Obtener todos los registros de compras
        $compras = Compra::all();

        $cart = [];
        foreach ($compras as $compra) {
            $producto = Productos::find($compra->product_id);
            if ($producto) {
                $cart[] = [
                    'product' => $producto,
                    'quantity' => $compra->quantity,
                    'total_price' => $compra->total_price
                ];
            }
        }
        $router->render('/paginas/carrito/checkout', ['cart' => $cart]);
    }
    public static function procesarCompra(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            Compra::eliminarTodos();


            echo "<script>alert('Compra realizada. Gracias por su compra.');</script>";


            header('Location: /carrito');
            exit();
        } else {

            echo "Error: No se recibieron datos de pago.";
        }
    }
}
