<script type="text/javascript">

    $(document).ready(function ()
    {  
        locations = [];
        eventos = [];
        
        if(locations){
            $("#divMapaSpinner").addClass('spinner');
            $.ajax({
              url: "controlador/mapaController.php?action=getEventos",
              context: document.body,
              data: {action: "getEventos"},
              dataType: "json",
              type: "POST",
              success: function(result) {
                if(!jQuery.isEmptyObject(result)){
                  $.each(result, function(k, v) {
                    if(v.lat && v.lng){
                        locations.push({lat:v.lat, lng:v.lng});
                        $("#navEventos").append("<li class='list-group-item'>"+v.nombreevento+
                            "<span class='nope'><br>"
                            +v.nombre+"<br>"
                            +v.direccion+"<br>"
                            +v.descripcion+"<br>"
                            +v.horainicio+"<br>"
                            +v.fecha_inicio+"<br>"
                            +"</span></li>");
                    }
                  });
                  $("#divMapaSpinner").hide();
                  $("#divMapa").show('fast');

                  $("#navEventos li").click(function(){
                    $(this).find("span").toggle();
                    $(this).toggleClass("active");
                  });

                  initMap2(locations);
                }
                else{
                    $("#divMapaSpinner").html('<h1>No hay eventos disponibles</h1>');
                    $("#divMapaSpinner").removeClass('spinner');
                }
             },
             error: function(jqXHR, textStatus, errorThrown){
                $("#divMapaSpinner").html('<h1>Ocurrio un error buscando la ubicación de algún evento. Por favor, intente refrescando la página</h1>');
                $("#divMapaSpinner").removeClass('spinner');
             },
             timeout: 35000 // sets timeout to 35 seconds
      });
    }

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
        elseif (isset($deshabilitarAdm)) 
        {
            ?>                    
            boliches();

            $.confirm({
                title: 'Evento deshabilidato',
                content: 'El evento ha sido deshabilitado con exito.',
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
        elseif (isset($habilitarAdm)) 
        {
            ?>                    
            boliches();

            $.confirm({
                title: 'Evento habilitado',
                content: 'El evento ha sido habilitado con exito.',
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
        elseif (isset($borrarEvento)) 
        {
            ?>                    
            boliches();

            $.confirm({
                title: 'Evento borrado',
                content: 'El evento ha sido borrado con exito.',
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

        case (isset($_GET['usuario'])):  
        ?>                 
        usuario();
        <?php                     
        break;

        case (isset($eliminarAdm)):
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
        

        function usuario()
        {
            $(".main").attr("class", "main row hidden");
            $("#menu9").attr("class", "main row show");
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
        
        //al votar el usuario

        $('.icono_voto').click(function (e) 
        {
            e.preventDefault(); 
            id_form_evento = $(this).next().attr('id');
                               
            var icono_voto = $(this).data("rango");        
            var votar_ajax = $("#"+id_form_evento).children(".enviar_voto").val();
            var id_evento = $("#"+id_form_evento).children("#id_evento").val();
            var fecha_inicio = $("#"+id_form_evento).children("#fecha_inicio").val();
            var hora_inicio = $("#"+id_form_evento).children("#hora_inicio").val();
            var mensaje_oculto_form = $("#"+id_form_evento).children("#mensaje_oculto_form").val();  

           <?php

            if (isset($_COOKIE['no_mensaje']) || isset($no_mensaje)) 
            {
           ?>

                
                $("#form_enviar_voto"+id_form_evento).submit();
                <?php
            } 
            else 
            {
                ?>
                $.confirm({
                    title: '¡Atencion!',
                    content: 'Solo podras votar 1 evento dentro del grupo de eventos que compita en una fecha determinada. Estas seguro que deseas votar a este evento?' +
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

                                        $.ajax({
                                        type: "POST",
                                        url: "index.php",
                                        data:{ votar_ajax: votar_ajax, id_evento: id_evento, fecha_inicio: fecha_inicio, hora_inicio: hora_inicio, mensaje_oculto_form: mensaje_oculto_form},
                                        beforeSend: function(){	
                                        },
                                        success: function(data){

                                            $("#"+id_form_evento).html("");
                                            
                                             $('[data-rango='+icono_voto+']').fadeOut("fast", function() 
                                             {
                                                $('[data-rango='+icono_voto+']').addClass("no_vota");                                             
                                                $('[data-rango='+icono_voto+']').fadeIn("slow");
                                             });
                                                                                    
                                        }
                                        });

                                        //$("#form_enviar_voto"+id_form_evento).submit();
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

        
        $('#foto_evento').click(function()
        {
            $('#foto_evento').hide();
            
            $('#div_foto_evento').append("<label for='imagen_evento' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding' id='div_portada' align='center' data-container='body' data-toggle='tooltip' data-placement='right' title='Agrega una foto de portada del evento aqui.'>\n\
                <span class='glyphicon glyphicon-plus' aria-hidden='true' id='icono_portada' ></span>\n\
                <input type='file' id='imagen_evento' name='imagen_evento' style='display: none;'></label>\n\
                <label for='imagen_evento' id='imagen_evento-error'  class='error' style='display: none;'></label>");

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
        //buscador de boliches,eventos,etc en el navegador
      
        $("#buscador").keyup(function(){
            
            filter_option= '';
            if($( "input[name='option_filter']").is(':checked'))
            {
              filter_option = $( "input[name='option_filter']:checked" ).val();             
            }
            
            $.ajax({
            type: "POST",
            url: "index.php",
            data:{ buscadorNav: $(this).val(), opcionFiltro : filter_option},
            beforeSend: function(){	
            },
            success: function(data){
                    $("#sugerencia_buscador").show();
                    $("#sugerencia_buscador ul").html(data);
            }
            });
	});
        
        //filtro de busqueda del navegador
        
        $(".fa-filter").click(function()
        {
             $( "#filtros_busqueda" ).toggle("slow");
             
             $(".fa-filter").toggleClass("activar");          
        });
        
        $( "input[name='option_filter']").click(function()
        {      
            $(".fa-filter").toggleClass("activar");
            $( "#filtros_busqueda" ).toggle("show");
        });
          
    });


</script>