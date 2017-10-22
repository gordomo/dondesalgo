 $(document).ready(function()
{
    $('input[name=tipo]').click(function()
    {
        var inputValue = $(this).attr("value");
        var divMostrar = $("." + inputValue);

        $(".formulario").not(divMostrar).hide();
        $(divMostrar).show();
          
    });

    //ignora si el input esta hidden y lo valida igual
    $.validator.setDefaults({
        ignore: []
    });


    $("#form_registro_personas").validate
    ({

        rules:{
                nombre:{
                        required: true,
                        minlength:2,
                        character:true
                        },

                apellido:{
                        required: true,
                        minlength:2,
                        character:true
                        },

                 email:{
                        required: true,
                        email: true
                        },
                                    
                 clave:{
                        required: true,
                        minlength:4,
                        maxlength:15,
                        character:true
                        },
               
                fecha: { 
                        required: true,
                        dateISO: true,
                        character:true,
                        valiDate:true
                                                       
                        },

                sexo: { required: true,
                        character:true
                                                       
                       }        

              },

        messages: {

                nombre:{
                        required:'Debe ingresar un nombre',
                        minlength:'El nombre debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },

                apellido:{
                        required:'Debe ingresar un apellido',
                        minlength:'El apellido debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },

                email:{
                        required:'Debe ingresar un email',
                        email:'El formato de email no es correcto'
                      },

                clave:{
                        required:'Debe ingresar una clave',
                        minlength:'La clave debe tener al menos 4 caracteres',
                        maxlength:'La clave debe tener menos de 15 caracteres',
                        character: 'No se aceptan caracteres especiales'
                      },

                fecha:{
                        required:'Debe ingresar una fecha',
                        dateISO: 'El Formato de fecha es invalido',
                        character: 'No se aceptan caracteres especiales',
                        valiDate:'Eres solo un niño'
                    },

                sexo:{
                        required:'Debe ingresar un tipo de sexo',
                        character: 'No se aceptan caracteres especiales'
                    }
            }    
        
    });

    $("#form_registro_boliche").validate
    ({

        rules:{
                nombre:{
                        required: true,
                        minlength:2,
                        character:true
                        },

                direccion:{
                        required: true,
                        minlength:6,
                        character:true
                        },

                telefono:{
                        required: true,
                        digits:true,
                        minlength:6,
                        maxlength:20,
                        character:true
                        },        

                 email:{
                        required: true,
                        email: true
                        },
                                    
                 clave:{
                        required: true,
                        minlength:4,
                        maxlength:15,
                        character:true
                        }       

              },

        messages: {

                nombre:{
                        required:'Debe ingresar un nombre',
                        minlength:'El nombre debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },

                direccion:{
                        required:'Debe ingresar una direccion',
                        minlength:'La direccion debe tener al menos 6 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },

                telefono:{
                        required:'Debe ingresar un telefono', 
                        digits:'Solo se aceptan numeros',
                        minlength:'El telefono debe tener al menos 6 digitos',
                        maxlength:'El telefono no debe superar los 20 digitos',
                        character: 'No se aceptan caracteres especiales'
                        },        

                email:{
                        required:'Debe ingresar un email',
                        email:'El formato de email no es correcto'
                      },

                clave:{
                        required:'Debe ingresar una clave',
                        minlength:'La clave debe tener al menos 4 caracteres',
                        maxlength:'La clave debe tener menos de 15 caracteres',
                        character: 'No se aceptan caracteres especiales'
                      }

            }    
        
    });

    $("#form_registro_organizador").validate
    ({

        rules:{
                nombre:{
                        required: true,
                        minlength:2,
                        character:true
                        },

                 email:{
                        required: true,
                        email: true
                        },
                                    
                 clave:{
                        required: true,
                        minlength:4,
                        maxlength:15,
                        character:true
                        }       

              },

        messages: {

                nombre:{
                        required:'Debe ingresar un nombre',
                        minlength:'El nombre debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },       

                email:{
                        required:'Debe ingresar un email',
                        email:'El formato de email no es correcto'
                      },

                clave:{
                        required:'Debe ingresar una clave',
                        minlength:'La clave debe tener al menos 4 caracteres',
                        maxlength:'La clave debe tener menos de 15 caracteres',
                        character: 'No se aceptan caracteres especiales'
                      }

            }    
        
    });

    $("#form_login").validate
    ({
                    
        rules:{
                email:  {
                         required: true,
                        email: true
                        },
                                    
                 clave: {
                        required: true,
                        minlength:4,
                        maxlength:15,
                        character:true
                        }
               
              },

        messages:
            {
                
                email:{
                        required:'Debe ingresar un email',
                        email:'El formato de email no es correcto'
                        },

                clave:{
                        required:'Debe ingresar una clave',
                        minlength:'La clave debe tener al menos 4 caracteres',
                        maxlength:'La clave debe tener menos de 15 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        }
            }    
                        
    });

    $("#form_contacto").validate
    ({
                            
        rules:{
                nombre:{
                        required: true,
                        minlength:2,
                        character:true
                        },

                apellido:{
                        required: true,
                        minlength:2,
                        character:true
                        },

                telefono:{
                        required: true,
                        digits:true,
                        minlength:6,
                        maxlength:20,
                        character:true
                        },

                email:  {
                        required: true,
                        email: true
                        },
                mensaje: { 
                        required: true
                                                       
                        }

              },

        messages:
            {
                nombre:{
                        required:'Debe ingresar un nombre',
                        minlength:'El nombre debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },
                apellido:{
                        required:'Debe ingresar un apellido',
                        minlength:'El apellido debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },
                telefono:{
                        required:'Debe ingresar un telefono', 
                        digits:'Solo se aceptan numeros',
                        minlength:'El telefono debe tener al menos 6 digitos',
                        maxlength:'El telefono no debe superar los 20 digitos',
                        character: 'No se aceptan caracteres especiales'
                        },
                email:  {
                        required:'Debe ingresar un email',
                        email:'El formato de email no es correcto'
                       },
                mensaje:{required:'Debe escribir un mensaje'}
            }    
                                
    });

    $("#form_perfil").validate
    ({
                            
        rules:{
                foto_perfil:
                            {
                            required: true
                            }
              },

        messages:
            {
                foto_perfil:
                            {
                            required:'Debe ingresar una foto de perfil'
                            }     
            }    
                                
    });


    $("#form_evento").validate
    ({
                            
        rules:{
                perfil:{
                        required: true
                        },

                titulo_evento:{
                        required: true,
                        minlength:2,
                        character:true
                        },
                tipo_evento:{
                        required: true

                        },        
                fecha_evento: { 
                        required: true,
                        dateISO: true,
                        character:true
                                        
                        },
                hora_inicio: { 
                        required: true,
                        character:true
                                        
                        },
                 hora_fin: { 
                        required: true,
                        character:true
                                        
                        },

                 direccion:{
                        required: true,
                        minlength:6,
                        character:true
                        },                               

                imagen_evento:{
                        required: true
                        },
                        
                imagen_evento_e:{
                        required: true
                        },


                descripcion_evento: { 
                        required: true,
                        minlength:20,
                        character:true
                                                       
                        }

              },

        messages:
            {
                perfil:{
                        required:'Debe ingresar una foto de perfil'
                        },
                titulo_evento:{
                        required:'Debe ingresar un titulo para el evento',
                        minlength:'El titulo debe tener al menos 2 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },
                tipo_evento:{
                        required:'Debe ingresar un tipo de evento'

                    },        
                fecha_evento:{
                        required:'Debe ingresar la fecha del evento',
                        dateISO: 'El Formato de fecha es invalido',
                        character: 'No se aceptan caracteres especiales'
                    },

                hora_inicio: { 
                        required: 'Debe ingresar la hora que inicia el evento',
                        character: 'No se aceptan caracteres especiales'
                                        
                        },
                 hora_fin: { 
                        required: 'Debe ingresar la hora que finaliza el evento',
                        character: 'No se aceptan caracteres especiales'
                                        
                        },

                 direccion:{
                        required:'Debe ingresar una direccion',
                        minlength:'La direccion debe tener al menos 6 caracteres',
                        character: 'No se aceptan caracteres especiales'
                        },                
                                    
                imagen_evento:{
                        required:'Debe ingresar una portada para el evento'
                        },
                        
                imagen_evento_e:{
                        required:'Debe ingresar una portada para el evento'
                        },
                        
                descripcion_evento:{required:'Debe escribir una descripcion del evento',
                                    minlength:'La descripcion debe tener mas de 20 caracteres',
                                    character: 'No se aceptan caracteres especiales'}
            }    
                                
    }); 
                        

    //campo fecha del usuario

    $("#fecha").datepicker(
    {
          dateFormat: "dd.mm.yy",
          dayNamesMin: [ "D", "L", "M", "M", "J", "V", "S" ],
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          yearRange: "-100:+0",
          changeMonth: true,
          changeYear: true

    });


    $("#reset-fecha").click(function()
    {
      $('#fecha').val("");

    });

    //campo fecha del evento
     $("#fecha_evento").datepicker(
    {
          dateFormat: "dd.mm.yy",
          dayNamesMin: [ "D", "L", "M", "M", "J", "V", "S" ],
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          yearRange: "-0:+2",
          changeMonth: true,
          changeYear: true

    });


    $("#reset-fecha-evento").click(function()
    {
      $('#fecha_evento').val("");

    });

    $("#div_perfil").change(function ()
    {
                        
        if($('#foto_perfil').get(0).files.length === 1)
        {
            $('#div_perfil').css("border", "3px solid green");
            $('#icono_perfil').attr("class", "glyphicon glyphicon-ok");
            $('#icono_perfil').css("color", "green");
            $('#foto_perfil-error').css("display", "none"); 

        }
        else
        {
            $('#div_perfil').css({"border" : "3px solid #474747" , "cursor" : "pointer" });
            $('#icono_perfil').attr("class", "glyphicon glyphicon-plus");
            $('#icono_perfil').css("color", "#474747");
        }    

    });


    $("#div_perfil2").change(function ()
    {
                        
        if($('#perfil').get(0).files.length === 1)
        {
            $('#div_perfil2').css("border", "3px solid green");
            $('#icono_perfil2').attr("class", "glyphicon glyphicon-ok");
            $('#icono_perfil2').css("color", "green");
            $('#perfil-error').css("display", "none"); 

        }
        else
        {
            $('#div_perfil2').css({"border" : "3px solid #474747", "height" : "80px" , "cursor" : "pointer" });
            $('#icono_perfil2').attr("class", "glyphicon glyphicon-plus");
            $('#icono_perfil2').css("color", "#474747");
        }    

    });


    $("#div_portada").change(function ()
    {
                        
        if($('#imagen_evento').get(0).files.length === 1)
        {
            $('#div_portada').css("border", "3px solid green");
            $('#icono_portada').attr("class", "glyphicon glyphicon-ok");
            $('#icono_portada').css("color", "green");
            $('#imagen_evento-error').css("display", "none");

        }
        else
        {

            $('#div_portada').css({"border" : "3px solid #474747", "height" : "80px" , "cursor" : "pointer" });
            $('#icono_portada').attr("class", "glyphicon glyphicon-plus");
            $('#icono_portada').css("color", "#474747");
        }  


    });
    

    $('#crear_evento').click(function()
    {

          if($('#imagen_evento-error:visible'))
          {
                $('#div_portada').css("border", "3px solid red");
                $('#icono_portada').attr("class", "glyphicon glyphicon-remove");
                $('#icono_portada').css("color", "red");
          }

          if($('#perfil-error:visible'))
          {
                $('#div_perfil2').css("border", "3px solid red");
                $('#icono_perfil2').attr("class", "glyphicon glyphicon-remove");
                $('#icono_perfil2').css("color", "red");
          }

    });

    $('#crear_perfil').click(function()
    {  

        if($('#foto_perfil-error:visible'))
        {
            $('#div_perfil').css("border", "3px solid red");
            $('#icono_perfil').attr("class", "glyphicon glyphicon-remove");
            $('#icono_perfil').css("color", "red");
        }

    });      
            

    $(".resetiar").click(function()
    {

      $(".glyphicon.glyphicon-ok-sign").attr("class","glyphicon glyphicon-ok-sign hidden");
      $("#sexo").attr("style","");
      $("#form_login").validate().resetForm();
      $("#form_contacto").validate().resetForm();
      $("#form_registro_boliche").validate().resetForm();
      $("#form_registro_organizador").validate().resetForm();
      $("#form_registro_personas").validate().resetForm();
      $("#form_evento").validate().resetForm();
      $('#div_portada').css({"border" : "3px solid #474747", "height" : "80px" , "cursor" : "pointer" });
      $('#icono_portada').attr("class", "glyphicon glyphicon-plus");
      $('#icono_portada').css("color", "#474747");
      $('#div_perfil2').css({"border" : "3px solid #474747", "height" : "80px" , "cursor" : "pointer" });
      $('#icono_perfil2').attr("class", "glyphicon glyphicon-plus");
      $('#icono_perfil2').css("color", "#474747");
      $('#div_perfil').css({"border" : "3px solid #474747", "cursor" : "pointer" });
      $('#icono_perfil').attr("class", "glyphicon glyphicon-plus");
      $('#icono_perfil').css("color", "#474747");   
      $("#form_perfil").validate().resetForm();

    });

    $("#registrar_persona").click(function()
    {
    
        if($("input[name='sexo']").not(':checked'))
        {
            $("span#sexo2").attr("class","glyphicon glyphicon-ok-sign hidden");
            $("#sexo").attr("style","border:2px solid red;");
        }

    });               
             
    $("#nombre, #apellido").keypress(function (key) 
    {
        if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
            && (key.charCode < 65 || key.charCode > 90) //letras minusculas
            && (key.charCode != 45) //retroceso
            && (key.charCode != 241) //ñ
            && (key.charCode != 209) //Ñ
            && (key.charCode != 32) //espacio
            && (key.charCode != 225) //á
            && (key.charCode != 233) //é
            && (key.charCode != 237) //í
            && (key.charCode != 243) //ó
            && (key.charCode != 250) //ú
            && (key.charCode != 193) //Á
            && (key.charCode != 201) //É
            && (key.charCode != 205) //Í
            && (key.charCode != 211) //Ó
            && (key.charCode != 218) //Ú
            )
            return false;
    });

});    