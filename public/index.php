<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CitaController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();


//Iniciar sesion
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);

//Iniciar sesion
$router->get('/logout',[LoginController::class,'logout']);

//Crear cuenta
$router->get('/crear-cuenta',[LoginController::class,'crear']);
$router->post('/crear-cuenta',[LoginController::class,'crear']);

//Confirmar cuenta
$router->get('/confirmar-cuenta',[LoginController::class,'confirmar']);
$router->get('/mensaje',[LoginController::class,'mensaje']);

//Recuperar password
$router->get('/passforgot',[LoginController::class,'passforgot']);
$router->post('/passforgot',[LoginController::class,'passforgot']);
$router->get('/passrecover',[LoginController::class,'passrecover']);
$router->post('/passrecover',[LoginController::class,'passrecover']);



//Area privada
$router->get('/cita',[CitaController::class,'index']);
$router->get('/miscitas',[CitaController::class,'miscitas']);
$router->get('/admin',[AdminController::class,'index']);


//API de citas
$router->get('/api/servicios',[APIController::class,'index']);
$router->post('/api/citas',[APIController::class,'guardar']);
$router->post('/api/eliminar',[APIController::class,'eliminar']);


//CRUD servicios
$router->get('/servicios',[ServicioController::class,'index']);
$router->get('/servicios/crear',[ServicioController::class,'crear']);
$router->post('/servicios/crear',[ServicioController::class,'crear']);
$router->get('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/eliminar',[ServicioController::class,'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();