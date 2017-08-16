<br>

<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" style="text-align: center; margin-bottom: 30px;">
    <form  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12 " action="<?php echo htmlspecialchars('index.php'); ?>">
        <p> Filtro:</p> 
        <select name='filtro' id='filtro' class="form-control" style="margin-bottom: 20px;" >
            <option value='' <?php if (isset($_POST['filtro']) && $_POST['filtro'] == '') echo 'selected="selected" '; ?> >Ninguno</option>
            <option value='semana' <?php if (isset($_POST['filtro']) && $_POST['filtro'] == 'semana') echo 'selected="selected" '; ?> >en 1 semana</option>
            <option value='mes' <?php if (isset($_POST['filtro']) && $_POST['filtro'] == 'mes') echo 'selected="selected" '; ?> >en 1 mes</option>
            <option value='todos' <?php if (isset($_POST['filtro']) && $_POST['filtro'] == 'todos') echo 'selected="selected" '; ?> >todos</option>
        </select>
        <button class="btn btn-primary" id="enviar_filtro_boliche" name="enviar_filtro_boliche" value="Submit">Buscar</button>
    </form>
</div>
    <article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
<?php

    if(isset($acceso_boliches))
    {

?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn-primary">Hay <span class="badge"><?= (!empty($resulEventos->num_rows)) ? $resulEventos->num_rows : 0; ?></span> eventos de boliches disponibles. ¿A cual queres ir?.</div>
            
<?php

        while ($fila = $resulEventos->fetch_array(MYSQLI_ASSOC)) 
        {
            if(!isset($_SESSION['admin'])&&($fila['estado'] == 1) || isset($_SESSION['admin']))
            {
?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well well-lg sin-padding">
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-top: 30px;">
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="text-align: right;" ><img src="<?= 'upload'. $fila['fotoperfil'];?>" class="img-circle" alt=""  width="100px" height="100px"></div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" ><b><?=$fila['nombre']; ?></b></div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                            <div  class="col-xs-12 col-sm-12 col-md-10 col-lg-10" data-container="body" data-toggle="tooltip" data-placement="bottom" title="<?=$fila['direccion']; ?>" style="border: 3px solid #474747; height: 80px;">
                                <span class="glyphicon glyphicon-map-marker" ></span>                 
                            </div>
                             <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                                <span class="glyphicon glyphicon-calendar"></span>     
                            </div>
                          </div>
                     </div>
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12  sin-padding" >
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" ><b><?=$fila['nombreevento']; ?></b></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" ><?=$fila['fecha_inicio']." ".$fila['horainicio']." - ".$fila['horafin']; ?></div>
                     </div>
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12  sin-padding">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="height: 200px;"><img src="<?= 'upload'. $fila['fotoevento'];?>" class="" alt="" width="100%" height="100%"></div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  sin-padding">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<?php
                                if($fila['estado'] == 0){
                                    echo '<p style="color: red;">EVENTO DESHABILITADO</p>';
                                };
?>                       
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 recuadro_descripcion" ><?=$fila['descripcion']; ?></div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                     </div>
<?php
                    if(isset($_SESSION['admin']))
                    { 
?>
                        <form method="post" action="<?php echo htmlspecialchars('index.php');?>">
<?php
                            if($fila['estado'] == 1)
                            {
?>
                                <input type="radio" name="accion" value="eliminar"> Deshabilitar publicación
<?php
                            }
                            else
                            {
?>
                                <input type="radio" name="accion" value="republicar"> Habilitar publicación
<?php
                            }
?>                           
                            <input type="radio" name="accion" value="editar"> Editar publicación
                            
                            <input type="hidden" name="idevento" value="<?=$fila['ideventos']; ?> ">
                            
                            <input type="submit" value="Aplicar acciones">
                            
                        </form>
<?php
                    }
                    if(isset($_SESSION['persona']))
                    {
                        //VALIDAR SI VOTO

                        require_once('modelo/voto.php');

                        $voto_usuario= new voto();

                        $si_voto = $voto_usuario->getVotoUsuario($fila['fecha_inicio'],$fila['horainicio']);

                        if($si_voto == 0)
                        {   

?>                         

                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">

                <form id="form_enviar_voto" method="post" action="<?php echo htmlspecialchars('index.php'); ?>">         
              
                    <i class="fa fa-hand-o-right enviar_voto" aria-hidden="true" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Votar"></i>
      
                    <input type="hidden" name="id_evento" id="id_evento" value="<?= $fila['ideventos']; ?>">
                    <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?= $fila['fecha_inicio']; ?>">
                    <input type="hidden" name="hora_inicio" id="hora_inicio" value="<?= $fila['horainicio']; ?>">
                    <input type="hidden" name="mensaje_oculto_form" id="mensaje_oculto_form" value="false">
                    <input type="hidden" name="enviar_voto" id="enviar_voto" value="1">
                  
                </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
<?php
                }
            }
?>

            </div>   

<?php
            }
        }
    }
?>


<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
