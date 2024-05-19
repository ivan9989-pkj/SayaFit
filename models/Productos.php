<?php

namespace Model;


class Productos extends ActiveRecord {
   // Base de datos
   protected static $tabla = 'producto';
   protected static $columnasDB = ['ID_producto', 'nombre_producto', 'descripcion', 'precio', 'ID_categorias', 'imagen', 'stock'];

   public $ID_producto;
   public $nombre_producto;
   public $descripcion;
   public $precio;
   public $ID_categorias;
   public $imagen;
   public $stock;

   //constructor 

   public function __construct($args = []) {
       $this->ID_producto = $args['ID_producto'] ?? null;
       $this->nombre_producto = $args['nombre_producto'] ?? '';
       $this->descripcion = $args['descripcion'] ?? '';
       $this->precio = $args['precio'] ?? '';
       $this->ID_categorias = $args['ID_categorias'] ?? '';
       $this->imagen = $args['imagen'] ?? 'imagen.jpg';
       $this->stock = $args['stock'] ?? '';
   }
    public function validar(){

         // Llamar al método validarImagen para validar la imagen
         $this->validarImagen();

         
        if(!$this->nombre_producto){
            self::$errores[] = "Debes añadir un nombre";
        }
        if(strlen($this->descripcion)<25){
            self::$errores[]="La descripción es obligatoria y tiene que tener minimo 25 caracteres";
        }
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }
        if(!$this->stock){
            self::$errores[] = "Debes añadir un stock";
        }
       return self::$errores;
    }
    
    public function validarImagen(){
        if(!$this->imagen){
            self::$errores[]='La Imagen es Obligatoria';
        }
    }
    
}

