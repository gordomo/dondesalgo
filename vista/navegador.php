    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="espacio_nav" style="display: none;"></div>
    <nav class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" id="nav_principal" align="center">
         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
             
             <b>
          <div class="cssToolTip">
              <b class="glyphicon glyphicon-envelope" aria-hidden="true"  data-container="body" data-toggle="tooltip" data-placement="bottom" title="Eventos ganadores"></b>
<?php
                if(isset($_SESSION['id']))
                {
                    if(isset($resulGanador))
                    {
                      
                    }
                } 
                 echo"<b id='numero_ganador' style='display:none;'>1</b>"; 
?>                    
            <span id="evento_ganador">
              <div class="table-responsive">
              <table  class="table">
                <tr>
                  <td colspan=3 style='font-size:16px;'>
                    <font color=white>Evento Ganador del Día</font>
                  </td>               
                </tr>               
                <tr  class="tabla_rubro">           
                  <td  style="padding-top: 20px">         
                    <b  class="rubro">
<?php                        
                    switch (true) 
                    {
                      case (isset($_GET['boliche']) || isset($_POST['enviar_filtro_boliche'])):
                        echo "BOLICHES"; 
                      break;
                      case (isset($_GET['previa']) || isset($_POST['enviar_filtro_bar'])):
                        echo "BARES"; 
                      break;
                      default:
                        echo "BOLICHES"; 
                      break;
                    }
?>          
                    
                    </b><br><br>
                    <p class="texto_evento_ganador">
<?php
                if(isset($_SESSION['id']))
                {
                    $hora_hoy  = date("H:i:s");
             
                    //SI EL RESULTADO NO ES NULL o SI ESTA DECLARADA
                    if(isset($resulGanador) && (($hora_hoy >= '19:00:00' &&  $hora_hoy<='23:59:59') || ($hora_hoy >= '00:00:00' &&  $hora_hoy<='03:00:00')))
                    {
                        if($resulGanador == 99)
                        {
                           $mensaje_error_interno="activado";         
                        }
                        else
                        {
                            echo $resulGanador["cantidad_voto"]." votos: ".$resulGanador["nombreevento"]. " en ".$resulGanador["nombre"];  
     
                        }    

                    }
                    else
                    {
                       echo "No hay ganadores";  
                        
                    }    

                }  
?>
                    </p>
                  </td>             
                </tr>
                
              </table>
              </div> 

            </span> 
          </div>
          </b>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="float: left; font-size: 20px; margin-right: 0px;">
                   <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>

            <div class="col-xs-10 hidden-lg hidden-md hidden-sm hidden" id="nav_press" >
                   <ul  class="nav">
                      <li id="boton_press1" class="btn_despleg hidden">Boliches <span class="glyphicon glyphicon-sunglasses"></span></li>
                      <li id="boton_press2" class="btn_despleg hidden">Previas <span class="glyphicon glyphicon-user"></span></li>
                      <li id="boton_press3" class="btn_despleg hidden">Ubicacion <span class="glyphicon glyphicon-map-marker"></span></li>
                   </ul>
            </div>

            <div class="collapse navbar-collapse" id="menu_desplegable"> 
                <ul class="nav visible-xs">
                    <li><a href='index.php?boliche' class="btn btn-lg btn-default btnSeccion" id="boton_desp1" >Boliches <span class="glyphicon glyphicon-sunglasses"></span></a></li>
                    <li><a href='index.php?previas' class="btn btn-lg btn-default btnSeccion" id="boton_desp2" >Previas <span class="glyphicon glyphicon-user"></span></a></li>
                    <li><a class="btn btn-lg btn-default btnSeccion" id="boton_desp3">Ubicacion <span class="glyphicon glyphicon-map-marker"></span></a></li>
                </ul>
            </div>

         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  hidden-xs"> 
            <div class="btn-group" >
                <a  href='index.php?boliche' class="btn btn-lg btn-default btnSeccion" id="boton1" >Boliches <span class="glyphicon glyphicon-sunglasses"></span></a> 
                <a  href='index.php?previa' class="btn btn-lg btn-default btnSeccion" id="boton2" >Previas <span class="glyphicon glyphicon-user"></span></a> 
                <a class="btn btn-lg btn-default btnSeccion" id="boton3">Ubicacion <span class="glyphicon glyphicon-map-marker"></span></a> 
            </div>
         </div>   
         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 " id="registro">
<?php

    if(isset($_SESSION['id']))
    {
?>       
            <div class="col-xs-4 col-sm-12 col-md-7 col-lg-7 sin-padding">

              <span>Hola </span><?=$_SESSION["nombre"];?>
<?php
        require_once('modelo/imagen.php');
        $fotoPerfil = new imagen();

        if($fotoPerfil->getPerfil() != 'nada')
        { 
?>              
              <img src="<?= 'upload'. $fotoPerfil->getPerfil();?>" class="img-circle boton8" alt=""  width="30px" height="30px" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Quieres cambiar tu foto de perfil?">
<?php
        }
        else
        {
?>          
              <a href="#" class="boton8" ><img src="assess/imagenes/incognito.png" class="img-circle" alt=""  width="30px" height="30px"></a>

<?php
        }  
?>
            </div>               
            <div  class="col-xs-4 col-sm-12 col-md-2 col-lg-2 sin-padding" style="display: none;" id="menu_user">
                  <span class="pop_ctrl"><i class="fa fa-bars" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Menu desplegable"></i></span>
                  <ul id="demo_ul" style="z-index: 100;">
                      <li class="demo_li" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Pon tu foto de perfil"><a href="#" class="boton8"><div class="icono"><i class="fa fa-user"></i></div><div >Foto Perfil</div></a></li>
<?php
        if(isset($_SESSION['boliche']) || isset($_SESSION['organizador']))
        {
?> 
                      <li class="demo_li" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Crear un evento"><a href="#" id="boton7"><div class="icono"><i class="fa fa-plus-square"></i></div><div >Crear evento</div></a></li>
<?php
        }  
?> 
                      <li class="demo_li" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Cerrar Seccion"><a href='index.php?cerrar_seccion'><div class="icono"><i class="fa fa-power-off"></i></div><div >Cerrar seccion</div></a></li>
                  </ul>
            </div>
               

<?php              
    }
    else
    {    
?> 
              <a href="#" class="btn btn-primary" id="boton5">Login</a>
              <a href="#" class="btn btn-primary" id="boton4">Registrarte</a>
<?php
    }
?>        <div  class="col-xs-4 col-sm-12 col-md-3 col-lg-3 sin-padding">
              <a href="http://www.facebook.com" class="btn" ><img src="assess/imagenes/icono-face.png" width="30px" height="30px"></a>
          </div>    
        </div>   
    </nav>   