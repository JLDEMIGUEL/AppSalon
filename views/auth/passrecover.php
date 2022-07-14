<h1 class="nombre-pagina">Reestablecer password</h1>
<p class="descripcion-pagina">Reestablece tu password a continuacion</p>

<?php
    include __DIR__.'/../templates/alertas.php'
?>

<?php
if(!empty($alertas['error'])) return;
?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Tu nueva password">
    </div>

    <input type="submit" class="boton" value="Guardar password">
</form>


<div class="acciones">
    <a href='/'>¿Ya tienes cuenta? Inicia sesion</a>
    <a href='/crear-cuenta'>¿Aun no tienes cuenta? Crea una</a>
</div>