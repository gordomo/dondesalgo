<br>
          

 
            <form  method="post" id="form_perfil" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12" action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">
                
                <div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
<?php                  
      if(isset($mensaje)) 
      {   
        echo $mensaje;          
      }
?>                     
                </div>
                    
                <div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4"> 
                    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                    
                    <div  class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="foto_perfil" class="col-xs-12 col-sm-12 col-md-12 col-lg-12  img-circle" id="div_perfil" align="center" data-container="body" data-toggle="tooltip" data-placement="right" title="Agrega una foto de perfil aqui.">                 

                                <span class="glyphicon glyphicon-plus" aria-hidden="true" id="icono_perfil" ></span>
                                <input type="file" id="foto_perfil" name="foto_perfil" style="display:none;">

                        </label>
                        <label for="foto_perfil" id="foto_perfil-error"  class="error" style="display: none;"></label>
                    </div>

                    <div  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>

                </div>     

                <div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>

                <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="crear_perfil" name="crear_perfil" value="Submit">crear</button>
                    <input type="reset" class="btn resetiar" value="Reset" >   
                </div>       

            </form>






             
                      
     