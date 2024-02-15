<?php

namespace Controllers;

use Model\Admin;
use Model\ActiveRecord;
use MVC\Router;



class LoginController{

  
    public static function login(Router $router){
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $admin = new Admin($_POST);
            $usuario = $admin->aceptarUsuario();

            if($usuario && $admin->comprobarPassword($usuario)){
                $admin->autenticar();
            } else {
                $errores[] = "Usuario o contraseña incorrectos.";
            }
        }

        $router->render('auth/login', ['errores' => $errores]);
    }




    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
          
    public static function registro(Router $router) {
        $errores = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            if (!empty($nombre) && !empty($email) && !empty($password)) {
                // Verificar si el usuario ya existe en la base de datos
                $admin = new Admin();
                $usuario = $admin->aceptarUsuario();
    
                if ($usuario) {
                    $errores[] = "El usuario ya existe. Por favor, inicia sesión en lugar de registrarte.";
                } else {
                    // Registrar el nuevo usuario
                    Admin::registrarUsuario($nombre, $email, $password);
                    header('Location: /login'); // Redirigir a la página de inicio de sesión
                    exit;
                }
            } else {
                $errores[] = "Todos los campos son obligatorios.";
            }
        }
    
        // Renderizar la vista de registro con los errores
        $router->render('auth/login', ['errores' => $errores]);
    }
    
    }

