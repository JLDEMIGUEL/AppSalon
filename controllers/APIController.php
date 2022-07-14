<?php

namespace Controllers;

use Classes\Email;
use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use Model\Usuario;

class APIController{
    public static function index(){
        $servicios = Servicio::all();
        echo (json_encode($servicios));
    }

    public static function guardar(){
       
        //Almacena cita
        $cita = new Cita($_POST);
        $resultado=$cita->guardar();
        //debuguear($_POST);
        $usuario=Usuario::find($_POST['usuarioId']);

        $email = new Email($usuario->email, $usuario->nombre, $usuario->token, $resultado['id']);
        $email->enviarConfirmacionCita();

        $idServicios = explode(",",$_POST['servicios']);

        foreach($idServicios as $idServicio){
            $args=[
                'citaId'=>$resultado['id'],
                'servicioId'=>$idServicio
            ];
            $citaServ=new CitaServicio($args);
            $citaServ->guardar();
        }

        echo (json_encode(['resultado'=>$resultado]));
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $cita= Cita::find($_POST['id']);
            $cita->eliminar();

            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
}