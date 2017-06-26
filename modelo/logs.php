<?php
      
      class logs 
      {
            
            protected $fecha;
            protected $nombre_archivo;
            protected $direccion;
            protected $archivo;


            public function logs()
            {
                  $this->fecha          = date("Y-m-d");
                  $this->nombre_archivo = $this->fecha.".txt";
                  $this->direccion      = $_SERVER['DOCUMENT_ROOT'].'/sistema_boliche/logs/';
                  $this->archivo        = $this->direccion.$this->nombre_archivo;   
            }

            public function setLog($contenido)
            {
                  $log=fopen($this->archivo,"a") or die("Problemas en la creacion del log");

                  if (file_exists($this->archivo)) 
                  {
                        fwrite($log,$contenido . PHP_EOL);
                  } 
                  else 
                  {
                        fputs($log,$contenido);                       
                  }

                  fclose($log);
                  
            }



      }
      


?>            