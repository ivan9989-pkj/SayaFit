<?php

namespace Model;

class Admin extends ActiveRecord {

    // tabla admin
    protected static $tabla = 'admin';

    // ColumnasDB

    protected static $columnasDB = ['ID_usuario' , 'email' , 'passwd'];

    public $id;
    public $email;
    public $passwd;

    
    //constructor 
    public function __construct($args=[]){
        $this->id = $args['ID_usuario'] ?? null;
        $this->email = $args['email'] ??'';
        $this->passwd = $args['passwd'] ?? '';

    }

 
    // validación admin
    public function validar(){
        if(!$this->email){
            self::$errores[]= "El Email del usuario es obligatorio";
        }
        if(!$this->passwd){
            self::$errores[]="El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    // Funcion aceptar al usuario 
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


    // Comprobación de la existencia del Usuario
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email ='" . $this->email . "' LIMIT 1";
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

    //Auntentificar datos
    public function autenticar(){
         // El usuario esta autenticado
        session_start();
        // Llenar el arreglo de la sesión
        $_SESSION['admin'] = $this->email;
        $_SESSION['login'] =true;

        header('location: /admin');
    }
    
        
    
}   