<?php

namespace Controllers;

use Model\Cita;
use MVC\Router;

class CitaController
{
    public static function index(Router $router){

        //session_start();

        isAuth();
        
        $router->render('cita/index',[
            'nombre'=>$_SESSION['nombre'],
            'id'=>$_SESSION['id']
        ]);
    }
    public static function miscitas(Router $router){

        //session_start();

        isAuth();

        $citas=Cita::allWhere('usuarioId',$_SESSION['id'],'fecha','DESC');
        //debuguear($citas);
        $router->render('cita/miscitas',[
            'nombre'=>$_SESSION['nombre'],
            'id'=>$_SESSION['id'],
            'citas'=>$citas
        ]);
    }
}