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

      public function getEventos($todos = false)
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

          for($i=0; $i <= 7; $i++)
          {
            $dia_siguiente = date('Y-m-d', strtotime("+".$i. " day"));

            $fechas[] = $dia_siguiente;

          } 

          //pregunta si hay eventos en la semana
          $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                            DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento, estado
                      FROM eventos 

                      WHERE tipo = $tipo AND fechainicio BETWEEN '$fechas[0]' AND '$fechas[7]' ";
          if(!$todos){
              $consulta .= "AND estado = 1 "; 
          }
          
          $consulta .= "ORDER BY fechainicio ASC;";
               
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
                $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                  DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin, fotoperfil, fotoevento, estado
                            FROM eventos 
                            WHERE tipo = $tipo AND fechainicio BETWEEN '$fechas[0]' AND '$en_mes' ";
                
                if(!$todos){
              $consulta .= "AND estado <> 0 "; 
          }
          
          $consulta .= "ORDER BY fechainicio ASC;";

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
                      $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                        DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento, estado 
                                  FROM eventos 

                                  WHERE tipo = $tipo AND fechainicio >= '$fechas[0]' ";
                      
                      if(!$todos){
                         $consulta .= "AND estado <> 0 "; 
                      }


                        $consulta .= "ORDER BY fechainicio ASC;"; 

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
      
      public function getEventoAdm($id_evento)
      {
          $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                            DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin, fotoperfil, fotoevento
                      FROM eventos 
                      WHERE ideventos = $id_evento ";
          
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
          //Estado del evento, activo = 1. Se usa en la sentencia SQL
          $estado = 1;

          switch (true) 
          {

               case ($_POST['filtro'] == 'semana' || $_POST['filtro'] == ''):

                     $en_semana= date('Y-m-d', strtotime("+7 day"));

                    //pregunta si hay eventos en la semana
                    $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                      DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento, estado 
                                FROM eventos 
                                WHERE tipo = $tipo AND estado = $estado AND fechainicio BETWEEN '$hoy' AND '$en_semana' 
                                ORDER BY fechainicio ASC;"; 

                    $filtro_dia="semana";

               break;
               
               case ($_POST['filtro'] == 'mes'):

                     $en_semana= date('Y-m-d', strtotime("+31 day"));

                    //pregunta si hay eventos en la semana
                    $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                      DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento, estado 
                                FROM eventos 
                                WHERE tipo = $tipo AND estado = $estado AND fechainicio BETWEEN '$hoy' AND '$en_semana'
                                ORDER BY fechainicio ASC;";

                    $filtro_dia="mes";             

               break;

               case ($_POST['filtro'] == 'todos'):


                    //pregunta si hay eventos en cualquier momento
                    $consulta="SELECT ideventos, idusuarios, tipo, nombre, nombreevento, direccion , descripcion,  DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, 
                                        DATE_FORMAT(horainicio,'%H:%i') as horainicio, DATE_FORMAT(horafin,'%H:%i') as horafin,fotoperfil, fotoevento,estado 
                               FROM eventos 
                               WHERE tipo = $tipo AND fechainicio >= '$hoy' AND estado = $estado
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

      public function updateEvento($nombreevento, $fechainicio, $horainicio, $horafin, $descripcion, $fotoevento, $direccion, $tipo, $id_evento, $datosUsuario)
      { 
          
          if($direccion == 'no')
          {
            $consulta = " UPDATE eventos SET nombreevento = ?, descripcion = ?, fechainicio = ?, horainicio = ?, horafin = ?, fotoevento = ? WHERE ideventos = ? ";
            
            $sentencia = $this->conexion_db->prepare($consulta);


            $sentencia->bind_param("ssssssi", $nombreevento, $descripcion, $fechainicio, $horainicio, $horafin, $fotoevento, $id_evento);
          }
          else
          {
            $consulta = " UPDATE eventos SET nombreevento = ?, descripcion = ?, fechainicio = ?, horainicio = ?, horafin = ?, fotoevento = ?, direccion = ? WHERE ideventos = ? ";

            $sentencia = $this->conexion_db->prepare($consulta);

            $sentencia->bind_param("sssssssi", $nombreevento, $descripcion, $fechainicio, $horainicio, $horafin, $fotoevento, $direccion, $id_evento);
          }
          
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
      
      public function dehabilitarEvento($idEvento)
      { 
          $estado = 100;
          
          $consulta = " UPDATE eventos SET estado = ? WHERE ideventos = ? ";

          $sentencia = $this->conexion_db->prepare($consulta);

          $sentencia->bind_param("ii", $estado, $idEvento);

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
      
      public function getEventoGanador($tipo)
      {
          $hoy = date("Y-m-d");
          $hora_hoy  = date("H:i:s");
          
          $hora_hoy=strtotime($hora_hoy);
          $hora_nuevo_dia=strtotime('00:00');
          $hora_nuevo_dia_hasta=strtotime('03:00');

         if($hora_hoy >= $hora_nuevo_dia && $hora_hoy <=$hora_nuevo_dia_hasta)
         {
            $dia_comparar = new DateTime($hoy);
            $dia_comparar->modify('-1 day');
            $dia_comparar = $dia_comparar->format('Y-m-d');
            
            $fecha1=  $dia_comparar ." ". "21:00";
            $fecha2=  $hoy ." ". "03:00";
             
         }
         else
         {
            $dia_comparar= new DateTime($hoy);
            $dia_comparar->modify('+1 day');
            $dia_comparar = $dia_comparar->format('Y-m-d');
          
            $fecha1=  $hoy ." ". "21:00";
            $fecha2=  $dia_comparar ." ". "03:00";      
             
         }
                
               
          $consulta="SELECT e.nombreevento, e.nombre, v.cantidad_voto 
                     FROM votacion_evento v 
                     INNER JOIN eventos e ON e.ideventos = v.id_evento 
                     WHERE e.tipo=$tipo  
                     AND v.cantidad_voto= (SELECT MAX(v.cantidad_voto) FROM votacion_evento WHERE CONCAT(e.fechainicio ,' ', e.horainicio) BETWEEN '$fecha1' AND '$fecha2');";
                 
          $resultado = $this->conexion_db->query($consulta);
         
          

          if(!$resultado)
          {
             
            $contenido="Fallo al ejecutarse la consulta getEventoGanador:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";
            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

          }

       
          $fila_ganador = $resultado->fetch_array(MYSQLI_ASSOC);
                
          return $fila_ganador;
                  
          
      }


      public function habilitarEvento($idEvento)
      { 
          $estado = 1;
          
          $consulta = " UPDATE eventos SET estado = ? WHERE ideventos = ? ";

          $sentencia = $this->conexion_db->prepare($consulta);

          $sentencia->bind_param("ii", $estado, $idEvento);

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
      
      public function borrarEvento($idEvento)
      { 
          $estado = 0;
          
          $consulta = " UPDATE eventos SET estado = ? WHERE ideventos = ? ";

          $sentencia = $this->conexion_db->prepare($consulta);

          $sentencia->bind_param("ii", $estado, $idEvento);

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
      
      public function verEventosFin($idusuario)
      {
          $consulta="SELECT ideventos, nombreevento, direccion , DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, fotoevento
                      FROM eventos 
                      WHERE idusuarios = $idusuario AND fechainicio < now()";
          
                      $resultadoFin = $this->conexion_db->query($consulta);

                      if(!$resultadoFin)
                      {

                        $contenido="Fallo al ejecutarse la consulta getEventos en cualquier momento:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

                        $log = new logs();

                        $log->setLog($contenido);

                        return $this->mje_error;

                      }
                      
                      return $resultadoFin;
      }
      
      public function verEventosProx($idusuario)
      {
          $consulta="SELECT ideventos, nombreevento, direccion , DATE_FORMAT(fechainicio,'%d/%m/%Y') as fecha_inicio, fotoevento
                      FROM eventos 
                      WHERE idusuarios = $idusuario AND fechainicio > now()";
          
                      $resultadoProx = $this->conexion_db->query($consulta);

                      if(!$resultadoProx)
                      {

                        $contenido="Fallo al ejecutarse la consulta getEventos en cualquier momento:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

                        $log = new logs();

                        $log->setLog($contenido);

                        return $this->mje_error;

                      }
                      
                      
                      
                      $this->conexion_db->close();
                      
                      return $resultadoProx;
      }
      
      
      
  }      


?>