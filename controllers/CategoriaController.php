<?php

namespace Controllers;

use Model\Categoria;
use MVC\Router;

// Controlador de las Categorias 

class CategoriaController{

    public static function crear(Router $router){
        $errores = Categoria::getErrores();
        $categoria = new Categoria;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            /*Crea una nueva instancia*/
            $categoria = new Categoria($_POST["categorias"]);
            
            // Validar 
            $errores = $categoria->validar();

            if(empty($errores)){
                // Guarda en la base de datos 
                $resultado = $categoria->guardar();

                if($resultado){
                    header('location: /admin');
                }
            }
        }

        $router ->render('admin/categoria/crear',[
            'errores' => $errores,
            'categoria' => $categoria
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');

        // obtener los datos de la propiedad

        $categoria = Categoria::find($id);

        // Arreglo con mensajes de errores
        $errores = Categoria::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Asignar los atributos
            $args = $_POST['categorias'];
            $categoria->sincronizar($args);

            // Validación 
            $errores = $categoria->validar();

            if(empty($errores)){

                // Guardamos en la base de datos
                $resultado = $categoria->guardar();

                if($resultado){
                    header('location /admin?resultado=2');
                }
            }
        }

        $router->render('admin/categoria/actualizar' , [
                'errores' => $errores,
                'categoria' => $categoria
        ]);
    }

    public static function eliminar(Router $router){

        if($_SERVER['REQUEST_METHOD']=== "POST"){
            $tipo = $_POST['tipo'];
           

            if(validarTipoContenido($tipo)){
                //Leer el id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                //encontrar y eliminar el producto
                $categoria = Categoria::find($id);
                $resultado = $categoria->eliminar();

                if($resultado){
                    header('location: /admin?resultado=3');
                } else{
                    header('location: /admin?resultado=3');
                }
            }
        }

    }

}