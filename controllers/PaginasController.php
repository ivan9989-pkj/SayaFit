<?php


namespace Controllers;

use Model\Productos;
use Model\ActiveRecord;
use Model\Carrito;
use MVC\Router;
use Stringable;

// Controlador de las Paginas de usuario

class PaginasController{
    public static function index(Router $router){
        $router->render("paginas/index",[
            
        ]);
    }

    public static function contacto(Router $router){
        $router->render("paginas/contacto",[

        ]);
    }

    public static function categorias(Router $router){
        $router->render("paginas/categorias", [

        ]);
    }

    public static function nosotros(Router $router){
        $router->render("paginas/nosotros", [

        ]);
    }

    public static function mantenimiento(Router $router){
        $router->render("paginas/mantenimiento" , [

        ]);
    }

    public static function nutricion(Router $router){
        $router->render("paginas/nutricion" , [

        ]);
    }

    public static function error(Router $router){

        $router->render("paginas/error" ,[

        ]);

    }

    // categorias
    public static function ropa_hombre(Router $router) {
        $datos = Productos::ids(1);

        $router->render('paginas/categorias/ropa-hombre', [
            'datos' => $datos
        ]);
    }

    public static function ropa_mujer(Router $router){

        $datos = Productos::ids(2);

        $router->render('paginas/categorias/ropa-mujer', [
            'datos'=> $datos
        ]);
        
    }


    public static function calzado_hombre(Router $router){

     
        $datos = Productos::ids(3);

        $router->render('paginas/categorias/calzado-hombre', [
            'datos'=> $datos
        ]);
        
    }

    public static function calzado_mujer(Router $router){

        $datos = Productos::ids(4);

        $router->render('paginas/categorias/calzado-mujer', [
            'datos'=> $datos
        ]);
        
    }

    public static function material_fitness(Router $router){
        $datos = Productos::ids(5);
        $router->render('paginas/categorias/material-fitness', [
            'datos'=> $datos
        ]);
    }


    // nutricion

    public static function alimentacion(Router $router){
        $datos = Productos::ids(6);

        $router->render('paginas/nutricion/alimentacion',[
            'datos'=> $datos
        ]);
    }

    public static function barritas(Router $router){
        $datos = Productos::ids(7);
        $router->render('paginas/nutricion/barritas', [
            'datos'=> $datos
        ]);
    }

    public static function bebidas_y_suplementos(Router $router){
        $datos = Productos::ids(8);
        $router->render('paginas/nutricion/bebidas-y-suplementos',[
            'datos'=> $datos
        ]);
    }

    public static function geles(Router $router){
        $datos = Productos::ids(9);
        $router->render('paginas/nutricion/geles-energéticas',[
            'datos' => $datos
        ]);
    }

    public static function mezcladores(Router $router){
        $datos= Productos::ids(10);

        $router->render('paginas/nutricion/mezcladores', [
            'datos'=> $datos
        ]);
    }

    public static function te(Router $router){
        $datos= Productos::ids(11);

        $router->render('paginas/nutricion/te-e-infusiones', [
            'datos'=> $datos
        ]);
    }


    public static function aviso_legal(Router $router){
        $router->render('paginas/textos-legales/aviso-legal',[

        ]);
    }

    public static function cookies(Router $router){
        $router->render('paginas/textos-legales/cookies',[

        ]);
    }

    public static function politica(Router $router){
        $router->render('paginas/textos-legales/politica-privacidad', [

        ]);
    }

    // kit-entrenamientos
    public static function kit_entrenamiento(Router $router){
        $router->render('paginas/kit-entrenamiento',[]);
    }

    public static function calc(Router $router){
            $router->render('paginas/kit-entrenamiento/calc-kcal', []);
    }

    public static function rutinas(Router $router){
        $router->render('paginas/kit-entrenamiento/rutinas',[]);
    }

    
}