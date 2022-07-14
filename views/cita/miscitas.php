<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios a continuacion</p>

<div class="barra">
    <p>Hola <?php echo explode(" ", $nombre)[1] ?? ''; ?></p>
    <div class="misbotones">
        <a href="/cita" class="boton">Nueva cita</a>
        <a href="/logout" class="boton rojo">Cerrar sesion</a>
    </div>
</div>

<div class="citas-lista">
    <?php if(count($citas)===0):?>
        <p>Aun no tienes citas, reserva una</p>
    <?php endif;?>
    <ul class="citas">
        <?php $idCita = null;
        $total = 0;
        foreach ($citas as $cita) : ?>
            <li>
                <p>Fecha: <span><?php echo $cita->fecha ?></span></p>
                <p>Hora: <span><?php echo $cita->hora ?></span></p>
            <?php endforeach; ?>
    </ul>

</div>