<h1 class="nombre-pagina">Olvidé password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuacion</p>


<?php
    include __DIR__.'/../templates/alertas.php'
?>

<form class="formulario" method="POST" action="/passforgot">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu email" name="email">
    </div>

    <input type="submit" class="boton" value="Enviar correo">
</form>

<div class="acciones">
    <a href='/crear-cuenta'>¿Aun no tienes cuenta? Crea una</a>
    <a href='/'>¿Ya tienes una cuenta? Inicia sesion</a>
</div>  