<?php

namespace MVC;

require_once 'controllers/CarritoController.php';

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];
    
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->rutasGET[$currentUrl] ?? null;
        } else {
            $fn = $this->rutasPOST[$currentUrl] ?? null;
        }

        if ($fn) {
            call_user_func([new $fn[0], $fn[1]]);
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = []) {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}

$router = new Router();

$router->get('/carrito', ['CarritoController', 'mostrarCarrito']);
$router->post('/carrito/agregar', ['CarritoController', 'agregarProducto']);
$router->post('/carrito/eliminar', ['CarritoController', 'eliminarProducto']);
$router->post('/carrito/actualizar', ['CarritoController', 'actualizarCantidad']);
$router->post('/carrito/finalizar', ['CarritoController', 'finalizarCompra']);

$router->comprobarRutas();
