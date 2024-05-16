<?php

namespace Model;

class Pedido extends ActiveRecord {
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'id_usuario', 'nombre', 'direccion', 'metodo_pago', 'fecha'];

    public $id;
    public $id_usuario;
    public $nombre;
    public $direccion;
    public $metodo_pago;
    public $fecha;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->metodo_pago = $args['metodo_pago'] ?? '';
        $this->fecha = $args['fecha'] ?? date('Y-m-d H:i:s');
    }

    public function guardar() {
        $atributos = $this->sanitizarAtributos();
        $columnas = implode(',', array_keys($atributos));
        $valores = "'" . implode("', '", array_values($atributos)) . "'";
        $query = "INSERT INTO pedidos ($columnas) VALUES ($valores)";
        self::$db->query($query);
        return self::$db->insert_id;
    }
}
