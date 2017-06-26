<?php
    
    require("config.php");

    class conexion

    {

            protected $conexion_db;

            public function conexion()
            {


                $this->conexion_db = new mysqli(DB_HOST, DB_USUARIO, DB_CONTRA, DB_NOMBRE);

                $this->conexion_db->set_charset(DB_CHARSET);

                if($this->conexion_db->connect_errno)

                {

                    echo "Fallo al conectar a MySql: " . $this->conexion_db->connect_error;

                    return;

                }

                return $this->conexion_db;

            }

    }

?>

