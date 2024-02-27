<?php

namespace Model;

/**
 * Clase Admin: representa a un administrador en el sistema.
 */
class Admin extends ActiveRecord {

    /** @var string $tabla Nombre de la tabla en la base de datos */
    protected static $tabla = 'usuarios';

    /** @var array $columnasDB Columnas de la tabla en la base de datos */
    protected static $columnasDB = ['id', 'email', 'password'];

    /** @var int|null $id Identificador único del administrador */
    public $id;

    /** @var string $email Dirección de correo electrónico del administrador */
    public $email;

    /** @var string $password Contraseña del administrador */
    public $password;

    /**
     * Constructor de la clase Admin.
     *
     * @param array $args Argumentos opcionales para la inicialización del objeto.
     */
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    /**
     * Método para aceptar un usuario.
     *
     * @return mixed Devuelve false si el email no existe, de lo contrario devuelve el usuario.
     */
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

    /**
     * Método para comprobar la contraseña del usuario.
     *
     * @param object $usuario Objeto de usuario para verificar la contraseña.
     * @return bool Devuelve true si la contraseña es correcta, de lo contrario devuelve false.
     */
    public function comprobarPassword($usuario) {
        return password_verify($this->password, $usuario->password);
    }

    /**
     * Método para autenticar al usuario.
     * Inicia una sesión y redirige al usuario a la página de administrador.
     */
    public function autenticar() {
        session_start();
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        header('Location: /admin');
    }

    /**
     * Método estático para registrar un nuevo usuario en la base de datos.
     *
     * @param string $nombre Nombre del usuario.
     * @param string $email Dirección de correo electrónico del usuario.
     * @param string $password Contraseña del usuario (en texto plano).
     */
    public static function registrarUsuario($nombre, $email, $password) {
        $db = self::$db;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->execute();
    }

}
