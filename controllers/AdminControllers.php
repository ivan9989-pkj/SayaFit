<?php


namespace Controllers;

use MVC\Router;
use Model\Productos;
use Model\Categoria;

// Controllador de Admin
class AdminControllers{

    // Index de la pagina Admin 

    public static function admin(Router $router){

        $productos=Productos::all();
        $categorias=Categoria::all();

         // Muestra mensaje condicional
         $resultado = $_GET['resultado'] ?? null;

        $router->render("admin/index",[
            'productos' => $productos,
            'resultado' => $resultado,
            'categorias' => $categorias
        ]);
    }

    // Funcionamiento de la pagina crear en admin

    public static function crear(Router $router) {
        $errores = Productos::getErrores();
        $producto = new Productos;
        $categorias = Categoria::all();
        
        // Ejecutar el código después de que el usuario envíe el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia de Producto con datos del formulario
            $producto = new Productos($_POST['producto']);
            
            // Manejo de la Imagen
            $carpetaImagenes = '../public/build/imagenes/';
    
            // Verificar si se cargó una imagen
            if ($_FILES['producto']['error']['imagen'] === UPLOAD_ERR_OK) {
                $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
                $rutaImagen = $carpetaImagenes . $nombreImagen;
    
                // Mover la imagen al directorio de imágenes
                if (move_uploaded_file($_FILES['producto']['tmp_name']['imagen'], $rutaImagen)) {
                    $producto->setImagen($nombreImagen);
                } else {
                    // Si no se puede mover la imagen, agregar un error
                    $errores[] = "Hubo un error al subir la imagen";
                }
            }
            
            // Validar
            $errores = $producto->validar();
    
            if (empty($errores)) {
                // Guardar en la base de datos 
                $resultado = $producto->guardar('producto');
                if ($resultado) {
                    
                    // Redireccionar al usuario después de guardar el producto
                    header('location: /admin?resultado=1');
                    
                }
            }
        }
        
        // Renderizar el formulario de creación con los datos y errores
        $router->render("admin/crear", [
            'errores' => $errores,
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }
    
    // Funcionamiento de la pagina actualizar en admin
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $errores = Productos::getErrores();
        $producto = Productos::find($id);
        $categorias = Categoria::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Asignar los atributos
            $args = $_POST['producto'];

            $producto->sincronizar($args);

            // Validamos
            $errores= $producto->validar();

            //Manejo de la imagen
            $carpetaImagenes = '../public/build/imagenes/';

             // Verifica si se cargó una nueva imagen
             if ($_FILES['producto']['error']['imagen'] === UPLOAD_ERR_OK) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $rutaImagen = $carpetaImagenes . $nombreImagen;
                
                // Mueve la nueva imagen al directorio de imágenes
                if (move_uploaded_file($_FILES['producto']['tmp_name']['imagen'], $rutaImagen)) {
                    // Elimina la imagen anterior si existe
                    if ($producto->imagen) {
                        $producto->borrarImagen();
                    }
                    // Guarda la ruta de la nueva imagen en el objeto Producto
                    $producto->setImagen($nombreImagen);
                } else {
                    // Si no se pudo mover la nueva imagen, muestra un error
                    $errores[] = "Hubo un error al subir la nueva imagen.";
                }
            }

            if(empty($errores)){
                //Guardar en la base de datos 
                $resultado = $producto->guardar();
                
                if ($resultado) {
                    
                    header('location: /admin?resultado=2');
                }

            }

        }

        $router->render("admin/actualizar",[

            'errores' => $errores,
            'producto' => $producto,
            'categorias'=> $categorias

        ]);
    }


    // Funcionamiento de la pagina eliminar en admin
    public static function eliminar(Router $router){

        if($_SERVER['REQUEST_METHOD']=== "POST"){
            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                //Leer el id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                //encontrar y eliminar el producto
                $producto = Productos::find($id);
                $resultado = $producto->eliminar();

                if($resultado){
                    header('location: /admin?resultado=3');
                } else {
                    header('location: /admin?resultado=3');
                }
            }
        }

    }


}