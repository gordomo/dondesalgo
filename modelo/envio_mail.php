<?php
    require("modelo/class.phpmailer.php");
    require("modelo/class.smtp.php");    

      class mails 
      {
            
            public function mails()
            {
                  
            }
            
            //modfificar a codigo nuevo el envio de mail
            
            public function enviar_contacto($nombre,$apellido,$telefono,$email,$comentario)
            {

                ini_set('max_execution_time', 300);

                // Datos de la cuenta de correo utilizada para enviar vía SMTP
                $smtpHost =  'smtp.gmail.com';  // Dominio alternativo brindado en el email de alta 
                $smtpUsuario = "proyecto.dondesalgo@gmail.com";  // Mi cuenta de correo
                $smtpClave = "Proyecto123";  // Mi contraseña

                // Email donde se enviaran los datos cargados en el formulario de contacto
                $emailDestino = "proyecto.dondesalgo@gmail.com";

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                //$mail->SMTPDebug = 2;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587; 
                $mail->IsHTML(true); 
                $mail->CharSet = "utf-8";

                // VALORES A MODIFICAR //
                $mail->Host = $smtpHost; 
                $mail->Username = $smtpUsuario; 
                $mail->Password = $smtpClave;

                $mail->From = $email; // Email desde donde envío el correo.
                $mail->FromName = $nombre;
                $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

                $mail->Subject = 'Contactó ' . $nombre. ' por DondeSalgo'; // Este es el titulo del email.
                $mensajeHtml = nl2br($comentario);

                // Texto del email en formato HTML

                $mail->Body = "<br /><br />";// línea vacía
                $mail->Body .= "Detalles del formulario de contacto: <br /><br />";
                $mail->Body .= "Nombre: " . $nombre . "<br />";
                $mail->Body .= "Apellido: " . $apellido . "<br />";
                $mail->Body .= "Teléfono: " . $telefono . "<br />";
                $mail->Body .= "Email: " . $email . "<br />";    
                $mail->Body .= "<br /><br />";// línea vacía
                $mail->Body .= "Mensaje: " . $mensajeHtml . "<br /><br />";
                $mail->Body .= "<br /><br />";// línea vacía

                // Texto sin formato HTML

                $mail->AltBody = "\r\n";// línea vacía
                $mail->AltBody .= "Detalles del formulario de contacto:\n\n";
                $mail->AltBody .= "Nombre: " . $nombre . "\n";
                $mail->AltBody .= "Apellido: " . $apellido . "\n";
                $mail->AltBody .= "Teléfono: " . $telefono . "\n";
                $mail->AltBody .= "Email: " . $email . "\n";     
                $mail->AltBody .= "\r\n";// línea vacía
                $mail->AltBody .= "Mensaje: " . $comentario . "\n\n";
                $mail->AltBody .= "\r\n";// línea vacía

                // FIN - VALORES A MODIFICAR //

                $estadoEnvio = $mail->Send();

                if($estadoEnvio)
                {
                    return 1;

                } 
                else 
                {
                    //echo  $mail->ErrorInfo;

                    return 0;
                }
                  
            }



      }
      


?>            