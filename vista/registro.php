<br>
  

    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3">     
<?php                  
      if(isset($mensaje)) 
      {   
        echo $mensaje;          
      }
?> 
    </div>

    <div  class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

        <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 50px;">
            <label for="tipo" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Tipo:</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                  <label class="radio-inline"><input type="radio" name="tipo" id="usuario" value="usuario" checked="checked">Personas</label>
                  <label class="radio-inline"><input type="radio" name="tipo" id="lugar" value="codigo">Lugares</label>
            </div>    
        </div>

        <div class="usuario formulario">

          <form id="form_registro_personas"  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12 " action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="nombre" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Nombre:</label>
                <!-- id=campo se creo para comparar el div del input con el label del mensaje error em validate.js-->
                 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                    <input class="form-control" id="nombre" name="nombre"  placeholder="Nombre" maxlength="40" >
                 </div>
            </div>
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="nombre2"></span></div>

          
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="apellido" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Apellido:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input class="form-control" id="apellido" name="apellido"  placeholder="Apellido" maxlength="40"  >
                </div>
            </div> 
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2 "><span class="glyphicon glyphicon-ok-sign hidden" id="apellido2"></span></div>  
          
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label  for="mail" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4" >Email:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >    
                      <input class="form-control" id="email" name="email" placeholder="@" maxlength="60" >     
                </div>
            </div>    
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="email2"></span></div>            
        
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="apellido" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Clave:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input class="form-control" type="password" id="clave" name="clave" maxlength="30"  placeholder="clave">
                </div>
            </div> 
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="clave2"></span></div>  
       
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="telefono" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Cumpleaños:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="text-align: center;">
                      <input class="form-control" id="fecha" name="fecha" placeholder="fecha" readonly style="cursor: pointer;" >
                      <span class="glyphicon glyphicon-remove-circle" id="reset-fecha"  style="color:red; cursor: pointer;"></span>
                </div>
            </div>   
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="fecha2"></span></div>   

            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="sexo" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">sexo:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="sexo">
                      <label class="radio-inline"><input type="radio" name="sexo" value="m">Hombre</label>
                      <label class="radio-inline"><input type="radio" name="sexo" value="f">Mujer</label>
                </div>
                <div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
                <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                  <label for="sexo" class="error" style="display: none;"></label>
                </div>
            </div>   
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="sexo2"></span></div>   
                       
            <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
                <button class="btn btn-primary" id="registrar_persona" name="registrar_persona" value="Submit">Enviar</button>
                <input type="reset" class="btn resetiar" value="Reset" />  
            </div>
           </form>
        </div>

        <div class="codigo formulario" style="display: none;">

           <form id="form_registro_codigo"  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12 " action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">
                
            <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                <label for="apellido" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Codigo:</label>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                      <input class="form-control" id="codigo" name="codigo"  placeholder="numero" maxlength="40"  > 
                </div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
            </div>
             <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 40px;">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                      <p class="sin-padding" style="color:#3074AE;"><b>¿Queres obtener tu codigo?</b>
                      <a href="#" class="btn btn-success" id="boton6" style="margin-left: 10px; margin-top: 5px;">Contactar</a></p>       
                </div>
            </div>

            <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
                <button class="btn btn-primary" id="validar_codigo" name="validar_codigo" value="Submit">Enviar</button>
                <input type="reset" class="btn resetiar" value="Reset" >  
            </div>
           </form>
        </div>

        <div class="boliche formulario" style="display: none;">

          <form id="form_registro_boliche"  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12 " action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">

          <input type="hidden" name="codigo" value="<?=$codigo;?>"> 


          <p align="center" style="margin-bottom: 20px; font-size: 18px;"> <b>Registro boliches</b></p>
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="nombre" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Nombre:</label>
               
                 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                    <input class="form-control" id="nombre" name="nombre"  placeholder="Nombre" maxlength="40" >
                 </div>
            </div>
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="nombre2"></span></div>

            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="direccion" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Direccion:</label>
               
                 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                    <input class="form-control" id="direccion" name="direccion"  placeholder="Direccion" maxlength="40" >
                 </div>
            </div>
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="direccion2"></span></div>

             <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="telefono" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Telefono:</label>
               
                 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                    <input class="form-control" id="telefono" name="telefono"  placeholder="Telefono" maxlength="40" >
                 </div>
            </div>
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="telefono2"></span></div>
          
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label  for="mail" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4" >Email:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >    
                      <input class="form-control" id="email" name="email" placeholder="@" maxlength="60" >     
                </div>
            </div>    
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="email2"></span></div>            
        
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="apellido" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Clave:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input class="form-control" type="password" id="clave" name="clave" maxlength="30"  placeholder="clave">
                </div>
            </div> 
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="clave2"></span></div>  
                       
            <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
                <button class="btn btn-primary" id="registrar_boliche" name="registrar_boliche" value="Submit">Enviar</button>
                <input type="reset" class="btn resetiar" value="Reset" />  
            </div>

            </form>
        </div>
        
        <div class="organizador formulario" style="display: none;">

          <form id="form_registro_organizador"  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12 " action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">

          <input type="hidden" name="codigo" value="<?=$codigo;?>">

            <p align="center" style="margin-bottom: 20px; font-size: 18px;"> <b>Registro Organizador</b></p>
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="nombre" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Nombre:</label>
               
                 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                    <input class="form-control" id="nombre" name="nombre"  placeholder="Nombre" maxlength="40" >
                 </div>
            </div>
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="nombre2"></span></div>
          
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label  for="mail" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4" >Email:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >    
                      <input class="form-control" id="email" name="email" placeholder="@" maxlength="60" >     
                </div>
            </div>    
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="email2"></span></div>            
        
            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                <label for="apellido" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Clave:</label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input class="form-control" type="password" id="clave" name="clave" maxlength="30"  placeholder="clave">
                </div>
            </div> 
            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="clave2"></span></div>  
                       
            <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
                <button class="btn btn-primary" id="registrar_organizador" name="registrar_organizador" value="Submit">Enviar</button>
                <input type="reset" class="btn resetiar" value="Reset" />  
            </div>
          </form>
        </div>  
    </div>

    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>  


<!--
<script>

$('#registrar_usuario').on("click", function(){
  var nombre = $('#nombre').val();
  var apellido = $('#apellido').val();
  var email = $('#email').val();
  var clave = $('#clave').val();
  var fecha = $('#fecha').val();
  var sexo = $('#sexo').val();

  $.ajax({
          url: "index.php",
          data: {action:"registrar_usuario",
                 nombre:nombre,
                 apellido: apellido,
                 email: email,
                 clave: clave,
                 fecha: fecha,
                 sexo: sexo },
          dataType:"json",
          type: "POST",
          success: function(respuesta){
            if(respuesta.status == "ok")
            {
                alert(respuesta);
            }
            else
            {
               alert("la puta madre");
            }
          },
          error: function(e){
            console.log(e);
            alert("error");
          }
  });
});
</script>
-->