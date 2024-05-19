<?php

namespace Model;

class Usuario extends ActiveRecord {

    // tabla usuario
    protected static $tabla = 'usuario';

    // columnas de la tabla 

    protected static $columnasDB = ['ID_usuario' , 'nombre' , 'email' , 'passwd'];

    public $id;
    public $email;
    public $nombre;
    public $passwd;



    //constructor 
    public function __construct($args=[]){
        $this->id = $args['ID_usuario'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ??'';
        $this->passwd = $args['passwd'] ?? '';

    }

    
    // validación de datos
    public function validar(){
        if(!$this->email){
            self::$errores[]= "El Email del usuario es obligatorio";
        }
        if(!$this->nombre){
            self::$errores[]="El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    // Función de aceptar al Usuario
    public function aceptarUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email=:email LIMIT 1";
        $stmt = self::$db->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false; // El email no existe
        }

        return $stmt->fetchObject();
    }

    //Comprobación de la existencia del Usuario
    public function existeUsuario(){
        $query = "SELECT * FROM". self::$tabla ."WHERE email ='". $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[]='El Usuario No Existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($usuario){
        return password_verify($this->passwd, $usuario->passwd);
    }

    public function autenticar(){
         // El usuario esta autenticado
        session_start();
        // Llenar el arreglo de la sesión
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] =true;

        header('location: /');
    }

    // Resgistrando un usuario

    public static function registrarUsuario($nombre, $email, $password) {
        $db = self::$db;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuario (nombre, email, passwd) VALUES (:nombre, :email, :passwd)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':passwd', $passwordHash);
        $stmt->execute();
    }
    
        
    
}   