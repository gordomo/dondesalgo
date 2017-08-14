<script type="text/javascript">

    $(document).ready(function ()
    {


<?php
switch (true) {
    case (isset($msje_exito_registro)):

        if (isset($_POST['registrar_persona'])) {
            ?>
                    registro();

                    $.confirm({
                        title: '¡Felicitaciones!',
                        content: 'Ya estas registrado para ver todo lo bueno de la noche...',
                        type: 'purple',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-purple',

                                        action: function ()
                                        {
                                            login();
                                        }
                                    },
                        }
                    });
            <?php
        } elseif (isset($_POST['registrar_boliche'])) {
            ?>
                    seguir_registro();
                    $(".boliche.formulario").show();

                    $.confirm({
                        title: '¡Felicitaciones!',
                        content: 'Ya estas registrado para publicar tus eventos...',
                        type: 'purple',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-purple',

                                        action: function ()
                                        {
                                            $(".formulario").hide();
                                            $(".usuario.formulario").show();
                                            $("#lugar").removeAttr("checked");
                                            $("#usuario").attr("checked", "checked")
                                            login();
                                        }
                                    },
                        }
                    });
            <?php
        } elseif (isset($_POST['registrar_organizador'])) {
            ?>
                    seguir_registro();
                    $(".organizador.formulario").show();

                    $.confirm({
                        title: '¡Felicitaciones!',
                        content: 'Ya estas registrado para publicar tu gran evento...',
                        type: 'purple',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-purple',

                                        action: function ()
                                        {
                                            $(".formulario").hide();
                                            $(".usuario.formulario").show();
                                            $("#lugar").removeAttr("checked");
                                            $("#usuario").attr("checked", "checked");
                                            login();
                                        }
                                    },
                        }
                    });
            <?php
        }

        break;

    case (isset($mensaje_usuario_repetido)):

        if (isset($_POST['registrar_persona'])) {
            ?>
                    registro();
            <?php
        } elseif (isset($_POST['registrar_boliche'])) {
            ?>
                    seguir_registro();
                    $(".boliche.formulario").show();
            <?php
        } elseif (isset($_POST['registrar_organizador'])) {
            ?>
                    seguir_registro();
                    $(".organizador.formulario").show();
            <?php
        }
        ?>

                $.alert({
                    title: '¡Atencion!',
                    content: 'Este usuario ya existe',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        OK:
                                {
                                    btnClass: 'btn-orange',

                                },
                    }
                });
        <?php
        break;

    case (isset($_POST['login_usuario'])):

        if (isset($mensaje_error_login)) {
            ?>
                    login();

                    $.alert({
                        title: '¡Atencion!',
                        content: 'Usuario o contrasaña invalida',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-red',

                                    },
                        }
                    });
            <?php
        } elseif (isset($seguir)) {

            if (isset($_SESSION['boliche']) || isset($_SESSION['organizador'])) {
                ?>
                        evento();
                <?php
            } else {
                ?>
                        boliches();
                <?php
            }
        }

        break;

    case (isset($_POST['contacto_usuario'])):


        if (isset($msje_exito_contacto)) {
            ?>
                    contacto();

                    $.confirm({
                        title: '¡Listo!',
                        content: 'Has enviado el mensaje con exito.',
                        type: 'purple',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-purple',

                                        action: function ()
                                        {
                                            registro();
                                        }


                                    },
                        }
                    });
            <?php
        } elseif (isset($msje_error_contacto)) {
            ?>
                    contacto();

                    $.alert({
                        title: '¡Error inesperado!',
                        content: 'El mensaje no ha llegado a nosotros, por favor intente mas tarde.',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-red',

                                    },
                        }
                    });

            <?php
        }
        break;

    case (isset($_POST['validar_codigo'])):

        if (isset($seguir_registro_boliche)) {
            ?>
                    seguir_registro();
                    $(".boliche.formulario").show();

            <?php
        } elseif (isset($seguir_registro_organizador)) {
            ?>
                    seguir_registro();
                    $(".organizador.formulario").show();
            <?php
        } elseif (isset($mensaje_error_codigo)) {
            ?>
                    codigo();

                    $.alert({
                        title: '¡Atencion!',
                        content: 'Codigo invalido',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-red',

                                    },
                        }
                    });

            <?php
        }
        break;

    case (isset($mensaje_error_grande)):

        if (isset($_POST['crear_evento'])) {
            ?>
                    evento();

            <?php
        } elseif (isset($_POST['crear_perfil'])) {
            ?>
                    perfil();
            <?php
        }
        ?>

                $.alert({
                    title: '¡Atencion!',
                    content: 'Este Archivo es muy pesado',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        OK:
                                {
                                    btnClass: 'btn-orange',

                                },
                    }
                });
        <?php
        break;

    case ( isset($mensaje_error_formato)):

        if (isset($_POST['crear_evento'])) {
            ?>
                    evento();

            <?php
        } elseif (isset($_POST['crear_perfil'])) {
            ?>
                    perfil();
            <?php
        }
        ?>

                $.alert({
                    title: '¡Atencion!',
                    content: 'Los formatos de imagen aceptables son: JPG, JPEG, PNG',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        OK:
                                {
                                    btnClass: 'btn-orange',

                                },
                    }
                });
        <?php
        break;

    case (isset($mensaje_exito)):

                if(isset($_POST['crear_evento']))
                {
                    
?>
                    evento();

                    $.confirm({
                            title: '¡Listo!',
                            content: 'Has creado el evento con exito.',
                            type: 'purple',
                            typeAnimated: true,
                            buttons: {
                                        OK:  
                                          {   
                                              btnClass: 'btn-purple',

                                               action: function()
                                              {
                                                boliches();
                                              }


                                          },
                                      }
                            });
<?php                        
                }
                elseif (isset($_POST['editar_evento'])) 
                {
?>                    
                    boliches();
                    
                    $.confirm({
                            title: '¡Listo!',
                            content: 'El evento ha sido editado con exito.',
                            type: 'purple',
                            typeAnimated: true,
                            buttons: {
                                        OK:  
                                          {   
                                              btnClass: 'btn-purple',

                                               action: function()
                                              {
                                                boliches();
                                              }


                                          },
                                      }
                            });
<?php                            
                }
                elseif (isset($eliminarAdm)) 
                {
?>                    
                    boliches();
                    
                    $.confirm({
                            title: 'Evento eliminado',
                            content: 'El evento ha sido eliminado con exito.',
                            type: 'purple',
                            typeAnimated: true,
                            buttons: {
                                        OK:  
                                          {   
                                              btnClass: 'btn-purple',

                                               action: function()
                                              {
                                                boliches();
                                              }


                                          },
                                      }
                            });
<?php                    
                }
                elseif (isset($republicarAdm)) 
                {
?>                    
                    boliches();
                    
                    $.confirm({
                            title: 'Evento republicado',
                            content: 'El evento ha sido republicado con exito.',
                            type: 'purple',
                            typeAnimated: true,
                            buttons: {
                                        OK:  
                                          {   
                                              btnClass: 'btn-purple',

                                               action: function()
                                              {
                                                boliches();
                                              }


                                          },
                                      }
                            });
<?php                    
                }
                elseif (isset($_POST['crear_perfil'])) 
                {
?>                   
                    perfil();

                    $.alert({
                        title: '¡Listo!',
                        content: 'Ya tienes foto de perfil.',
                        type: 'purple',
                        typeAnimated: true,
                        buttons: {
                            OK:
                                    {
                                        btnClass: 'btn-purple',

                                    },
                        }
                    });
            <?php
        }

    break;

    case (isset($mensaje_error_interno)):
        ?>

                boliches();

                $.alert({
                    title: '¡Atencion!',
                    content: 'Se ha producido un error interno. Intente mas tarde..',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                                OK:  
                                  {   
                                      btnClass: 'btn-red',

                                  },
                              }
                }); 
