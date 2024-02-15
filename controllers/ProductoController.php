<?php

    namespace Controllers;

    use Model\Producto;
    use MVC\Router;


    class ProductoController{
        public static function index(Router $router){

            $productos=Producto::all();

            // Muestra mensaje condicional
            $resultado = $_GET['resultado'] ?? null;

            $router->render("propiedades/index", [
                'productos' => $productos,
                'resultado' => $resultado

            ]);
        }

        public static function crear(Router $router)
        {
            $errores = Producto::getErrores();
            $producto = new Producto;
        
                    // Ejecutar el código después de que el usuario envíe el formulario
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // Crea una nueva instancia de Producto con los datos del formulario
                $producto = new Producto($_POST['producto']);

                // Manejo de la imagen
                $carpetaImagenes = '../public/build/imagenes/';

                // Verifica si se cargó una imagen
                if ($_FILES['producto']['error']['imagen'] === UPLOAD_ERR_OK) {
                    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                    $rutaImagen = $carpetaImagenes . $nombreImagen;
                    
                    // Mueve la imagen al directorio de imágenes
                    if (move_uploaded_file($_FILES['producto']['tmp_name']['imagen'], $rutaImagen)) {
                        // Guarda la ruta de la imagen en el objeto Producto
                        $producto->setImagen($nombreImagen);
                    } else {
                        // Si no se pudo mover la imagen, muestra un error
                        $errores[] = "Hubo un error al subir la imagen.";
                    }
                }

                // Validar
                $errores = $producto->validar();

                if (empty($errores)) {
                    // Guardar en la base de datos
                    $resultado = $producto->guardar();

                    if ($resultado) {
                        header('location: /admin?resultado=1');
                    }
                }
            }
                
                    $router->render('propiedades/crear', [
                        'errores' => $errores,
                        'producto' => $producto
                    ]);
                }

                public static function actualizar(Router $router){
                    $id = validarORedireccionar('/propiedades');
                
                    // Obtener los datos del producto
                    $producto = Producto::find($id);
                
                    // Arreglo con mensajes de errores
                    $errores = Producto::getErrores();
                
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        // Asignar los atributos
                        $args = $_POST['producto'];
                
                        $producto->sincronizar($args);
                
                        // Validación
                        $errores = $producto->validar();
                
                        // Manejo de la imagen
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
                
                        if (empty($errores)) {
                            // Guardar en la base de datos
                            $resultado = $producto->guardar();
                
                            if ($resultado) {
                                header('location: /propiedades');
                            }
                        }
                    }
                
                    $router->render('propiedades/actualizar', [
                        'errores' => $errores,
                        'producto' => $producto
                    ]);
                }
                

        public static function eliminar(Router $router){
            if($_SERVER['REQUEST_METHOD']==="POST"){
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo) ) {
                    // Leer el id
                    $id = $_POST['id'];
                    $id = filter_var($id, FILTER_VALIDATE_INT);
        
                    // encontrar y eliminar la propiedad
                    $producto = Producto::find($id);
                    $resultado = $producto->eliminar();

                    // Redireccionar
                    if ($resultado) {
                        header('location: /admin?resultado=3');
                    } else {
                        header('location: /admin?resultado=3');
                    }

                }
                
        
        }
        
        }
    }


