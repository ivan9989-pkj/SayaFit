<?php

namespace Model;

class Carrito {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function agregarProducto($idProducto, $cantidad) {
        if (isset($_SESSION['carrito'][$idProducto])) {
            $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
        } else {
            $producto = Producto::find($idProducto);
            if ($producto) {
                $_SESSION['carrito'][$idProducto] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'cantidad' => $cantidad
                ];
            }
        }
    }

    public function eliminarProducto($idProducto) {
        if (isset($_SESSION['carrito'][$idProducto])) {
            unset($_SESSION['carrito'][$idProducto]);
        }
    }

    public function actualizarCantidad($idProducto, $cantidad) {
        if (isset($_SESSION['carrito'][$idProducto])) {
            $_SESSION['carrito'][$idProducto]['cantidad'] = $cantidad;
        }
    }

    public function obtenerProductos() {
        return $_SESSION['carrito'];
    }

    public function vaciarCarrito() {
        unset($_SESSION['carrito']);
    }
}