<?php                     
            break;

    case (isset($_GET['boliche']) || isset($_POST['enviar_filtro_boliche'])):  
?>                 
     boliches();
<?php                     
    break;

    case (isset($eliminarAdm)):
     die('asd');
?>                 
     boliches();
<?php                     
    break;

    case (isset($_GET['previa']) || isset($_POST['enviar_filtro_bar'])):  
?>                 
     previas();
<?php                     
    break;
        
    case (isset($band)):

        if($band == 'editar')
        {
?>
            evento();
<?php
        }
        else
        {                  
?>
            boliches();
<?php
        }

    break;

    default:          
?>

        boliches();
<?php
break;

}
?>


        //$("#boton1, #boton_desp1").click(boliches);

        function boliches()
        {


            $(".main").attr("class", "main row hidden");
            $("#menu1").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');
            $("#boton1").css({"color": "#fff", "background-color": "#1D1D1D", "border-color": "#070707", "background-image": "none", "outline": "0",
                "-webkit-box-shadow": "inset 0 3px 5px rgba(0, 0, 0, .125)", "box-shadow": "inset 0 3px 5px rgba(0, 0, 0, .125)"});


        }


        //$("#boton2, #boton_desp2").click(previas);

        function previas()
        {

            $(".main").attr("class", "main row hidden");
            $("#menu2").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');
            $("#boton2").css({"color": "#fff", "background-color": "#1D1D1D", "border-color": "#070707", "background-image": "none", "outline": "0",
                "-webkit-box-shadow": "inset 0 3px 5px rgba(0, 0, 0, .125)", "box-shadow": "inset 0 3px 5px rgba(0, 0, 0, .125)"});

        }

        $("#boton3, #boton_desp3").click(ubicacion);

        function ubicacion()
        {

            $(".main").attr("class", "main row hidden");
            $("#menu3").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');
            $("#boton3").css({"color": "#fff", "background-color": "#1D1D1D", "border-color": "#070707", "background-image": "none", "outline": "0",
                "-webkit-box-shadow": "inset 0 3px 5px rgba(0, 0, 0, .125)", "box-shadow": "inset 0 3px 5px rgba(0, 0, 0, .125)"});

        }


        $("#boton4").click(registro);

        function registro()
        {

            $(".main").attr("class", "main row hidden");
            $("#menu4").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');

        }

        $("#boton5").click(login);

        function login()
        {
            $(".main").attr("class", "main row hidden");
            $("#menu5").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');

        }

        $("#boton6").click(contacto);

        function contacto()
        {
            $(".main").attr("class", "main row hidden");
            $("#menu6").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');

        }

        $("#boton7").click(evento);

        function evento()
        {
            $(".main").attr("class", "main row hidden");
            $("#menu7").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');

        }

        $(".boton8").click(perfil);

        function perfil()
        {
            $(".main").attr("class", "main row hidden");
            $("#menu8").attr("class", "main row show");
            $(".btnSeccion").removeAttr('style');

        }

        function codigo()
        {

            $(".main").attr("class", "main row hidden");
            $("#menu4").attr("class", "main row show");
            $("#usuario").removeAttr("checked");
            $("#lugar").attr("checked", "checked");
            $(".formulario").hide();
            $(".codigo.formulario").show();

        }

        function seguir_registro()
        {

            $(".main").attr("class", "main row hidden");
            $("#menu4").attr("class", "main row show");
            $("#usuario").removeAttr("checked");
            $("#lugar").attr("checked", "checked");
            $(".formulario").hide();

        }

        $('.enviar_voto').click(function (e) 
        {
            e.preventDefault();
            
<?php
            if (isset($_COOKIE['no_mensaje']) || isset($no_mensaje)) 
            {
?>
                $("#form_enviar_voto").submit();
<?php
            } 
            else 
            {
?>
                $.confirm({
                    title: '¡Atencion!',
                    content: 'Solo podras votar 1 evento por dia. Estas seguro que deseas votar a este evento?' +
                            '<div class="checkbox"><label><input type="checkbox" name="mensaje_oculto" class="mensaje_oculto" > No mostrar este mensaje</label></div>',
                    type: 'purple',
                    typeAnimated: true,
                    buttons: {
                        OK:
                                {
                                    btnClass: 'btn-purple',

                                    action: function ()
                                    {
                                        var checkbox = $('.mensaje_oculto').prop('checked');
                                        
                                        if(checkbox == true)
                                        {
                                           $("#mensaje_oculto_form").val(1);     
                                        }
                                        else
                                        {
                                           $("#mensaje_oculto_form").val(0);                                            
                                        }    

                                        $("#form_enviar_voto").submit();
                                    }
                                },

                        NO:
                                {

                                }
                    }
                });

<?php       } 
?>
        });
        
<?php
        if (isset($_SESSION['id'])) 
        {
             
?>        
            $( ".glyphicon-envelope" ).click(function() 
            {
                    $( "#evento_ganador" ).toggle("slow");

                    $(".glyphicon-envelope").toggleClass("activar");
            });
            
<?php            
            if(isset($resulGanador))
            {
?>                
                setInterval(function()
                {   $('.glyphicon-envelope').toggleClass('activar');
                    $('#numero_ganador').fadeIn(1000).delay(1000).fadeOut(1500).delay(500);
                }, 2000);
<?php             
            }            
  
            
        }    
?>

    /*
     
     var url = "index.php";
     var datosForm =$(".form_enviar_voto").serialize();
     
     $.ajax({                        
     type: "POST",                 
     url: url,                     
     data: {action:"enviar_voto" ,datosForm },
     success: function(data)             
     {
     alert('genial');              
     }
     });
     
     */
    });

</script>