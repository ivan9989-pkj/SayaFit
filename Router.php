<?php

namespace MVC;

class Router{

    public $rutasGET=[];
    public $rutasPOST=[];
    
    public function get($url,$fn){
        $this->rutasGET[$url]=$fn;
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

        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos=[] ){
        foreach($datos as $key=>$value){
         $$key=$value;
        }

        ob_start();
        
        include __DIR__."/views/$view.php";
        $contenido=ob_get_clean();
        include __DIR__."/views/layout.php";
    }
}