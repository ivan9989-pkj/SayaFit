<?php


namespace Model;


class Admin extends ActiveRecord{


    protected static $tabla='usuarios';
    protected static $columnasDB= ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function aceptarUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email='" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            return false; // El email no existe
        }

        return $resultado->fetch_object();
    }

    public function comprobarPassword($usuario){
        return password_verify($this->password, $usuario->password);
    }
    public function autenticar(){
        //El usuario esta autenticado

        session_start();

        //Llenar el arrreglo de sesiones
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;


        header('Location: /admin');
        
    }

    
    public static function registrarUsuario($nombre, $email, $password) {
        $db = self::$db;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $passwordHash);
        $stmt->execute();
        $stmt->close();
    }

}
