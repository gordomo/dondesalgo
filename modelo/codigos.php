<?php

 require_once("modelo/conexion.php");
 require_once("modelo/logs.php");
   
   class codigos extends conexion
   {
      
      protected $mje_error;

      public function usuarios()
      {

         parent::conexion();

         $this->mje_error=99;

      }

      public function getIdcodigo($codigo)
      {

         $consulta="SELECT idcodigos FROM codigos WHERE codigo = '$codigo'";

         $resultado = $this->conexion_db->query($consulta);

         if(!$resultado)
         {

            $contenido="Fallo al ejecutarse la consulta getIdcodigo:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $fila = $resultado->fetch_array(MYSQLI_ASSOC);

         return $fila['idcodigos'];

      }

      public function actualizarCodigo($idcodigo)
      {

         $consulta="UPDATE codigos SET estado = 9 WHERE idcodigos = '$idcodigo'";

         $resultado = $this->conexion_db->query($consulta);

         if(!$resultado)
         {

            $contenido="Fallo al ejecutarse la consulta actualizarCodigo:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

      }


   }




?>