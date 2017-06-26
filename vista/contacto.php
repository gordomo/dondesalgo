<br>
  <form id="form_contacto"  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12" action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">

    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3">     
<?php                  
     $msje_exito_contacto='';
?> 
    </div>

    <div  class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

      
        <div class="form-group col-xs-11 col-sm-11 col-md-10 col-lg-10 sin-padding" >
            <label for="nombre" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Nombre:</label>
            <!-- id=campo se creo para comparar el div del input con el label del mensaje error em validate.js-->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                <input class="form-control" id="nombre" name="nombre"  placeholder="Nombre" maxlength="40">
            </div>
        </div>
        <div  class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><span class="glyphicon glyphicon-ok-sign hidden" id="nombre2"></span></div>

        <div class="form-group col-xs-11 col-sm-11 col-md-10 col-lg-10 sin-padding" >
            <label for="apellido" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Apellido:</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <input class="form-control text" id="apellido" name="apellido"  placeholder="Apellido"  >
            </div>
        </div>
        <div  class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><span class="glyphicon glyphicon-ok-sign hidden" id="apellido2"></span></div>

        <div class="form-group col-xs-11 col-sm-11 col-md-10 col-lg-10 sin-padding" >
            <label for="telefono" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Telefono:</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                <input class="form-control" id="telefono" type="number" name="telefono" placeholder="Telefono"  maxlength="40">
            </div>
        </div>
        <div  class="col-xs-1 col-sm-1 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="telefono2"></span></div>

        <div class="form-group col-xs-11 col-sm-11 col-md-10 col-lg-10 sin-padding" >
            <label  for="email" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4" >Email:</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >    
                <input class="form-control" id="email" name="email" placeholder="@">     
            </div>        
        </div>
        <div  class="col-xs-1 col-sm-1 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="mail2"></span></div>

        <div class="form-group col-xs-11 col-sm-11 col-md-10 col-lg-10 sin-padding" >
            <label for="mensaje" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Mensaje:</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Escribe tu mensaje" ></textarea>
            </div>
        </div>
        <div  class="col-xs-1 col-sm-1 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="mensaje2"></span></div>

        <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
            <button class="btn btn-primary" id="contacto_usuario" name="contacto_usuario" value="Submit">Enviar</button>
            <input type="reset" class="btn resetiar" value="Reset" />  
        </div>      

    </div>

    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>  

</form>
