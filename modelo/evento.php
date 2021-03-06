<?php

  require_once("modelo/conexion.php");
  require_once("modelo/logs.php");

   
  class evento extends conexion
  {
      protected $mje_error;
      protected $iduser;

      public function evento()
      {

         parent::conexion();

         $this->mje_error = 99;

         if(isset($_SESSION['id']))
         {
            $this->iduser = $_SESSION['id'];
         } 
      }


      public function setEvento($portada, $titulo, $fecha, $horainicio, $horafin, $descripcion, $direccion, $tipo, $datosUsuario)
      { 

          if($tipo == 'no')
          {  
            switch (true) 
            {
                  case isset($_SESSION['boliche']):       

                   $tipo=$_SESSION['boliche'];

                  break;
                
            }
          }  

          $nombre=$datosUsuario['nombre'];
          $fotoperfil=$datosUsuario['fotoperfil'];

          if($direccion == 'no')
          {
            $direccion= $datosUsuario['direccion'];
          } 


          $consulta = " INSERT INTO eventos (idusuarios, tipo, nombre, direccion, nombreevento, descripcion, fechapublicacion, fechainicio, horainicio, horafin, fotoperfil, fotoevento, estado) VALUES ($this->iduser, ?, '$nombre', '$direccion', ?, ?, NOW(), ?, ?, ?, '$fotoperfil', ?, 1) ";

          $sentencia = $this->conexion_db->prepare($consulta);

          $sentencia->bind_param("issssss", $tipo, $titulo, $descripcion, $fecha, $horainicio, $horafin, $portada);

          if(!$sentencia->execute())
          {

            $contenido="Fallo al ejecutarse la consulta setEvento:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

          }

          $sentencia->close();

          $this->conexion_db->close();

          return 1;


      }

      public function getEventos()
      { 

          switch (true) 
          {
            case (isset($_GET['boliche'])):
              $tipo = 2;
            break;

            case (isset($_GET['previa'])):
              $tipo = 4;
            break;
            
            default:
              $tipo = 2;
            break;
          }


          $fechas=array();

          for($i=0; $i <= 6; $i++)
          {
            $dia_siguiente = date('Y-m-d', strtotime("+".$i. " day"));

            $fechas[] = $dia_siguiente;

          } 


          //pregunta si hay eventos en la semana
          $consulta="SELECT ideventos, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                            DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento 
                      FROM eventos 
                      WHERE tipo = $tipo AND fechainicio BETWEEN '$fechas[0]' AND '$fechas[6]'
                      ORDER BY fechainicio ASC;"; 


          $resultado = $this->conexion_db->query($consulta);

          if(!$resultado)
          {

            $contenido="Fallo al ejecutarse la consulta getEventos en la semana:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

          }


          if($resultado->num_rows > 0)
          {

              
              $this->conexion_db->close();

              return $resultado;

          }
          else
          {

                $en_mes= date('Y-m-d', strtotime("+31 day"));

               //pregunta si hay eventos en el mes
                $consulta="SELECT ideventos, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                  DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento 
                            FROM eventos 
                            WHERE tipo = $tipo AND fechainicio BETWEEN '$fechas[0]' AND '$en_mes'
                            ORDER BY fechainicio ASC;"; 

                $resultado = $this->conexion_db->query($consulta);


                if(!$resultado)
                {

                  $contenido="Fallo al ejecutarse la consulta getEventos en el mes:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

                  $log = new logs();

                  $log->setLog($contenido);

                  return $this->mje_error;

                }

                if($resultado->num_rows > 0)
                {
              
                  $this->conexion_db->close();

                  return $resultado;

                }
                else
                {

                      //pregunta si hay eventos en cualquier momento
                      $consulta="SELECT ideventos, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                        DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento 
                                  FROM eventos 
                                  WHERE tipo = $tipo AND fechainicio >= $fechas[0]
                                  ORDER BY fechainicio ASC;"; 

                      $resultado = $this->conexion_db->query($consulta);

                      if(!$resultado)
                      {

                        $contenido="Fallo al ejecutarse la consulta getEventos en cualquier momento:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

                        $log = new logs();

                        $log->setLog($contenido);

                        return $this->mje_error;

                      }

                      $this->conexion_db->close();

                      return $resultado;

                  }

          }

      }

       public function getEventosConFiltro()
      { 

          switch (true) 
          {
            case (isset($_POST['enviar_filtro_boliche'])):
              $tipo = 2;
            break;

            case (isset($_POST['enviar_filtro_bar'])):
              $tipo = 4;
            break;
            
            default:
              $tipo = 2;
            break;
          }


          $hoy= date('Y-m-d');

          switch (true) 
          {

               case ($_POST['filtro'] == 'semana' || $_POST['filtro'] == ''):

                     $en_semana= date('Y-m-d', strtotime("+7 day"));

                    //pregunta si hay eventos en la semana
                    $consulta="SELECT ideventos, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                      DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento 
                                FROM eventos 
                                WHERE tipo = $tipo AND fechainicio BETWEEN '$hoy' AND '$en_semana'
                                ORDER BY fechainicio ASC;"; 

                    $filtro_dia="semana";

               break;
               
               case ($_POST['filtro'] == 'mes'):

                     $en_semana= date('Y-m-d', strtotime("+31 day"));

                    //pregunta si hay eventos en la semana
                    $consulta="SELECT ideventos, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                      DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento 
                                FROM eventos 
                                WHERE tipo = $tipo AND fechainicio BETWEEN '$hoy' AND '$en_semana'
                                ORDER BY fechainicio ASC;";

                    $filtro_dia="mes";             

               break;

               case ($_POST['filtro'] == 'todos'):


                    //pregunta si hay eventos en cualquier momento
                    $consulta="SELECT ideventos, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                        DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento 
                               FROM eventos 
                               WHERE tipo = $tipo AND fechainicio >= '$hoy'
                               ORDER BY fechainicio ASC;";

                    $filtro_dia="todos";           
        

               break;
          }

          $resultado = $this->conexion_db->query($consulta);

          if(!$resultado)
          {

            $contenido="Fallo al ejecutarse la consulta getEventosConFiltro en la $filtro_dia :  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

          }   


          $this->conexion_db->close();

          return $resultado;
 

       
      }

  }      


?>