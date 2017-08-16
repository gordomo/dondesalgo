<?php

require_once("modelo/conexion.php");
require_once("modelo/logs.php");
   
   class validacion extends conexion
   {
      protected $campos;
      protected $errors;
      protected $mje_error;
      protected $cant_errores;

      public function validacion()
      {

         parent::conexion();

         $this->errors= array();
         $this->mje_error=99;

      }

      public function validarCodigo($numero)
      {

         $consulta="SELECT codigo FROM codigos WHERE codigo = ? ";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("s", $numero);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta validarCodigo:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $sentencia->store_result();

         if($sentencia->num_rows() > 0)
         {
            
            $buscar='b';

            $posicion = strpos($numero, $buscar);

            if($posicion !== 0)
            {
               $buscar='o';

               $posicion = strpos($numero, $buscar);

               if($posicion === 0)
               {
                  return 2;
               }   

            }
            else
            {
               return 1;    
            }   
           
         }
         else
         {
            return 0;
         } 

         $sentencia->close();

         $this->conexion_db->close();  

      }

      public function validarUsuarioRepetido($email)
      {
            
         $consulta="SELECT email FROM usuarios WHERE email = ? ";

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("s", $email);

         if(!$sentencia->execute())
         {

            $contenido="Fallo al ejecutarse la consulta validarUsuarioRepetido: (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;

         }

         $sentencia->store_result();

         if($sentencia->num_rows > 0)
         {

            return 1;
         }
         else 
         {

            return 0;
         
         }

         $sentencia->close();

         $this->conexion_db->close(); 
         
      }

      public function validarRegistro($nombre, $apellido, $email, $clave, $fecha, $sexo)
      {
         
         //Campos del formulario
         $this->campos= array('Nombre'=>$nombre, 'Apellido'=>$apellido, 'Email'=>$email, 'Clave'=>$clave, 'Fecha'=>$fecha, 'Sexo'=>$sexo);

         //CAMPOS REQUERIDOS
         foreach ($this->campos as $nom_campo => $valor ) 
         {
            
            if ($valor =='')
            {
               $this->errors[]="El campo $nom_campo es requerido";

            }   
         }

         //CAMPO NOMBRE
         if(strlen($nombre)>30)
         {
            $this->errors[]="El campo nombre es demasiado largo";
         }
         elseif(strlen($nombre) == 1)
         {
            $this->errors[]="El campo nombre es demasiado corto";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ "; 

            for ($i=0; $i<strlen($nombre); $i++)
            { 
               if (strpos($permitidos, substr($nombre,$i,1))===false)
               { 
                 $this->errors[]="El campo nombre no es válido";
                 break;
               } 
            }
         } 

         //CAMPO APELLIDO
         if(strlen($apellido)>30)
         {
            $this->errors[]="El campo apellido es demasiado largo";
         }
         elseif(strlen($apellido)== 1)
         {
            $this->errors[]="El campo apellido es demasiado corto";

         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";

            for ($i=0; $i<strlen($apellido); $i++)
            { 
               if (strpos($permitidos, substr($apellido,$i,1))===false)
               { 
                 $this->errors[]="El campo apellido no es válido";
                 break;
               }
            }
         }

          //CAMPO EMAIL
         if($email != '')
         {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
               $this->errors[]="El formato del Email es invalido.";
    
            }
            else
            {
                if(strlen($email)> 60)
               {
                  $this->errors[]="El campo Email es demasiado largo.";

               }
               elseif(strlen($email)< 6)
               {
                  $this->errors[]="El campo Email es demasiado corto.";
               }
                 
            } 
         }     

         //CAMPO CLAVE
         if((strlen($clave)>0) && (strlen($clave)<4))
         {
            $this->errors[]="El campo clave es demasiado corto";

         }
         elseif(strlen($clave)>20)
         {
            $this->errors[]="El campo clave es demasiado largo";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789!";

            for ($i=0; $i<strlen($clave); $i++)
            { 
               if (strpos($permitidos, substr($clave,$i,1))===false)
               { 
                 $this->errors[]="El campo clave contiene caracteres no válidos";
                 break;
               }
            }
         }   

         //CAMPO FECHA
         if($fecha != '')
         {
            if(strstr($fecha, '.'))
            {
                     
               $par_fecha=explode (".",$fecha);

               //calcular año aceptable para que no sea un niño
               $Fechahoy=strtotime("now");
               $fecha_actual=date("d.m.Y",$Fechahoy);
               $fecha_partes=explode(".",$fecha_actual);
               $año_aceptable= $fecha_partes[2] - 12;

               if ($par_fecha[0]>31 || $par_fecha[0] <=0)
               {
                   $this->errors[] = "Debe ingresar una fecha valida. Formato DD.MM.YYYY" ;
               }
               elseif ($par_fecha[1] >12 || $par_fecha[1] <=0)
               {
                  $this->errors[] = " Debe ingresar una fecha valida. Formato DD.MM.YYYY";
               }
               elseif ( $par_fecha[2] < 1950)
               {
                  $this->errors[] = "Debe ingresar una fecha valida. Formato DD.MM.YYYY" ;
               }
               elseif (($Fecha= strtotime($fecha)) < -1) 
               {  
                  $this->errors[] = "Debe ingresar una fecha valida. Formato DD.MM.YYYY" ;
               }
               elseif ($año_aceptable < $par_fecha[2])
               {
                  $this->errors[] = "Eres solo un niño." ;
               }
            }
            else
            {
                $this->errors[] = "Fecha invalida. Formato de fecha valido DD.MM.YYYY" ;

            }
      }    
               

         //CAMPO SEXO
         if($sexo != '')
         {   
            if(!($sexo == 'm' ||  $sexo == 'f'))
            {
               $this->errors[]="El campo Sexo no es válido";
            } 
         }


         $this->cant_errores = count($this->errors);

         return $this->cant_errores;
      
      }


      public function validarRegistroBoliches($nombre, $direccion, $telefono, $email, $clave, $codigo)
      {
         
         //Campos del formulario
         $this->campos= array('Nombre'=>$nombre, 'Direccion'=>$direccion, 'Telefono'=>$telefono, 'Email'=>$email, 'Clave'=>$clave, 'Codigo'=>$codigo);

         //CAMPOS REQUERIDOS
         foreach ($this->campos as $nom_campo => $valor ) 
         {
            
            if ($valor =='')
            {
               $this->errors[]="El campo $nom_campo es requerido";

            }   
         }

         //CAMPO NOMBRE
         if(strlen($nombre)>30)
         {
            $this->errors[]="El campo nombre es demasiado largo";
         }
         elseif(strlen($nombre) == 1)
         {
            $this->errors[]="El campo nombre es demasiado corto";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ "; 

            for ($i=0; $i<strlen($nombre); $i++)
            { 
               if (strpos($permitidos, substr($nombre,$i,1))===false)
               { 
                 $this->errors[]="El campo nombre no es válido";
                 break;
               } 
            }
         } 

         //CAMPO DIRECCION
         if(strlen($direccion)>30)
         {
            $this->errors[]="El campo direccion es demasiado largo";
         }
         elseif(strlen($direccion)== 1)
         {
            $this->errors[]="El campo direccion es demasiado corto";

         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789 ";

            for ($i=0; $i<strlen($direccion); $i++)
            { 
               if (strpos($permitidos, substr($direccion,$i,1))===false)
               { 
                 $this->errors[]="El campo direccion no es válido";
                 break;
               }
            }
         }

         //CAMPO TELEFONO
         if(strlen($telefono)>30)
         {
            $this->errors[]="El campo telefono es demasiado largo";
         }
         elseif(strlen($telefono) < 6)
         {
            $this->errors[]="El campo telefono es demasiado corto";

         }
         else
         {
            $permitidos = "0123456789";

            for ($i=0; $i<strlen($telefono); $i++)
            { 
               if (strpos($permitidos, substr($telefono,$i,1))===false)
               { 
                 $this->errors[]="El campo telefono no es válido";
                 break;
               }
            }
         }

          //CAMPO EMAIL
         if($email != '')
         {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
               $this->errors[]="El formato del Email es invalido.";
    
            }
            else
            {
                if(strlen($email)> 60)
               {
                  $this->errors[]="El campo Email es demasiado largo.";

               }
               elseif(strlen($email)< 6)
               {
                  $this->errors[]="El campo Email es demasiado corto.";
               }
                 
            } 
         }     

         //CAMPO CLAVE
         if((strlen($clave)>0) && (strlen($clave)<4))
         {
            $this->errors[]="El campo clave es demasiado corto";

         }
         elseif(strlen($clave)>20)
         {
            $this->errors[]="El campo clave es demasiado largo";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789!";

            for ($i=0; $i<strlen($clave); $i++)
            { 
               if (strpos($permitidos, substr($clave,$i,1))===false)
               { 
                 $this->errors[]="El campo clave contiene caracteres no válidos";
                 break;
               }
            }
         }

         //CAMPO OCULTO CODIGO 
         if(strlen($codigo) == 1)
         {
            $this->errors[]="El campo codigo es demasiado corto";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyz123456789"; 

            for ($i=0; $i<strlen($codigo); $i++)
            { 
               if (strpos($permitidos, substr($codigo,$i,1))===false)
               { 
                 $this->errors[]="El campo codigo no es válido";
                 break;
               } 
            }
         }   

         

         $this->cant_errores = count($this->errors);

         return $this->cant_errores;
      
      }

      public function validarRegistroOrganizador($nombre, $email, $clave, $codigo)
      {
         
         //Campos del formulario
         $this->campos= array('Nombre'=>$nombre, 'Email'=>$email, 'Clave'=>$clave, 'Codigo'=>$codigo);

         //CAMPOS REQUERIDOS
         foreach ($this->campos as $nom_campo => $valor ) 
         {
            
            if ($valor =='')
            {
               $this->errors[]="El campo $nom_campo es requerido";

            }   
         }

         //CAMPO NOMBRE
         if(strlen($nombre)>30)
         {
            $this->errors[]="El campo nombre es demasiado largo";
         }
         elseif(strlen($nombre) == 1)
         {
            $this->errors[]="El campo nombre es demasiado corto";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ "; 

            for ($i=0; $i<strlen($nombre); $i++)
            { 
               if (strpos($permitidos, substr($nombre,$i,1))===false)
               { 
                 $this->errors[]="El campo nombre no es válido";
                 break;
               } 
            }
         } 


         //CAMPO EMAIL
         if($email != '')
         {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
               $this->errors[]="El formato del Email es invalido.";
    
            }
            else
            {
                if(strlen($email)> 60)
               {
                  $this->errors[]="El campo Email es demasiado largo.";

               }
               elseif(strlen($email)< 6)
               {
                  $this->errors[]="El campo Email es demasiado corto.";
               }
                 
            } 
         }     

         //CAMPO CLAVE
         if((strlen($clave)>0) && (strlen($clave)<4))
         {
            $this->errors[]="El campo clave es demasiado corto";

         }
         elseif(strlen($clave)>20)
         {
            $this->errors[]="El campo clave es demasiado largo";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789!";

            for ($i=0; $i<strlen($clave); $i++)
            { 
               if (strpos($permitidos, substr($clave,$i,1))===false)
               { 
                 $this->errors[]="El campo clave contiene caracteres no válidos";
                 break;
               }
            }
         }

         //CAMPO OCULTO CODIGO 
         if(strlen($codigo) == 1)
         {
            $this->errors[]="El campo codigo es demasiado corto";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyz123456789"; 

            for ($i=0; $i<strlen($codigo); $i++)
            { 
               if (strpos($permitidos, substr($codigo,$i,1))===false)
               { 
                 $this->errors[]="El campo codigo no es válido";
                 break;
               } 
            }
         }    

         $this->cant_errores = count($this->errors);

         return $this->cant_errores;
      
      }


      public function validarLogin($email, $clave)
      {
         
         //Campos del formulario
         $this->campos= array('Email'=>$email, 'Clave'=>$clave);

         //CAMPOS REQUERIDOS
         foreach ($this->campos as $nom_campo => $valor ) 
         {
            
            if ($valor =='')
            {
               $this->errors[]="El campo $nom_campo es requerido";

            }   
         }

         

          //CAMPO EMAIL
         if($email != '')
         {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
               $this->errors[]="El formato del Email es invalido.";
    
            }
            else
            {
                if(strlen($email)> 60)
               {
                  $this->errors[]="El campo Email es demasiado largo.";

               }
               elseif(strlen($email)< 6)
               {
                  $this->errors[]="El campo Email es demasiado corto.";
               }
                 
            } 
         }     

         //CAMPO CLAVE
         if((strlen($clave)>0) && (strlen($clave)<4))
         {
            $this->errors[]="El campo clave es demasiado corto";

         }
         elseif(strlen($clave)>20)
         {
            $this->errors[]="El campo clave es demasiado largo";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789!";

            for ($i=0; $i<strlen($clave); $i++)
            { 
               if (strpos($permitidos, substr($clave,$i,1))===false)
               { 
                 $this->errors[]="El campo clave contiene caracteres no válidos";
                 break;
               }
            }
         }   


         $this->cant_errores = count($this->errors);

         return $this->cant_errores;
      
      }

      public function validarEvento($titulo, $fecha, $hora_inicio, $hora_fin, $descripcion, $direccion, $tipo)
      {
         
         if($direccion == 'no' && $tipo =='no')
         {   
               //Campos del formulario
               $this->campos= array('Titulo'=>$titulo, 'Fecha'=>$fecha, 'Hora Inicio'=>$hora_inicio, 'Hora Fin'=>$hora_fin,'Descripcion'=>$descripcion);
         }
         else
         {
               //Campos del formulario
               $this->campos= array('Titulo'=>$titulo, 'Fecha'=>$fecha, 'Hora Inicio'=>$hora_inicio, 'Hora Fin'=>$hora_fin,'Descripcion'=>$descripcion,'Direccion'=>$direccion,'Tipo'=>$tipo);

         }      

         //CAMPOS REQUERIDOS
         foreach ($this->campos as $nom_campo => $valor ) 
         {
            
            if ($valor =='')
            {
               $this->errors[]="El campo $nom_campo es requerido";

            }   
         }

         //CAMPO TITULO
         if(strlen($titulo)>30)
         {
            $this->errors[]="El campo titulo es demasiado largo";
         }
         elseif(strlen($titulo) == 1)
         {
            $this->errors[]="El campo titulo es demasiado corto";
         }
         else
         {
            $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789 "; 

            for ($i=0; $i<strlen($titulo); $i++)
            { 
               if (strpos($permitidos, substr($titulo,$i,1))===false)
               { 
                 $this->errors[]="El campo titulo no es válido";
                 break;
               } 
            }
         } 


         //CAMPO FECHA
         if($fecha != '')
         {
            if(strstr($fecha, '.'))
            {
                     
               $par_fecha=explode (".",$fecha);

               //calcular año aceptable para que no sea un niño
               $Fechahoy=strtotime("now");
               $fecha_actual=date("d.m.Y",$Fechahoy);
               $fecha_partes=explode(".",$fecha_actual);

               if ($par_fecha[0]>31 || $par_fecha[0] <=0)
               {
                   $this->errors[] = "Debe ingresar una fecha valida. Formato DD.MM.YYYY" ;
               }
               elseif ($par_fecha[1] >12 || $par_fecha[1] <=0)
               {
                  $this->errors[] = " Debe ingresar una fecha valida. Formato DD.MM.YYYY";
               }
               elseif ( $par_fecha[2] < $fecha_partes[2])
               {
                  $this->errors[] = "No puede ingresar una año ya pasado" ;
               }
               elseif (($Fecha= strtotime($fecha)) < -1) 
               {  
                  $this->errors[] = "Debe ingresar una fecha valida. Formato DD.MM.YYYY" ;
               }
               
            }
            else
            {
                $this->errors[] = "Fecha invalida. Formato de fecha valido DD.MM.YYYY" ;

            }
         }

          //CAMPO HORA
         if($hora_inicio != '' || $hora_fin != '')
         {
                     
            $formato="/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])$/";

             if(!preg_match($formato,$hora_inicio))
             {
               $this->errors[] = "Hora Inicio invalida. Formato de hora valido HH.MM" ;

             }

             if(!preg_match($formato,$hora_fin))
             {
               $this->errors[] = "Hora Fin invalida. Formato de hora valido HH.MM" ;

             }   

         }    

          //CAMPO DESCRIPCION
         if(strlen($descripcion)>500)
         {
            $this->errors[]="El campo descripcion es demasiado largo";
         }
         elseif(strlen($descripcion) == 1)
         {
            $this->errors[]="El campo descripcion es demasiado corto";
         }
         else
         {
            $noPermitidos = "&{}"; 

            for ($i=0; $i<strlen($descripcion); $i++)
            { 
               if (strpos($permitidos, substr($descripcion,$i,1))===true)
               { 
                 $this->errors[]="El campo descripcion no es válido";
                 break;
               } 
            }
         }

         if($direccion != 'no')
         {   

               //CAMPO DIRECCION
               if(strlen($direccion)>30)
               {
                  $this->errors[]="El campo direccion es demasiado largo";
               }
               elseif(strlen($direccion)== 1)
               {
                  $this->errors[]="El campo direccion es demasiado corto";

               }
               else
               {
                  $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789 ";

                  for ($i=0; $i<strlen($direccion); $i++)
                  { 
                     if (strpos($permitidos, substr($direccion,$i,1))===false)
                     { 
                       $this->errors[]="El campo direccion no es válido";
                       break;
                     }
                  }
               }
                   
         }      


         $this->cant_errores = count($this->errors);

         return $this->cant_errores;
      
      }



      public function getMensaje()
      {
         
            $this->mje_error = '<p style="color: #f0444d;">Ocurrieron los siguientes errores:</p>';
            $this->mje_error .= '<ul style="color: #f0444d;">';

            foreach($this->errors as $error)
            {
               $this->mje_error .= "<li>$error</li>";
            }

            $this->mje_error .= '</ul>';

         
            return $this->mje_error;

      }


   }




?>