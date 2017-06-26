<br>
  <form id="form_login"  method="post" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12" action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">

    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3">     
<?php                  
      if(isset($mensaje_login)) 
      {   
        echo $mensaje_login;          
      }
      else
      {        
        $mensaje_login='';   
      } 
?> 
    </div>

    <div  class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

      
        <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
            <label for="email_login" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Email:</label>
            <!-- id=campo se creo para comparar el div del input con el label del mensaje error em validate.js-->
             <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="campo" >
                <input class="form-control text" id="email" name="email"  placeholder="@" maxlength="60" value="<?php if(isset($email)){ echo $email;} ;?>">
             </div>
        </div>
        <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="email2"></span></div>

      
        <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
            <label for="clave_login" class="control-label col-xs-12 col-sm-12 col-md-4 col-lg-4">Clave:</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                  <input class="form-control" type="password" id="clave" name="clave"  placeholder="clave" maxlength="60"  value="">
            </div>
        </div> 
        <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2 "><span class="glyphicon glyphicon-ok-sign hidden" id="clave2"></span></div>  
                   
        <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
            <button class="btn btn-primary" id="login_usuario" name="login_usuario" value="Submit">Enviar</button>
            <input type="reset" class="btn resetiar" id="" value="Reset" />  
        </div>      

    </div>

    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>  

</form>