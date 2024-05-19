<?php

namespace Model;

class Compra extends ActiveRecord {
    protected static $tabla = 'Compra';
    protected static $columnasDB = ['id', 'product_id', 'quantity', 'total_price', 'created_at'];

    public $id;
    public $product_id;
    public $quantity;
    public $total_price;
    public $created_at;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->product_id = $args['product_id'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
        $this->total_price = $args['total_price'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
    }

    public function validar() {
        if (!$this->product_id) {
            self::$errores[] = "El ID del producto es obligatorio.";
        }
        if (!$this->quantity) {
            self::$errores[] = "La cantidad es obligatoria.";
        }
        if (!$this->total_price) {
            self::$errores[] = "El precio total es obligatorio.";
        }

        return self::$errores;
    }


    public static function eliminarPorID($id)
    {
        $query = "DELETE FROM " . self::$tabla . " WHERE product_id = ${id}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function eliminarTodos() {
        $query = "DELETE FROM " . self::$tabla;
    
        $resultado = self::consultarSQL($query);
    
        return $resultado;
    }
}
