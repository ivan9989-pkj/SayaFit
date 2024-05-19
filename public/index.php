<?php 

    require_once __DIR__.'/../includes/app.php';

    use MVC\Router;
    use Controllers\AdminControllers;
    use Controllers\PaginasController;
    use Controllers\CategoriaController;
    use Controllers\LoginControllers;
    use Controllers\CarritoController;
    
    // Funcionamiento de las Rutas 

    $router= new Router();

    // Admin
    $router->get('/admin', [AdminControllers::class, 'admin']);
    $router->get('/admin/crear' , [AdminControllers::class , 'crear']);
    $router->post('/admin/crear' , [AdminControllers::class , 'crear']);
    $router->get('/admin/actualizar' , [AdminControllers::class , 'actualizar']);
    $router->post('/admin/actualizar' , [AdminControllers::class , 'actualizar']);
    $router->get('/admin/eliminar', [AdminControllers::class , 'eliminar']);
    $router->post('/admin/eliminar', [AdminControllers::class , 'eliminar']);

    // categoria 

    $router->get('/admin/categoria/crear' , [CategoriaController::class , 'crear']);
    $router->post('/admin/categoria/crear' , [CategoriaController::class , 'crear']);
    $router->get('/admin/categoria/actualizar' , [CategoriaController::class , 'actualizar']);
    $router->post('/admin/categoria/actualizar' , [CategoriaController::class , 'actualizar']);
    $router->get('/admin/categoria/eliminar' , [CategoriaController::class , 'eliminar']);
    $router->post('/admin/categoria/eliminar' , [CategoriaController::class , 'eliminar']);
    
    // Paginas 

    $router->get('/',[PaginasController::class , 'index']);
    $router->get('/contacto',[PaginasController::class , 'contacto']);
    $router->get('/categorias',[PaginasController::class , 'categorias']);
    $router->get('/nosotros' , [PaginasController::class , 'nosotros']);
    $router->get('/nutricion', [PaginasController::class , 'nutricion']);
    $router->get('/mantenimiento', [PaginasController::class , 'mantenimiento']);
    $router->get('/error',[PaginasController::class , 'error']);


    
    // Carrito
    $router->get('/carrito', [CarritoController::class, 'mostrarCarrito']);
    $router->post('/carrito', [CarritoController::class, 'mostrarCarrito']);
    $router->post('/carrito/agregar', [CarritoController::class, 'agregarProducto']);
    $router->post('/carrito/eliminar', [CarritoController::class, 'eliminarProducto']);
    $router->post('/carrito/actualizar', [CarritoController::class, 'actualizarCantidad']);
    $router->post('/carrito/finalizar', [CarritoController::class, 'finalizarCompra']);
    $router->post('/carrito/eliminar-todos', [CarritoController::class, 'eliminarTodos']);
    $router->post('/carrito/checkout', [CarritoController::class, 'mostrarCheckout']);
    $router->post('/carrito/finalizar', [CarritoController::class, 'procesarCompra']);
    //Paginas-categorias

    $router->get('/categorias/ropa_hombre' , [PaginasController::class, 'ropa_hombre']);
    $router->get('/categorias/ropa_mujer', [PaginasController::class,'ropa_mujer' ]);
    $router->get('/categorias/calzado_hombre',[PaginasController::class, 'calzado_hombre']);
    $router->get('/categorias/calzado_mujer',[PaginasController::class, 'calzado_mujer']);
    $router->get('/categorias/material_fitness',[PaginasController::class, 'material_fitness']);

    // kit-entrenamientos
    $router->get('/kit-entrenamiento' , [PaginasController::class, 'kit_entrenamiento']);
    $router->get('/kit-entrenamiento/calc' , [PaginasController::class, 'calc']);
    $router->post('/kit-entrenamiento/calc' , [PaginasController::class, 'calc']);
    $router->get('/kit-entrenamiento/rutinas' , [PaginasController::class, 'rutinas']);

    // texto-legales

    $router->get('/textos/aviso_legal' , [PaginasController::class , 'aviso_legal']);
    $router->get('/textos/cookies' , [PaginasController::class , 'cookies']);
    $router->get('/textos/politica' , [PaginasController::class , 'politica']);

    // Nutrición

    $router->get('/nutricion/alimentacion' , [PaginasController::class, 'alimentacion']);
    $router->get('/nutricion/barritas' , [PaginasController::class , 'barritas']);
    $router->get('/nutricion/bebidas-y-suplementos', [PaginasController::class , 'bebidas_y_suplementos']);
    $router->get('/nutricion/geles-energetica', [PaginasController::class , 'geles']);
    $router->get('/nutricion/mezcladores', [PaginasController::class , 'mezcladores']);
    $router->get('/nutricion/te-e-infusiones', [PaginasController::class, 'te']);

    //Login

    $router->get('/login' , [LoginControllers::class, 'login']);
    $router->post('/login' , [LoginControllers::class, 'login']);
    $router->get('/registro' , [LoginControllers::class, 'registro']);
    $router->post('/registro' , [LoginControllers::class, 'registro']);
    $router->get('/logout', [LoginControllers::class, 'logout']);


    $router->comprobarRutas();
