<?php

namespace Model;
use PDO;
class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Errores
    protected static $errores= [];

    // Definir la conexión a la BD 
    public static function setDB($database){
        self::$db =$database;
    }

    // Validación 
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores=[];
        return static::$errores;
    }

    // Crear objeto
    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Consulta SQL
    public static function consultarSQL($query){
        // Consultar la base de datos 
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
            $array[] = static::crearObjeto($registro);
        }

        // Retornar los resultados
        return $array;
    }

    // Sanitizar datos
    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'ID_producto' || $columna === 'ID_categoria') continue; // Omitir las columnas ID_producto e ID_categoria
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = $value;
        }
        return $sanitizado;
    }

    // Buscar un registro por su ID
    public static function find($id){
        $columnaID = '';
        if (static::$tabla === 'producto') {
            $columnaID = 'ID_producto';
        } elseif (static::$tabla === 'categorias') {
            $columnaID = 'ID_categoria';
        } elseif (static::$tabla === 'Compra') {
            $columnaID = 'id';
        } else {
            // Manejar el caso en el que la tabla no esté definida correctamente
            throw new \Exception('Tabla no definida correctamente');
        }
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columnaID} = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    
    public static function get($limite){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Guardar
    public function guardar() {
        $resultado = '';
        $columnaID = '';
        if (static::$tabla === 'producto') {
            $columnaID = 'ID_producto';
        } elseif (static::$tabla === 'categorias') {
            $columnaID = 'ID_categoria';
        } elseif (static::$tabla === 'Compra') {
            $columnaID = 'id';
        } else {
            // Manejar el caso en el que la tabla no esté definida correctamente
            throw new \Exception('Tabla no definida correctamente');
        }
        if (!is_null($this->$columnaID)) {
            // Actualizar
            $resultado = $this->actualizar();
        } else {
            // Crear un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    } 

    // Mostrar todo
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Mostrar mediante la id seleccionada 
    public static function ids($id_categoria) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ID_categorias = ?";
        $stmt = self::$db->prepare($query);
        $stmt->execute([$id_categoria]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // Crear
    public function crear(){
        // Sanitizar los datos 
        $atributos = $this->sanitizarAtributos();

        if($this->imagen){
            $atributos['imagen'] = $this->imagen;
        }

        // Insertar en la base de datos
        $columnas = implode(',', array_keys($atributos));
        $valores = "'" . implode("', '", array_values($atributos)) . "'";
        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ($valores)";
    
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Actualizar
    public function actualizar(){
        // Sanitizar los datos 
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}=:{$key}";
        }

        $columnaID = '';
        if (static::$tabla === 'producto') {
            $columnaID = 'ID_producto';
        } elseif (static::$tabla === 'categorias') {
            $columnaID = 'ID_categoria';
        } elseif (static::$tabla === 'Compra') {
            $columnaID = 'id';
        } else {
            // Manejar el caso en el que la tabla no esté definida correctamente
            throw new \Exception('Tabla no definida correctamente');
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE {$columnaID} = :{$columnaID}";

        $stmt = self::$db->prepare($query);

        // Vincular los valores
        foreach($atributos as $key => $value){
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindValue(":{$columnaID}", $this->$columnaID);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        if($resultado){
            // Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    // Eliminar un producto
    public function eliminar(){
        $columnaID = '';
        if (static::$tabla === 'producto') {
            $columnaID = 'ID_producto';
        } elseif (static::$tabla === 'categorias') {
            $columnaID = 'ID_categoria';
        } elseif (static::$tabla === 'Compra') {
            $columnaID = 'id';
        } else {
            // Manejar el caso en el que la tabla no esté definida correctamente
            throw new \Exception('Tabla no definida correctamente');
        }
        $query = "DELETE FROM " . static::$tabla . " WHERE {$columnaID} = :{$columnaID} LIMIT 1";
        $stmt = self::$db->prepare($query);
        $stmt->bindParam(":{$columnaID}", $this->$columnaID);
        $resultado = $stmt->execute();

        if($resultado){
            $this->borrarImagen();
        }
    }

    //IMAGEN

    // Elimina el archivo
    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchiv= file_exists(CARPETA_IMAGENES. $this->imagen);
        if($existeArchiv){
            unlink(CARPETA_IMAGENES. $this->imagen);
        }
    }

    public function setImagen($imagen){
        // Eliminar la imagen anterior si existe
        $columnaID = '';
        if (static::$tabla === 'producto') {
            $columnaID = 'ID_producto';
        } elseif (static::$tabla === 'categorias') {
            $columnaID = 'ID_categoria';
        } elseif (static::$tabla === 'Compra') {
            $columnaID = 'id';
        } else {
            // Manejar el caso en el que la tabla no esté definida correctamente
            throw new \Exception('Tabla no definida correctamente');
        }
        if(!is_null($this->$columnaID)){
            $this->borrarImagen();
        }
        // Asignar el nombre de la imagen al atributo correspondiente
        if($imagen){
            $this->imagen = $imagen;
        }
    }
}