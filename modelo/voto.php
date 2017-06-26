<?php

 require_once("modelo/conexion.php");
 require_once("modelo/logs.php");
   
   class voto extends conexion
   {
      
      protected $mje_error;

      public function usuarios()
      {

         parent::conexion();

         $this->mje_error=99;


      }

      public function setVotoUsuario($idevento,$fechaYhora)
      {

         $id_user =$_SESSION['id'];

         $consulta="INSERT INTO votacion_usuario (id_usuario, id_evento, voto) VALUES ($id_user, ?, ?)";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("is", $idevento,$fechaYhora);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta setVoto:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return  $this->mje_error;

         }

         $sentencia->close();


      }

     

      public function setVotoEvento($idevento)
      {


         $consulta="SELECT id_votacion_evento FROM votacion_evento WHERE id_evento = ?";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("i", $idevento);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta setVotoEvento en SELECT:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $resultado = $sentencia->get_result();

         $fila = $resultado->fetch_assoc();

         $id_voto_evento=$fila['id_votacion_evento'];

         $sentencia->close();


         if($id_voto_evento == null)
         {

            $consulta="INSERT INTO votacion_evento (id_evento, cantidad_voto) VALUES (?, 1)";

            $sentencia = $this->conexion_db->prepare($consulta);

            $sentencia->bind_param("i", $idevento);

            if(!$sentencia->execute())
            {

               $contenido="Fallo al ejecutarse la consulta setVotoEvento en INSERT:  (" . $sentencia->errno . ")" . $sentencia->error.".";

               $log = new logs();

               $log->setLog($contenido);

               return  $this->mje_error;

            }

            $sentencia->close();

            $this->conexion_db->close();


         }
         else
         {


            $consulta="UPDATE votacion_evento SET cantidad_voto = cantidad_voto+1  WHERE id_votacion_evento = $id_voto_evento";

            $resultado = $this->conexion_db->query($consulta);

            if(!$resultado)
            {

               $contenido="Fallo al ejecutarse la consulta setVotoEvento en UPDATE:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

               $log = new logs();

               $log->setLog($contenido);

               return $this->mje_error;

            }

            $this->conexion_db->close();

         }   


        

      }

      public function getVotoUsuario($fecha, $hora_inicio)
      {

         $idusuario = $_SESSION["id"];

         $fecha_inicio = explode('/',$fecha);
         $fecha_inicio = $fecha_inicio[2]."-".$fecha_inicio[1]."-".$fecha_inicio[0];

         $hora_evento=strtotime($hora_inicio);

         $hora_nuevo_dia=strtotime('00:00');
         $hora_nuevo_dia_hasta=strtotime('03:00');

         if($hora_evento >= $hora_nuevo_dia && $hora_evento <=$hora_nuevo_dia_hasta)
         {   
            
            $dia_comparar = new DateTime($fecha_inicio);
            $dia_comparar->modify('-1 day');
            $dia_comparar = $dia_comparar->format('Y-m-d');

            $fecha1=  $dia_comparar ." ". "21:00";
            $fecha2=  $fecha_inicio ." ". "03:00";

            $consulta="SELECT COUNT(*) as cantidad FROM votacion_usuario WHERE id_usuario=$idusuario AND voto BETWEEN  '$fecha1' AND '$fecha2';";

         }
         else
         {
           
            $dia_comparar = new DateTime($fecha_inicio);
            $dia_comparar->modify('+1 day');
            $dia_comparar = $dia_comparar->format('Y-m-d');

            $fecha1=  $fecha_inicio ." ". "21:00";
            $fecha2=  $dia_comparar ." ". "03:00";

            $consulta="SELECT COUNT(*) as cantidad FROM votacion_usuario WHERE id_usuario=$idusuario AND voto BETWEEN  '$fecha1' AND '$fecha2';";
            
         } 

         $resultado = $this->conexion_db->query($consulta);

         if(!$resultado)
         {

            $contenido="Fallo al ejecutarse la consulta getVotoUsuario:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $fila= $resultado->fetch_assoc();

         return $fila['cantidad'];


      }


   }




?>