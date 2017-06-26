<?php
      
      class mails 
      {
            
            public function mails()
            {
                  
            }

            public function enviar_contacto($nombre,$apellido,$telefono,$email,$comentario)
            {

                  $header = 'De: ' . $email . " rn";

                  $mensaje = "Detalles del formulario de contacto:\n\n";
                  $mensaje .= "Nombre: " . $nombre . "\n";
                  $mensaje .= "Apellido: " . $apellido . "\n";
                  $mensaje .= "Teléfono: " . $telefono . "\n";
                  $mensaje .= "Emial: " . $email . "\n";
                  $mensaje .= "Mensaje: " . $comentario . "\n\n";
                  //$mensaje .= "Archivo adjunto: " . $_FILES['archivo'] . "\n\n";

                  $para = 'vivaldi.matias@gmail.com';
                  $asunto = 'Contacto por donde salgo';

                  mail($para, $asunto, $mensaje, $header);
                  
            }



      }
      


?>            