<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{

    public static function login(Router $router)
    {
        $alertas=[];
        $auth = new Usuario;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth=new Usuario($_POST);

            $alertas=$auth->validarLogin();

            if(empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);

                if($usuario){
                    if($usuario->comprobarPassAndVerif($auth->password)){
                        session_start();
                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']=$usuario->nombre." ".$usuario->apellido;
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;

                        if($usuario->admin==='1'){
                            $_SESSION['admin']=true;
                            header('Location: /admin');
                        }else{
                            $_SESSION['admin']=false;
                            header('Location: /cita');
                        }
                    }else{
                        $alertas=Usuario::getAlertas();
                    }
                   
                }else{
                    $alertas['error'][]='El usuario no existe';
                }
            }
        }


        $router->render('auth/login',[
            'alertas'=>$alertas,
            'usuario'=>$auth
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION=[];
        header('Location: /');
    }

    public static function crear(Router $router)
    {

        $usuario = new Usuario;
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuenta();

            if (empty($alertas['error'])) {

                //Usuario no registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    $usuario->hashPassword();

                    //Generar token unico
                    $usuario->crearToken();

                    //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function passforgot(Router $router)
    {
        $alertas=[];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth=new Usuario($_POST);
            $alertas=$auth->validarEmail();

            if(empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);

                if($usuario && $usuario->confirmado==='1'){

                    //Generar token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //Enviar email
                    $email=new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->enviarInstrucciones();

                    $alertas['exito'][]='Correo de recuperación enviado';

                }else{
                    $alertas['error'][]='Usuario no existe o no está verificado';
                }
            }
        }
        
        $router->render('auth/passforgot', [
            'alertas'=>$alertas
        ]);
    }

    public static function passrecover(Router $router)
    {
        $alertas=[];

        $token=s($_GET['token']);
        $usuario=Usuario::where('token',$token);

        if(empty($usuario)){
            $alertas['error'][]='El token no es valido';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->password=$_POST['password'];
            $alertas=$usuario->validarPassword();

            if(empty($alertas)){
                $usuario->hashPassword();
                $usuario->token=null;
                $usuario->guardar();
                header('Location: /');
            }
        }
        $router->render('auth/passrecover',[
            'alertas'=>$alertas
        ]);
    }

    public static function confirmar(Router $router)
    {

        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where("token", $token);

        if (empty($usuario)) {
            //Mensaje error
            $alertas['error'][] = 'Token no valido';
        } else {
            $usuario->confirmado = '1';
            $usuario->token = null;
            $usuario->guardar();
            $alertas['exito'][] = 'Cuenta confirmada';
        }

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }
}
