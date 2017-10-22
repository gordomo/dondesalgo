<?php

 require_once("modelo/conexion.php");
 require_once("modelo/logs.php");
   
   class usuarios extends conexion
   {
      
      protected $mje_error;

      public function usuarios()
      {

         parent::conexion();

         $this->mje_error=99;

      }

      public function setPersonas($nombre, $apellido, $email, $clave, $fecha, $sexo)
      {

         $consulta="INSERT INTO usuarios (tipo, email, clave, nombre, apellido, fechanacimiento, sexo, estado) VALUES (1, ?, ?, ?, ?, ?, ?, 1)";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("ssssss", $email, $clave, $nombre, $apellido, $fecha, $sexo);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta setPersonas:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return  $this->mje_error;

         }

         $sentencia->close();

         $this->conexion_db->close();

      }

      public function setBoliches($nombre,$direccion,$telefono,$email,$clave,$idcodigo)
      {

         $consulta="INSERT INTO usuarios (tipo, email, clave, idcodigo, nombre, direccion, telefono, estado) VALUES (2, ?, ?, ?, ?, ?, ?, 1)";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("ssisss", $email, $clave, $idcodigo, $nombre, $direccion, $telefono);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta setBoliches:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $sentencia->close();

         $this->conexion_db->close();

      }

      public function setOrganizador($nombre,$email,$clave,$idcodigo)
      {

         $consulta="INSERT INTO usuarios (tipo, email, clave, idcodigo, nombre, estado) VALUES (3, ?, ?, ?, ?, 1)";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("ssis", $email, $clave, $idcodigo, $nombre);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta setOrganizador:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $sentencia->close();

         $this->conexion_db->close();

      }

      public function loginUsuarios($email, $clave)
      {

         $consulta="SELECT count(*) as cantidad, idusuarios, tipo, nombre FROM usuarios WHERE email = ? && clave = ? ";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("ss", $email, $clave);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta loginUsuarios:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $resultado = $sentencia->get_result();

         $fila = $resultado->fetch_assoc();

         $sentencia->close();

         if($fila['cantidad'] > 0)
         {
            
            switch ($fila['tipo']) 
            {
               case 1:
                  $_SESSION["persona"] = $fila['tipo'];
               break;

               case 2:
                 $_SESSION["boliche"] = $fila['tipo'];
               break;

               case 3:
                 $_SESSION["organizador"] = $fila['tipo'];
               break;

               case 100:
                 $_SESSION["admin"] = $fila['tipo'];
               break;
               
               default:
                  # code...
               break;
            }
           
            $_SESSION["id"] = $fila['idusuarios'];

            $_SESSION["nombre"] = $fila['nombre'];

            return 1;
         }
         else 
         {

            return 0;
           
         }

         $this->conexion_db->close(); 
         

      }

      public function getDatosUsuario($idusuario = 0)
      {
         if($idusuario == 0)
         {
             $idusuario = $_SESSION["id"];
         }
         

         $consulta="SELECT tipo, nombre, direccion, fotoperfil FROM usuarios WHERE idusuarios = $idusuario";

         $resultado = $this->conexion_db->query($consulta);

         if(!$resultado)
         {

            $contenido="Fallo al ejecutarse la consulta getDatosUsuario:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $datosUsuario = $resultado->fetch_array(MYSQLI_ASSOC);

         return $datosUsuario;

      }
      
      public function getTipoUsuario($idUsuario)
      {
          $consulta="SELECT tipo FROM usuarios WHERE idusuarios = $idUsuario";

          $resultado = $this->conexion_db->query($consulta);
          
          if(!$resultado)
          {

            $contenido="Fallo al ejecutarse la consulta getDatosUsuario:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

          }

            $tipoUsuario = $resultado->fetch_array(MYSQLI_ASSOC);

          return $tipoUsuario;  
          
          
      }
      
      public function verPerfil($idusuario)
      {
         $consulta="SELECT tipo, email, nombre, apellido, direccion, telefono, contacto, fotoperfil, estado FROM usuarios WHERE idusuarios = $idusuario";

         $resultado = $this->conexion_db->query($consulta);

         if(!$resultado)
         {

            $contenido="Fallo al ejecutarse la consulta getDatosUsuario:  (" . $this->conexion_db->errno . ")" . $this->conexion_db->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $datosPerfil = $resultado->fetch_array(MYSQLI_ASSOC);

         return $datosPerfil;

      }
      
    }




?>