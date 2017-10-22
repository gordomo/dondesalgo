<?php

 require_once("modelo/conexion.php");
 require_once("modelo/logs.php");
   
   class filtros extends conexion
   {
      
      protected $mje_error;

      public function filtros()
      {

         parent::conexion();

         $this->mje_error=99;

      } 

      public function buscadorNav($texto,$filtro_busqueda)
      {
           
        $consulta="SELECT u.idusuarios, u.nombre, t.descripcion, u.tipo 
                    FROM usuarios u 
                    INNER JOIN tiposusuario t ON t.tipo = u.tipo 
                    WHERE u.nombre LIKE CONCAT('%',?,'%') AND u.tipo <> 1 ";
         
        switch ($filtro_busqueda)
        {
            case 2:
                $consulta.= " AND u.tipo = 2 ";
            break;
            case 3:
                $consulta.= " AND u.tipo = 3 ";
            break;
            case 4:
                $consulta.= " AND u.tipo = 4 ";
            break;
            case 5:
                $consulta.= " AND u.tipo = 5 ";
            break;
                    
        }           
          
         $consulta.=" ORDER BY u.tipo;";        

         $sentencia = $this->conexion_db->prepare($consulta);

         $sentencia->bind_param("s", $texto);
                 
         if(!$sentencia->execute())
         {                       
            $contenido="Fallo al ejecutarse la consulta buscador:  (" . $sentencia->errno . ")" . $sentencia->error.".";

            $log = new logs();

            $log->setLog($contenido);

            return $this->mje_error;
         } 

         $resultado = $sentencia->get_result();
         
         $sentencia->close();
         $this->conexion_db->close();
         
         $host= $_SERVER["HTTP_HOST"];
         $url= $_SERVER["REQUEST_URI"];
         
         $combo='';
         if(!empty($resultado))
         {   
            $i= array(0,0,0,0,0);
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) 
            {
                switch ($fila['tipo'])
                {
                    case 2:
                        if($i[0] == 0)
                        {    
                            $combo.='<li class="categorias">'.$fila["descripcion"].'</li>';
                            $i[0]++;
                        }
                    break;
                    case 3:
                        if($i[1] == 0)
                        {
                            $combo.='<li class="categorias">'.$fila["descripcion"].'</li>';
                            $i[1]++;
                        }
                    break;
                    case 4:
                        if($i[2] == 0)
                        {
                            $combo.='<li class="categorias">'.$fila["descripcion"].'</li>';
                            $i[1]++;
                        }
                    break;
                    
                }                               
                $combo.='<a href="http://'.$host.$url.'?usuario='.$fila["idusuarios"].'" class="listado_buscador">';
                $combo.='<li>'.$fila["nombre"].'</li></a>';
                $combo.='</a>';
            }     
         }
         
         return $combo;
         
      }

    
      
    }




?>