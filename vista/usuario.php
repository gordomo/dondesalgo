<br>
<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 " style="text-align: center; margin-bottom: 30px;"></div>

<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 " style="text-align: center; margin-bottom: 30px;">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-11" style="text-align: center;">
            <img src="<?= 'upload'. $resulPerfil['fotoperfil'];?>" class="fotoperfil col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 nombre-perfil"><b><?= $resulPerfil['nombre'] . ' ' . $resulPerfil['apellido']; ?></b></div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 informacion "><b>Información de contacto</b></div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 informacion" style="margin-top: 20px;"><b>Telefono:</b> <?= $resulPerfil['telefono']; ?></div>
        
        <div  class="col-xs-7 col-sm-6 col-md-6 col-lg-5" data-container="body" data-toggle="tooltip" data-placement="bottom" title="<?= $resulPerfil['direccion']; ?>" style="border: 3px solid #474747; height: 80px;">
            <span class="glyphicon glyphicon-map-marker" ></span>                 
        </div>
    </div>
<?php
    if($resulPerfil['tipo'] != 1)
    {
?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
        <div class="col-xs-10 col-sm-5 col-md-5 col-lg-5 sin-padding lista-eventos">
            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 numero-evento sin-padding "><?= $resulEventoFin->num_rows; ?></div>
            <div class="col-xs-10 col-sm-9 col-md-9 col-lg-9 columna-eventos sin-padding"><b>EVENTOS FINALIZADOS</b></div>
           
<?php
            if($resulEventoFin->num_rows == 0)
            {
                echo '<b>No hay eventos aún</b>';
            }
            else
            {
                while ($fila = $resulEventoFin->fetch_array(MYSQLI_ASSOC)) 
                {
?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columna-eventos sin-padding eventos">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 sin-padding img-evento-perfil " >
                        <img src="<?= 'upload'. $fila['fotoevento'];?>" class="foto-evento-perfil col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                    </div>
                    <div class="sin-padding nombre-evento-perfil " >
                        <b><?= $fila['nombreevento']; ?></b>
                    </div>
                    <div class="sin-padding fecha-evento-perfil " >
                        <?= $fila['fecha_inicio']; ?>
                    </div>
                    <div class="sin-padding fecha-evento-perfil " >
                        <b>Direccion: </b><?= $fila['direccion']; ?>
                    </div>
                </div>

<?php
                }
            }
?>
            
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-2"></div>
        <div class="col-xs-10 col-sm-5 col-md-5 col-lg-5 sin-padding lista-eventos">
            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 sin-padding numero-evento"><?= $resulEventoProx->num_rows; ?></div>
            <div class="col-xs-10 col-sm-9 col-md-9 col-lg-9 columna-eventos sin-padding"><b>PROXIMOS EVENTOS</b></div>
<?php
            if($resulEventoProx->num_rows == 0)
            {
                echo '<b>No hay eventos aún</b>';
            }
            else
            {
                while ($fila = $resulEventoProx->fetch_array(MYSQLI_ASSOC)) 
                {
?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columna-eventos sin-padding eventos">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 sin-padding img-evento-perfil " >
                        <img src="<?= 'upload'. $fila['fotoevento'];?>" class="foto-evento-perfil col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                    </div>
                    <div class="sin-padding nombre-evento-perfil " >
                        <b><?= $fila['nombreevento']; ?></b>
                    </div>
                    <div class="sin-padding fecha-evento-perfil " >
                        <?= $fila['fecha_inicio']; ?>
                    </div>
                    <div class="sin-padding fecha-evento-perfil " >
                        <b>Direccion: </b><?= $fila['direccion']; ?>
                    </div>
                </div>

<?php
                }
            }
?>           
        </div>
    </div>
<?php
    }
?>

</article>