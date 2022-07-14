<div class="barra  <?php if ($_SESSION['admin']) echo 'admin';?>">
    <p>Hola <?php echo explode(" ",$nombre)[1] ?? ''; ?></p>
    <div class="misbotones <?php if ($_SESSION['admin']) echo 'admin';?>">
        <?php if (!$_SESSION['admin']) : ?>
            <a href="/miscitas" class="boton">Mis citas</a>
        <?php endif; ?>
        <a href="/logout" class="boton rojo">Cerrar sesion</a>
    </div>

</div>

<?php if ($_SESSION['admin']) : ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver citas</a>
        <a class="boton" href="/servicios">Ver servicios</a>
        <a class="boton" href="/servicios/crear">Crear servicios</a>
    </div>
<?php endif; ?>