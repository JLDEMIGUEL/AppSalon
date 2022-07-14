<h1 class="nombre-pagina">Panel de administración</h1>


<?php include_once __DIR__ . "/../templates/barra.php"; ?>


<h2>Buscar citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input id="fecha" name="fecha" type="date" value="<?php echo $fecha?>">
        </div>
    </form>
</div>

<?php
    if(count($citas)===0){
        echo "<h2>No hay citas en esta fecha</h2>";
    }
?>

<div class="citas-admin">
    <ul class="citas">
        <?php $idCita = null;
        $total = 0;
        foreach ($citas as $key => $cita) :
            if ($idCita !== $cita->id) : $idCita = $cita->id; ?>
                <li>
                    <p>ID: <span><?php echo $cita->id ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente ?></span></p>
                    <p>Email: <span><?php echo $cita->email ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono ?></span></p>

                    <h3>Servicios:</h3>
                <?php endif; ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio ?>€</p>
                <?php
                $siguiente = $citas[$key + 1]->id ?? null;
                $total += $cita->precio;
                if ($siguiente !== $cita->id) : ?>
                    <p>Total: <span><?php echo $total ?>€</span></p>
                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id;?>" >
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>
                <?php $total = 0;
                endif; ?>
            <?php endforeach; ?>
    </ul>

</div>

<?php
    $script="<script src='build/js/buscador.js'></script>"
?>
