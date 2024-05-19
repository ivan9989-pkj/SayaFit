<?php

namespace Model;

class Categoria extends ActiveRecord{
    // Base de datos 
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['ID_categoria', 'nombre_categoria', 'descripcion'];

    public $ID_categoria;
    public $nombre_categoria;
    public $descripcion;

    // constructor 
    public function __construct($args = []){
        $this->ID_categoria = $args['ID_categoria'] ?? null;
        $this->nombre_categoria = $args['nombre_categoria'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }

    public function validar() {
        if (!$this->nombre_categoria) {
            self::$errores[] = "El Nombre es Obligatorio";
        }
        if (strlen($this->descripcion) < 25) {
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 25 caracteres";
        }

        return self::$errores;
    }
}
