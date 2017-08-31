<?php

  require_once("modelo/conexion.php");

   
  class imagen extends conexion
  {
      protected $mje_error;
      protected $iduser;

      public function imagen()
      {

         parent::conexion();

         $this->mje_error = 99;

         $this->iduser = $_SESSION['id'];

      }

      
      public function crearCarpetas($tipoUsuario, $idusuario = 0)
      {
          if($idusuario == 0)
          {
              $idusuario = $this->iduser;
          }
          $carpetaUsuario = $_SERVER['DOCUMENT_ROOT'].'/sistema_boliche/upload/'. $tipoUsuario .'/'.$idusuario;
          
          //Verifica si existe la carpeta del usuario, en caso de que no las crea
          if(!is_dir($carpetaUsuario))
          {

               mkdir($carpetaUsuario, 0777, true);
               mkdir($carpetaUsuario . '/Foto Perfil', 0777, true);

               if($tipoUsuario != 1)
               {

                  mkdir($carpetaUsuario . '/Foto Evento', 0777, true);

               }  
          }

          return $carpetaUsuario;
      }


      public function subirPerfil($nombrePerfil, $tipoPerfil, $sizePerfil, $tempPerfil, $rutaUsuario)
      {

            //die("aca: ".$tipoPerfil);

            if($tipoPerfil == 'image/jpeg' || $tipoPerfil == 'image/jpg' || $tipoPerfil == 'image/png')
            {
                
                if($sizePerfil < 4000000)
                {

                    if(is_dir($rutaUsuario))
                    {

                        $directorio = opendir($rutaUsuario . '/Foto Perfil'); //ruta actual

                        while (false !== ($archivo = readdir($directorio))) //obtenemos un archivo y luego otro sucesivamente
                        {
                           
                           unlink($rutaUsuario . '/Foto Perfil/' . $archivo);

                        }

                        closedir($directorio);

                    }


                    $urlPerfil= $rutaUsuario . '/Foto Perfil/' . $nombrePerfil;
                    
                    //Movemos la imagen del archivo temporal, a la ruta de destino
                    move_uploaded_file($tempPerfil, $urlPerfil); 

                    $rutaParcial= explode("/upload",$urlPerfil);    

                    return $rutaParcial[1];

                }
                else
                {

                  return 2;
                }

            }
            else
            {

              return 1;

            }

      }

      public function guardarPerfil($carpetaDestino)
      { 

             $consulta="UPDATE usuarios SET fotoperfil = ? WHERE idusuarios = '$this->iduser';";


             $sentencia = $this->conexion_db->prepare($consulta);

             $sentencia->bind_param("s", $carpetaDestino);

             if(!$sentencia->execute())
             {

                $contenido="Fallo al ejecutarse la consulta guardarPerfil:  (" . $sentencia->errno . ")" . $sentencia->error.".";

                $log = new logs();

                $log->setLog($contenido);

                return $this->mje_error;

             }

             if(!isset($_SESSION['persona']))
             {
                $consulta="SELECT count(*) FROM eventos WHERE idusuarios = '$this->iduser';";
         
                $resultado = $this->conexion_db->query($consulta);

                if(!$resultado)
                {

                  $contenido="Fallo al ejecutarse la consulta guardarPerfil en SELECT eventos existentes:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

                  $log = new logs();

                  $log->setLog($contenido);

                  return $this->mje_error;

                }

                if($resultado->num_rows > 0)
                {

                      $consulta="UPDATE eventos SET fotoperfil = ? WHERE idusuarios = '$this->iduser';";

                      $sentencia = $this->conexion_db->prepare($consulta);

                      $sentencia->bind_param("s", $carpetaDestino);

                     if(!$sentencia->execute())
                     {

                        $contenido="Fallo al ejecutarse la consulta guardarPerfil en UPDATE eventos:  (" . $sentencia->errno . ")" . $sentencia->error.".";

                        $log = new logs();

                        $log->setLog($contenido);

                        return $this->mje_error;

                     }

                }  

             }

            $sentencia->close();

            $this->conexion_db->close();

      }

      public function getPerfil()
      {  

          $consulta="SELECT fotoperfil FROM usuarios WHERE idusuarios = '$this->iduser';";
         
          $resultado = $this->conexion_db->query($consulta);

          if(!$resultado)
          {

            $contenido="Fallo al ejecutarse la consulta getPerfil:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

          }

          //se aplica mysli_num ya que el campo que queremos mostrar tienen nombres diferentes, Sino aplicamos mysql_assoc
          $fotoPerfil = $resultado->fetch_array(MYSQLI_NUM);

          if($fotoPerfil[0] == '' ||  $fotoPerfil[0] == null)
          {

              return 'nada';

          }
          else
          {
              return $fotoPerfil[0];
          }  

          

      }


      public function subirPortada($nombrePortada, $tipoPortada, $sizePortada, $tempPortada, $rutaUsuario)
      {


              if($tipoPortada == 'image/jpeg' || $tipoPortada == 'image/jpg' || $tipoPortada == 'image/png')
              {
                  if($sizePortada < 4000000)
                  {

                    $carpetaDestino= $rutaUsuario . '/Foto Evento/' . $nombrePortada;


                    //Movemos la imagen del archivo temporal, a la ruta de destino
                    move_uploaded_file($tempPortada, $carpetaDestino);

                    $rutaParcial= explode("/upload",$carpetaDestino);       

                    return $rutaParcial[1];

                  }
                  else
                  {

                    return 2;
                  }

              }
              else
              {

                return 1;

              }

      }
      
  }




?>