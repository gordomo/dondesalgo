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
            
<?php   $i = 0;

        while ($fila = $resulEventos->fetch_array(MYSQLI_ASSOC)) 
        {
            
            if(!isset($_SESSION['admin'])&&($fila['estado'] == 1) || isset($_SESSION['admin']))
            { 
                   
                
                
?>          
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well well-lg sin-padding">
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-top: 30px;">
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="text-align: right;" ><img src="<?= 'upload'. $fila['fotoperfil'];?>" class="img-circle" alt=""  width="100px" height="100px"></div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 nombre-cuenta" ><b><a href="index.php?usuario=<?= $fila['idusuarios'] ?>"><?=$fila['nombre']; ?></a></b></div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                            <div  class="col-xs-12 col-sm-12 col-md-10 col-lg-10" data-container="body" data-toggle="tooltip" data-placement="bottom" title="<?=$fila['direccion']; ?>" style="border: 3px solid #474747; height: 80px;">
                                <span class="glyphicon glyphicon-map-marker" ></span>                 
                            </div>
                             <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2 " >
                                <span class="glyphicon glyphicon-calendar"></span>     
                            </div>
                          </div>
                     </div>
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" >
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" ><b><?=$fila['nombreevento']; ?></b></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                                <?php
                                    $fecha = explode("/", $fila['fecha_inicio']);
                                    
                                    //Si el primer caracter es 0, lo saca
                                    if(substr($fecha[1], -2, 1) == 0): $fecha[1] = trim($fecha[1], '0'); endif;
                                    
                                    $mes = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
                                    $dia = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
                                    $dia = $dia[date('N', strtotime($fecha[0].'-'.$fecha[1].'-'.$fecha[2]))];
                                    echo $dia . ", " . $fecha[0] ." de " . $mes[$fecha[1]];
                                    
                                ?> 
                            </div>
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" align="right"><?= $fila['horainicio']; ?></div>
                            <div class="col-xs-2 col-sm-2 col-md-3 col-lg-2" align="center">-</div>
                            <div class="col-xs-5 col-sm-5 col-md-4 col-lg-5" align="left"><?= $fila['horafin']; ?></div>
                        </div>
                     </div>
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12  sin-padding">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="height: 200px;"><img src="<?= 'upload'. $fila['fotoevento'];?>" class="" alt="" width="100%" height="100%"></div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  sin-padding">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<?php
                                if($fila['estado'] == 0)
                                {
                                    
                                    echo '<p style="color: red;">EVENTO BORRADO</p>';
                                    
                                }
                                elseif($fila['estado'] == 100)
                                {
                                    
                                    echo '<p style="color: red;">EVENTO DESHABILITADO</p>';
                                    
                                }
                               
?>                       
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 recuadro_descripcion" ><?=$fila['descripcion']; ?></div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                     </div>
<?php
            
                    if(isset($_SESSION['admin']) || ((isset($_SESSION['boliche']) || isset($_SESSION['organizador'])) && ($_SESSION['id'] == $fila['idusuarios'])))
                    { 
?>  
                        <form method="post" action="<?php echo htmlspecialchars('index.php');?>">
<?php
                            if(isset($_SESSION['admin']))
                            {
                                if($fila['estado'] == 1)
                                {
?>
                                    <input type="radio" name="accion" value="deshabilitar"> Deshabilitar publicación
<?php
                                }
                                else
                                {
?>
                                    <input type="radio" name="accion" value="habilitar"> Habilitar publicación
<?php
                                }
                            }
                            elseif(isset($_SESSION['boliche']) || isset($_SESSION['organizador']))
                            {
?>
                                    <input type="radio" name="accion" value="borrar"> Borrar publicación
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
                        //IDENTIFICA A CADA EVENTO CON UN RANGO ASI PODEMOS DESHABILITAR POR JQUERY LOS EVENTOS VOTADOS
                        
                        require_once('modelo/evento.php');
                        
                        $rangoEvento = new evento();
                        
                        $rango = $rangoEvento->getRangoEvento($fila['fecha_inicio'], $fila['horainicio']);
                        
                        
                        //VALIDAR SI VOTO

                        require_once('modelo/voto.php');

                        $voto_usuario= new voto();
                                                   
                        $si_voto = $voto_usuario->getVotoUsuario($fila['fecha_inicio'],$fila['horainicio']);
 
?>                         
                            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
<?php                   if($si_voto == 0)
                        {                                                                        
 ?>                                         
                              <i class="fa fa-hand-o-right icono_voto" data-rango="<?= $rango ?>" aria-hidden="true" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Votar"></i>
                              
                              <span id="form_enviar_voto<?= $i; ?>" >
                                    <input type="hidden" name="enviar_voto" class="enviar_voto" value="<?= $i; ?>">
                                    <input type="hidden" name="id_evento" id="id_evento" value="<?= $fila['ideventos']; ?>">
                                    <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?= $fila['fecha_inicio']; ?>">
                                    <input type="hidden" name="hora_inicio" id="hora_inicio" value="<?= $fila['horainicio']; ?>">
                                    <input type="hidden" name="mensaje_oculto_form" id="mensaje_oculto_form" value="false">
                                </span>
<?php
                        }
                        else
                        {    
?>
                               <i class="fa fa-hand-o-right icono_voto no_vota" data-rango="<?= $rango ?>" aria-hidden="true" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Votar"></i>
<?php
                        }
?>                              

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
<?php
                    }
?>

            </div>   

<?php
            }
            
            $i++;
        }
    }
?>


<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
