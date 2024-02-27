<?php

namespace Model;

class ActiveRecord{

    //Base de datos
    protected static $db;
    protected static $tabla='producto';
    protected static $columnasDB=[];


    //Errores
    protected static $errores=[];

    //definir la conexión a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    //Validación
    public static function getErrores(){
        return static::$errores;
    }
    public function validar(){
        static::$errores= [];
        return static::$errores;
    }

    //Registros - CRUD
    public function guardar(){
        if(!is_null($this->id)){
            //actualizar
            $this->actualizar();
        }else{
            //creando un nuevo registro
            $this->crear();
        }
    }

    public static function all(){
        $query= "SELECT * FROM".static::$tabla;

        $resultado=self::consultarSQL($query);

        return $resultado;
    }

    //Busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ${id}";

        $resultado = self::consultarSQL($query);
    
        return array_shift( $resultado ) ;
    }

    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    
   

    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
    
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}=:{$key}";
        }
    
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = :id";
    
        $stmt = self::$db->prepare($query);
    
        // Vincular los valores
        foreach($atributos as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindValue(":id", $this->id);
    
        // Ejecutar la consulta
        $resultado = $stmt->execute();
    
        if($resultado) {
            // Redireccionar al usuario.
            header('Location: /admin?resultado=2');
        }
    }
    

        // Eliminar un registro

        public function eliminar() {
            // Eliminar el registro
            $query = "DELETE FROM " . static::$tabla . " WHERE id = :id LIMIT 1";
            $stmt = self::$db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $resultado = $stmt->execute();

            if ($resultado) {
                $this->borrarImagen();
            }
        }


    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch()) {
            $array[] = static::crearObjeto($registro);
        }

        

        // retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
    
        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
    
        return $objeto;
    }

        // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    

    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
        if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
        }
        }
    }
    // Subida de archivos
    public function setImagen($imagen) {
        // Elimina la imagen previa
        if( !is_null($this->id) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->$imagen = $imagen;
        }
    }

    // Elimina el archivo
    public function borrarImagen() {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES. $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    
    
}