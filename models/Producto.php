<?php

namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'producto';
    protected static $columnasDB = ['id', 'nombre', 'precio', 'stock', 'descripcion', 'imagen'];

    public $id;
    public $nombre;
    public $precio;
    public $stock;
    public $descripcion;
    public $imagen;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->stock = $args['stock'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$errores[] = "Debe añadir el Nombre";
        }
        if (!$this->precio) {
            self::$errores[] = "Debe añadir el precio";
        }
        if (!$this->stock) {
            self::$errores[] = "Debe añadir el stock";
        }
        if (strlen($this->descripcion) < 20) {
            self::$errores[] = "Debe añadir al menos 20 letras en la descripción";
        }
        if (!$this->imagen) {
            self::$errores[] = "Debe añadir la imagen";
        }
        return self::$errores;
    }

    public function guardar() {
        if (!is_null($this->id)) {
            $resultado = $this->actualizar();
        } else {
            $resultado = $this->crear();
        }
        return $resultado;
    }

    public function crear() {
        $atributos = $this->sanitizarAtributos();
        if ($this->imagen) {
            $atributos['imagen'] = $this->imagen;
        }
        $columnas = implode(',', array_keys($atributos));
        $valores = "'" . implode("', '", array_values($atributos)) . "'";
        $query = "INSERT INTO producto ($columnas) VALUES ($valores)";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function setImagen($imagen) {
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public static function all() {
        $query = "SELECT * FROM producto";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query) {
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
}
