<?php

namespace Model;

class DetallePedido extends ActiveRecord {
    protected static $tabla = 'detalles_pedido';
    protected static $columnasDB = ['id', 'id_pedido', 'id_producto', 'cantidad', 'precio'];

    public $id;
    public $id_pedido;
    public $id_producto;
    public $cantidad;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_pedido = $args['id_pedido'] ?? '';
        $this->id_producto = $args['id_producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function guardar() {
        $atributos = $this->sanitizarAtributos();
        $columnas = implode(',', array_keys($atributos));
        $valores = "'" . implode("', '", array_values($atributos)) . "'";
        $query = "INSERT INTO detalles_pedido ($columnas) VALUES ($valores)";
        self::$db->query($query);
        return self::$db->insert_id;
    }
}
