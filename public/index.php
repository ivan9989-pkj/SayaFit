<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\PaginasController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\ProductoController;
$router=new Router();

/*Admin*/ 
$router->get('/admin', [ProductoController::class, 'index']);
$router->get('/propiedades/crear', [ProductoController::class, 'crear']);
$router->post('/propiedades/crear', [ProductoController::class, 'crear']);
$router->get('/propiedades/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [ProductoController::class, 'eliminar']);

/* Paginas */
$router->get('/',[PaginasController::class, 'index']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/productos', [PaginasController::class, 'productos']);

/*Login */
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/registro', [LoginController::class, 'registro']);
$router->post('/registro', [LoginController::class, 'registro']);
$router->get('/logout', [LoginController::class, 'logout']);


$router->comprobarRutas();
