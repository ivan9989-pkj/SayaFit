<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;
use Model\Usuario;

// Controlador de Login

class LoginControllers{


    // login 
    public static function login(Router $router){

        $errores= [];
    
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $datosUsuario = $_POST;
    
            if (strpos($datosUsuario['email'], '@sayafit.com') !== false) {
                $admin = new Admin($datosUsuario);
                $usuarioRegistrado = $admin->aceptarUsuario();
            } else {
                $usuario = new Usuario($datosUsuario);
                $usuarioRegistrado = $usuario->aceptarUsuario();
            }
    
            if($usuarioRegistrado){
                if(isset($usuario)){
                    $usuario->comprobarPassword($usuarioRegistrado);
                    $usuario->autenticar();
                } else {
                    $admin->comprobarPassword($usuarioRegistrado);
                    $admin->autenticar();
                }
            } else {
                $errores[]= "Usuario o contraseña incorrectos.";
            }
        }
    
        $router->render("auth/login", [
            'errores'=> $errores
        ]);
    }
    

    //logout
    
    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /'); // Redirigir al login
    }
    
    // registro 
    public static function registro(Router $router){
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $password= $_POST['passwd'] ?? '';

            if(!empty($nombre) && !empty($email) && !empty($password)){
                  // Verificar si el usuario ya existe en la base de datos
                $usu = new Usuario();
                $usuario= $usu->aceptarUsuario();

                if($usuario){
                    $errores[]="El usuario ya existe. Por favor , inicia sesión en lugar de registrarte.";
                }else{
                    //Registrar el nuevo usuario
                    Usuario::registrarUsuario($nombre, $email, $password);
                    header('Location: /login');
                    exit;
                }
            }else{
                $errores[]= "Todos los campos son obligatorios.";
            }
        }
        // Renderizar la vista de registro con los errores
        
        $router->render('auth/login', ['errores' => $errores]);
    }
}