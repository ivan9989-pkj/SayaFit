<?php
    namespace Controllers;

    use Model\Producto;
    use MVC\Router;


    class PaginasController{
        public static function index(Router $router){

            $productos=Producto::get(3);

            $router->render("paginas/index",[
                'inicio'=>true,
                'productos'=>$productos
            ]);
        }

        public static function contacto( Router $router ) {
            $router->render('paginas/contacto', [
    
            ]);
        }


        public static function nosotros( Router $router ) {
            $router->render('paginas/nosotros', [
    
            ]);
        }


        public static function productos( Router $router ) {
            $datos=Producto::all();

            $router->render('paginas/productos',[
                'datos'=>$datos
            ]);
        }

        public static function login( Router $router ) {
            
        }

    }