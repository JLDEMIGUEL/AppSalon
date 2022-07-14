<h1 class="titulo-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Rellena el siguiente formulario para crear una cuenta</p>

<?php
    include __DIR__.'/../templates/alertas.php'
?>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo s($usuario->nombre)?>" placeholder="Tu nombre">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo s($usuario->apellido)?>" placeholder="Tu apellido">
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" name="telefono" value="<?php echo s($usuario->telefono)?>" placeholder="Tu telefono">
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo s($usuario->email)?>" placeholder="Tu email">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"  placeholder="Tu password">
    </div>

    <input type="submit" class="boton" value="Crear cuenta">
</form>

<div class="acciones">
    <a href='/'>¿Ya tienes una cuenta? Inicia sesion</a>
    <!-- <a href='/passforgot'>Olvidaste password</a> -->
</div>