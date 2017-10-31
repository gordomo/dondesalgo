<?php
   
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    //crea la sesion del usuario
    if(!isset($_SESSION["id"]))
    {     
       session_name('donde_salgo');
       session_start();     
    }


    switch (true) 
    {
        case (isset($_POST['login_usuario'])):

           require_once("modelo/validar.php");
           require_once("modelo/usuarios.php");
           $errores= 0;

           $email=$_POST['email'];
           $clave=$_POST['clave'];

           $validar= new validacion();
           //Devuelve la cantidad de errores en la validacion de campos
           $errores=$validar->validarLogin($email, $clave);

           if($errores == 0)
           {   

              $conexion= new conexion();
              $conexion_db=$conexion->conexion();

              $email=$conexion_db->real_escape_string($email);
              $clave=$conexion_db->real_escape_string($clave);

              $usuario = new usuarios();

              switch ($usuario->loginUsuarios($email,$clave)) 
              {
                case 1:
                       $seguir="activado";

                       if(isset($_SESSION['persona']))
                       {
                          $acceso_boliches="si";

                          require_once('modelo/evento.php');

                          $eventos_boliches= new evento();

                          $resulGanador = $eventos_boliches->getEventoGanador(2);

                          $resulEventos= $eventos_boliches->getEventos(); 

                       } elseif(isset($_SESSION['admin'])) {

                           $acceso_boliches="si";

                          require_once('modelo/evento.php');

                          $eventos_boliches= new evento();

                          $resulEventos= $eventos_boliches->getEventos(true); 

                       }

                 break;

                case 0:
                    $mensaje_error_login="activado";
                 break;

                case 99:

                   $mensaje_error_interno="activado";
                 break;        
              }   


           }
            else
           {
                //Devuelve los mensajes de error
                $mensaje_login=$validar->getMensaje();
           }

        break;
        case (isset($_POST['registrar_persona'])):

           require_once("modelo/validar.php");
           require_once("modelo/usuarios.php");
           $errores = 0;

           $nombre   = $_POST['nombre'];
           $apellido = $_POST['apellido'];
           $email    = $_POST['email'];
           $clave    = $_POST['clave'];
           $fecha    = $_POST['fecha'];
           $sexo     = $_POST['sexo'];

           $validar= new validacion();
           //Devuelve la cantidad de errores en la validacion de campos
           $errores=$validar->validarRegistro($nombre, $apellido, $email, $clave, $fecha, $sexo);

           if($errores == 0)
           {   

              $conexion= new conexion();
              $conexion_db=$conexion->conexion();

              $nombre=$conexion_db->real_escape_string($nombre);
              $apellido=$conexion_db->real_escape_string($apellido);
              $email=$conexion_db->real_escape_string($email);
              $clave=$conexion_db->real_escape_string($clave);
              $fecha=$conexion_db->real_escape_string($fecha);
              $fecha=date("Y-m-d",strtotime($fecha));
              $sexo=$conexion_db->real_escape_string($sexo);

              if($validar->validarUsuarioRepetido($email) == 1)
              {
                 $mensaje_usuario_repetido="activado";
              }
              else
              {
                 $usuario= new usuarios();

                 if($usuario->setPersonas($nombre,$apellido,$email,$clave,$fecha,$sexo) == 99)
                 {
                    $mensaje_error_interno="activado";
                 }
                 else
                 {
                    $msje_exito_registro='activado';

                 }   

              }   


           }
           else
           {
                //Devuelve los mensajes de error
                $mensaje=$validar->getMensaje();
           }   

        break;
        case (isset($_POST['registrar_boliche'])):

           require_once("modelo/validar.php");
           require_once('modelo/usuarios.php');
           require_once('modelo/codigos.php');

           $errores = 0;

           $nombre   = $_POST['nombre'];
           $direccion= $_POST['direccion'];
           $telefono = $_POST['telefono'];
           $email    = $_POST['email'];
           $clave    = $_POST['clave'];
           $codigo   = $_POST['codigo'];

           $validar= new validacion();
           //Devuelve la cantidad de errores en la validacion de campos
           $errores=$validar->validarRegistroBoliches($nombre, $direccion, $telefono, $email, $clave, $codigo);

           if($errores == 0)
           {   

              $conexion= new conexion();
              $conexion_db=$conexion->conexion();

              $nombre=$conexion_db->real_escape_string($nombre);
              $direccion=$conexion_db->real_escape_string($direccion);
              $telefono=$conexion_db->real_escape_string($telefono);
              $email=$conexion_db->real_escape_string($email);
              $clave=$conexion_db->real_escape_string($clave);
              $codigo=$conexion_db->real_escape_string($codigo);


              if($validar->validarUsuarioRepetido($email) == 1)
              {
                 $mensaje_usuario_repetido="activado";
              }
              else
              {

                 $codigos= new codigos();

                 $idcodigo = $codigos->getIdcodigo($codigo);

                 if($idcodigo == 99)
                 {
                    $mensaje_error_interno="activado";
                 }
                 else
                 {
                      if($codigos->actualizarCodigo($idcodigo) == 99)
                      {
                          $mensaje_error_interno="activado";

                      }
                      else
                      {
                          $usuario= new usuarios();

                          if($usuario->setBoliches($nombre,$direccion,$telefono,$email,$clave,$idcodigo) == 99)
                          {
                              $mensaje_error_interno="activado";
                          }
                          else
                          {
                              $msje_exito_registro='activado';
                          }   

                      }  

                 } 

              }


           }
           else
           {
                //Devuelve los mensajes de error
                $mensaje=$validar->getMensaje();
           }   

        break;
        case (isset($_POST['registrar_organizador'])):

           require_once("modelo/validar.php");
           require_once("modelo/usuarios.php");
           require_once('modelo/codigos.php');

           $errores = 0;

           $nombre   = $_POST['nombre'];
           $email    = $_POST['email'];
           $clave    = $_POST['clave'];
           $codigo   = $_POST['codigo'];

           $validar= new validacion();
           //Devuelve la cantidad de errores en la validacion de campos
           $errores=$validar->validarRegistroOrganizador($nombre, $email, $clave, $codigo);

           if($errores == 0)
           {   

              $conexion= new conexion();
              $conexion_db=$conexion->conexion();

              $nombre=$conexion_db->real_escape_string($nombre);
              $email=$conexion_db->real_escape_string($email);
              $clave=$conexion_db->real_escape_string($clave);
              $codigo=$conexion_db->real_escape_string($codigo);

              if($validar->validarUsuarioRepetido($email) == 1)
              {

                 $mensaje_usuario_repetido="activado";
              }
              else
              {
                 $codigos= new codigos();

                 $idcodigo = $codigos->getIdcodigo($codigo);

                 if($idcodigo == 99)
                 {
                    $mensaje_error_interno="activado";
                 }
                 else
                 {
                      if($codigos->actualizarCodigo($idcodigo) == 99)
                      {
                          $mensaje_error_interno="activado";

                      }
                      else
                      { 

                          $usuario= new usuarios();

                          if($usuario->setOrganizador($nombre,$email,$clave,$idcodigo) == 99)
                          {
                              $mensaje_error_interno="activado";
                          }
                          else
                          {
                              $msje_exito_registro='activado';
                          } 

                      }
                  }
              }

            }     
            else
            {
                  //Devuelve los mensajes de error
                  $mensaje=$validar->getMensaje();
            }   

        break;
        case (isset($_POST['contacto_usuario'])):

           require_once('modelo/envio_mail.php');

           $nombre = $_POST['nombre'];
           $apellido= $_POST['apellido'];
           $telefono = $_POST['telefono'];
           $email=$_POST['email'];
           $comentario=$_POST['mensaje'];
           //$archivo=$_FILES['archivo'];

           $envio_mail= new mails();

           $resEnvio = $envio_mail->enviar_contacto($nombre,$apellido,$telefono,$email,$comentario);

           if($resEnvio == 1)
           {
                $msje_exito_contacto='activado';
           }
           else
           {

                $msje_error_contacto = 'activado';
           }    


        break;
        case (isset($_POST['validar_codigo'])):

           require_once('modelo/validar.php');

           $codigo = $_POST['codigo'];

           $validar= new validacion();

           switch ($validar->validarCodigo($codigo)) 
           {


                 case 2:
                       $seguir_registro_organizador="activado";
                 break;

                 case 1:
                       $seguir_registro_boliche="activado";
                 break;

                case 0:
                       $mensaje_error_codigo="activado";
                 break;

                case 99:
                       $mensaje_error_interno="activado";
                break;      

           }     

        break;
        case (isset($_POST['crear_perfil'])):

            require_once('modelo/imagen.php');
            require_once('modelo/usuarios.php');    

            $nombrePerfil = $_FILES['foto_perfil']['name'];
            $tipoPerfil   = $_FILES['foto_perfil']['type'];
            $sizePerfil   = $_FILES['foto_perfil']['size'];
            $tempPerfil   = $_FILES['foto_perfil']['tmp_name'];


            $usuario = new usuarios();

            $datosUsuario = $usuario->getDatosUsuario();

            if($datosUsuario == 99)
            {
                $mensaje_error_interno="activado";
            }
            else
            {
                $imagen = new imagen();

                $rutaUsuario = $imagen->crearCarpetas($datosUsuario['tipo']);

                $resulSubida = $imagen->subirPerfil($nombrePerfil, $tipoPerfil, $sizePerfil, $tempPerfil, $rutaUsuario);

                switch($resulSubida) 
                {
                  case 1:
                     $mensaje_error_formato="activado";
                     break;

                  case 2:
                     $mensaje_error_grande="activado";
                  break;   

                  default:

                      $resulRuta = $imagen->guardarPerfil($resulSubida);

                      if($resulRuta == 99)
                      {
                         $mensaje_error_interno="activado";
                      }
                      else
                      {
                          $mensaje_exito="activado";
                      }  

                   break;
                }

            }      

        break;
        case (isset($_REQUEST['editar_evento'])):

            require_once('modelo/imagen.php');
            require_once('modelo/validar.php');
            require_once('modelo/evento.php');
            require_once('modelo/usuarios.php');

            $imagen = new imagen();
            $usuario = new usuarios();
            
            
            // se agrega la foto de perfil si no tiene 
           if(isset($_FILES['perfil']))
           {

                $nombrePerfil = $_FILES['perfil']['name'];
                $tipoPerfil   = $_FILES['perfil']['type'];
                $sizePerfil   = $_FILES['perfil']['size'];
                $tempPerfil   = $_FILES['perfil']['tmp_name']; 

                $datosUsuario = $usuario->getDatosUsuario();

                if($datosUsuario == 99)
                {
                    $mensaje_error_interno="activado";
                }
                else
                {

                    $rutaUsuario = $imagen->crearCarpetas($datosUsuario['tipo']);

                    $resulSubida = $imagen->subirPerfil($nombrePerfil, $tipoPerfil, $sizePerfil, $tempPerfil, $rutaUsuario);

                    switch($resulSubida) 
                    {
                      case 1:
                         $mensaje_error_formato="activado";
                         break;

                      case 2:
                         $mensaje_error_grande="activado";
                      break;   

                      default:

                          $resulRuta = $imagen->guardarPerfil($resulSubida);

                          if($resulRuta == 99)
                          {
                             $mensaje_error_interno="activado";
                          }  

                       break;
                    }

                }



           }
            
            
            
           //se validan los datos ingresados
            $titulo = $_POST['titulo_evento'];
            $fecha = $_POST['fecha_evento']; 
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $descripcion = $_POST['descripcion_evento'];
            $descripcion = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$descripcion);
            $id_evento = $_POST['idevento'];
            $direccion = $_POST['direccion'];

            $tipo = 'no';

            if(isset($_POST['tipo_evento']))
            {
               $tipo = $_POST['tipo_evento']; 
            } 

            $validar= new validacion();
            //Devuelve la cantidad de errores en la validacion de campos
            $errores=$validar->validarEvento($titulo, $fecha, $hora_inicio, $hora_fin, $descripcion, $direccion, $tipo);

            if($errores == 0)
            {
               $conexion= new conexion();
               $conexion_db=$conexion->conexion();

               $titulo=$conexion_db->real_escape_string($titulo);
               $fecha=$conexion_db->real_escape_string($fecha);
               $fecha=date("Y-m-d",strtotime($fecha));
               $hora_inicio=$conexion_db->real_escape_string($hora_inicio);
               $hora_fin=$conexion_db->real_escape_string($hora_fin);
               $descripcion= $conexion_db->real_escape_string($descripcion);

               if(isset($_POST['direccion']) && isset($_POST['tipo_evento']))
               {
                    $direccion= $conexion_db->real_escape_string($direccion);
                    $tipo= $conexion_db->real_escape_string($tipo);

               }  

               $datosUsuario = $usuario->getDatosUsuario($_POST['idusuario']); 

                if($datosUsuario == 99)
                {
                    $mensaje_error_interno="activado";
                }
                else
                {

                    if(isset($_FILES['imagen_evento']['name']))
                    {
                        $nombrePortada = $_FILES['imagen_evento']['name'];
                        $tipoPortada   = $_FILES['imagen_evento']['type'];
                        $sizePortada   = $_FILES['imagen_evento']['size'];
                        $tempPortada   = $_FILES['imagen_evento']['tmp_name'];

                        $rutaUsuario = $imagen->crearCarpetas($datosUsuario['tipo'], $_POST['idusuario']);

                        $resulSubida = $imagen->subirPortada($nombrePortada, $tipoPortada, $sizePortada, $tempPortada, $rutaUsuario);
                    }
                    else
                    {
                        $resulSubida = $_POST['foto_portada'];
                    }


                    switch ($resulSubida) 
                    {
                        case 1:
                            $mensaje_error_formato="activado";
                           break;

                        case 2:
                            $mensaje_error_grande="activado";
                        break;   

                        default:

                            $evento = new evento();

                            $resulEvento = $evento->updateEvento($titulo, $fecha, $hora_inicio, $hora_fin, $descripcion, $resulSubida, $direccion, $tipo, $id_evento, $datosUsuario);

                            if($resulEvento == 99)
                            {
                                $mensaje_error_interno="activado";
                            }
                            else
                            {
                                $mensaje_exito="activado";

                                $acceso_boliches="si";

                                $eventos_boliches= new evento();

                                if(isset($_SESSION['admin']))
                                {
                                    $resulEventos= $eventos_boliches->getEventos(true);
                                }
                                else
                                {
                                    $resulEventos= $eventos_boliches->getEventos();
                                }


                            }

                         break;
                    }

                }    

            }
            else
            {
                //Devuelve los mensajes de error
                $mensaje=$validar->getMensaje();
            } 


        break;
        case (isset($_POST['accion'])):

            $accion = $_POST['accion'];
            require_once('modelo/evento.php');
            require_once('modelo/usuarios.php');
            $evento = new evento(); 

              switch($accion){
                  case 'editar':

                        $band = 'editar';

                        //Se busca el evento a editar a traves del id del evento
                        $resulEvento = $evento->getEventoAdm($_POST['idevento']);
                        $infoEvento = $resulEvento->fetch_array(MYSQLI_ASSOC);
                                                
                        if(isset($_SESSION['admin']))
                        {
                              $usuario = new usuarios();
                              $tipoUsuario = $usuario->getTipoUsuario($infoEvento['idusuarios']);
                              
                        }

                        //Convierte el los <br/> en saltos de linea para que se pueda ver tal cual estaba escrito
                        $descripcion= $infoEvento['descripcion']; 
                        $descripcion = str_replace("<br/>", "\r\n", $descripcion);

                        //Convierte la fecha del formato dd/mm/aaaa al formato dd.mm.aaaa
                        $fecha_inicio = explode("/", $infoEvento['fecha_inicio']);
                        $fecha_inicio = $fecha_inicio[0].".".$fecha_inicio[1].".".$fecha_inicio[2];

                      break;

                  case 'deshabilitar':

                        $band = 'eliminar';

                        $idEvento = $_POST['idevento'];
                        $resulEliminar = $evento->dehabilitarEvento($idEvento);

                        if($resulEliminar == 99)
                       {
                          $mensaje_error_interno="activado";
                       }
                       else
                       {
                           $mensaje_exito="activado";

                           $acceso_boliches="si";

                           $deshabilitarAdm = 'si';

                           $eventos_boliches= new evento();

                           $resulEventos= $eventos_boliches->getEventos(true);

                       }

                      break;

                  case 'habilitar':

                        require_once('modelo/evento.php');
                        require_once('modelo/usuarios.php');
                        $band = 'eliminar';

                        $idEvento = $_POST['idevento'];
                        $resulEliminar = $evento->habilitarEvento($idEvento);

                        if($resulEliminar == 99)
                        {
                           $mensaje_error_interno="activado";
                        }
                        else
                        {
                            $mensaje_exito="activado";

                            $acceso_boliches="si";

                            $habilitarAdm = 'si';

                            $eventos_boliches= new evento();

                            $resulEventos= $eventos_boliches->getEventos(true);



                        }
                      break;

                  case 'borrar':

                        $band = 'borrar';

                        $idEvento = $_POST['idevento'];
                        $resulEliminar = $evento->borrarEvento($idEvento);

                        if($resulEliminar == 99)
                       {
                          $mensaje_error_interno="activado";
                       }
                       else
                       {
                           $mensaje_exito="activado";

                           $acceso_boliches="si";

                           $borrarEvento = 'si';

                           $eventos_boliches= new evento();

                           $resulEventos= $eventos_boliches->getEventos(true);

                       }
                      break;
            }


        break; 
        case (isset($_REQUEST['crear_evento'])):

           require_once('modelo/imagen.php');
           require_once('modelo/validar.php');
           require_once('modelo/evento.php');
           require_once('modelo/usuarios.php');

           $imagen = new imagen();

           $usuario = new usuarios();

           // se agrega la foto de perfil si no tiene 
           if(isset($_FILES['perfil']))
           {

                $nombrePerfil = $_FILES['perfil']['name'];
                $tipoPerfil   = $_FILES['perfil']['type'];
                $sizePerfil   = $_FILES['perfil']['size'];
                $tempPerfil   = $_FILES['perfil']['tmp_name']; 

                $datosUsuario = $usuario->getDatosUsuario();

                if($datosUsuario == 99)
                {
                    $mensaje_error_interno="activado";
                }
                else
                {

                    $rutaUsuario = $imagen->crearCarpetas($datosUsuario['tipo']);

                    $resulSubida = $imagen->subirPerfil($nombrePerfil, $tipoPerfil, $sizePerfil, $tempPerfil, $rutaUsuario);

                    switch($resulSubida) 
                    {
                      case 1:
                         $mensaje_error_formato="activado";
                         break;

                      case 2:
                         $mensaje_error_grande="activado";
                      break;   

                      default:

                          $resulRuta = $imagen->guardarPerfil($resulSubida);

                          if($resulRuta == 99)
                          {
                             $mensaje_error_interno="activado";
                          }  

                       break;
                    }

                }



           }

           //se validan los datos ingresados
           $titulo = $_POST['titulo_evento'];
           $fecha = $_POST['fecha_evento']; 
           $hora_inicio = $_POST['hora_inicio'];
           $hora_fin = $_POST['hora_fin'];
           $descripcion = $_POST['descripcion_evento'];
           $descripcion = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$descripcion);
           $direccion = 'no';
           $tipo = 'no';

           if(isset($_POST['direccion']) && isset($_POST['tipo_evento']))
           {
              $direccion = $_POST['direccion'];
              $tipo = $_POST['tipo_evento']; 
           } 

           $validar= new validacion();
           //Devuelve la cantidad de errores en la validacion de campos
           $errores=$validar->validarEvento($titulo, $fecha, $hora_inicio, $hora_fin, $descripcion, $direccion, $tipo);

           if($errores == 0)
           {
              $conexion= new conexion();
              $conexion_db=$conexion->conexion();

              $titulo=$conexion_db->real_escape_string($titulo);
              $fecha=$conexion_db->real_escape_string($fecha);
              $fecha=date("Y-m-d",strtotime($fecha));
              $hora_inicio=$conexion_db->real_escape_string($hora_inicio);
              $hora_fin=$conexion_db->real_escape_string($hora_fin);
              $descripcion= $conexion_db->real_escape_string($descripcion);

              if(isset($_POST['direccion']) && isset($_POST['tipo_evento']))
              {
                $direccion= $conexion_db->real_escape_string($direccion);
                $tipo= $conexion_db->real_escape_string($tipo);
              }  

              $nombrePortada = $_FILES['imagen_evento']['name'];
              $tipoPortada   = $_FILES['imagen_evento']['type'];
              $sizePortada   = $_FILES['imagen_evento']['size'];
              $tempPortada   = $_FILES['imagen_evento']['tmp_name'];

              $datosUsuario = $usuario->getDatosUsuario(); 

              if($datosUsuario == 99)
              {
                  $mensaje_error_interno="activado";
              }
              else
              {
                  $rutaUsuario = $imagen->crearCarpetas($datosUsuario['tipo']);

                  $resulSubida = $imagen->subirPortada($nombrePortada, $tipoPortada, $sizePortada, $tempPortada, $rutaUsuario);

                  switch ($resulSubida) 
                  {
                      case 1:
                         $mensaje_error_formato="activado";
                         break;

                      case 2:
                         $mensaje_error_grande="activado";
                      break;   

                      default:

                          $evento = new evento();

                          $resulEvento = $evento->setEvento($resulSubida, $titulo, $fecha, $hora_inicio, $hora_fin, $descripcion, $direccion, $tipo, $datosUsuario);

                          if($resulEvento == 99)
                          {
                             $mensaje_error_interno="activado";

                          }
                          else
                          {
                              $mensaje_exito="activado";

                              $acceso_boliches="si";

                              require_once('modelo/evento.php');

                              $eventos_boliches= new evento();

                              $resulEventos= $eventos_boliches->getEventos();

                          }

                       break;
                  }

              }    

           }
           else
           {
                //Devuelve los mensajes de error
                $mensaje=$validar->getMensaje();
           } 


        break;
        case (isset($_POST['enviar_voto'])):

              require_once('modelo/voto.php');
              require_once('modelo/evento.php');

              $ocultar_mensaje=$_POST['mensaje_oculto_form'];

              if($ocultar_mensaje == 1)
              {               
                  setcookie("no_mensaje", $ocultar_mensaje ,time()+86400);

                  $no_mensaje="1";                     
              }


              $evento= new evento();

              $idevento=$_POST['id_evento'];

              $fecha_inicio=$_POST['fecha_inicio'];

              $fecha_inicio = explode('/',$fecha_inicio);

              $fecha_inicio = $fecha_inicio[2].'-'.$fecha_inicio[1].'-'.$fecha_inicio[0];

              $hora_inicio= $_POST['hora_inicio'];

              $fechaYhora= $fecha_inicio. " " . $hora_inicio;


              $voto= new voto(); 

              $voto->setVotoUsuario($idevento,$fechaYhora);

              $voto->setVotoEvento($idevento);

              switch (true) 
              {
                case (isset($_POST['enviar_voto'])):
                  $acceso_boliches="si";
                break;

              }

              $resulEventos = $evento->getEventos();   


        break;
        case (isset($_GET['usuario'])):
            
            if(is_numeric($_GET['usuario']))
            {
                require_once('modelo/usuarios.php');
                require_once('modelo/evento.php');

                $usuario = new usuarios();
                $evento= new evento();

                $resulPerfil = $usuario->verPerfil($_GET['usuario']);

                if(!isset($resulPerfil))
                {
                    header("Location: index.php");
                }

                if($resulPerfil['tipo'] != 1)
                {
                    $resulEventoFin = $evento->verEventosFin($_GET['usuario']);
                    $resulEventoProx = $evento->verEventosProx($_GET['usuario']);
                    
                }
            }
            else
            {
                header("Location: index.php");
            }
            
            
            
        break;
        case (isset($_POST['buscadorNav'])):

            require_once('modelo/filtros.php');
            
            $texto = $_POST['buscadorNav'];
            $filtro_busqueda = $_POST['opcionFiltro'];
                                
            $filtros= new filtros();
            
            if($texto)
            {
              die($filtros->buscadorNav($texto,$filtro_busqueda));  
            }
           
            die();
            
        break;
        case (isset($_GET['cerrar_sesion'])):

            session_destroy();
            header("Location: index.php");

        break;
        default: 

            switch (true) 
            {
              case (isset($_GET['boliche']) || isset($_POST['enviar_filtro_boliche'])):
                $acceso_boliches="si";
                $tipo=2;  
              break;

              case (isset($_GET['previa']) || isset($_POST['enviar_filtro_bar'])):
                $acceso_previas="si";
                $tipo=3;  
              break;

              default:
                $acceso_boliches="si";
                $tipo=2;  
              break;
            }

            require_once('modelo/evento.php');

            $eventos= new evento();

            $resulGanador = $eventos->getEventoGanador($tipo);


            if(isset($_POST['filtro']))
            {
               $resulEventos= $eventos->getEventosConFiltro();
            }
            else
            {

               $todos = false;
               if(isset($_SESSION['admin']))
               {
                  $todos=true;
               }

               $resulEventos = $eventos->getEventos($todos);

            }  

        break;

    }

require_once("vista/inicio.php");

?>