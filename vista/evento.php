<br>

<?php
    if(isset($_SESSION['boliche']) || isset($_SESSION['organizador']))
    {
      
?>           
 
            <form  method="post" id="form_evento" class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12" action="<?php echo htmlspecialchars('index.php');?>" enctype="multipart/form-data">
                
                <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
<?php                  
      if(isset($mensaje)) 
      {   
        echo $mensaje;          
      }
?>                     
                </div>
                    
                <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">


                        <div  class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="text-align: center;">
                            <p><b><?=$_SESSION['nombre'];?></b></p>    
                        </div>
 <?php
        if($fotoPerfil->getPerfil() == 'nada')
        { 
 ?>                  
                        <div  class="form-group col-xs-12 col-sm-12 col-md-2 col-lg-2 sin-padding">
                            <label for="perfil" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="div_perfil2" align="center" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Agrega una foto de perfil aqui.">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true" id="icono_perfil2" ></span>
                                    <input type="file" id="perfil" name="perfil" style="display:none;">
                            </label>
                            <label for="perfil" id="perfil-error"  class="error" style="display: none;"></label>
                        </div>    
<?php
        }
        else
        {    
?>  
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
<?php
        }
?>                      
                        <div  class="col-xs-12 col-sm-12 col-md-5 col-lg-5"></div>
                        
                    </div>

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                <label for="titulo_evento" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Titulo:</label>
               
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" id="campo" >
                                    <input class="form-control" id="titulo_evento" name="titulo_evento"  placeholder="¿ Como se llama el evento ?" maxlength="40" >
                                </div>
                            </div>
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="titulo_evento2"></span></div>

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>

<?php
        if(isset($_SESSION['organizador']))
        {    
?>
                     <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                <label for="tipo_evento" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Tipo evento:</label>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="text-align: center;">
                                      <select name='tipo_evento' id='tipo_evento' class="form-control" >
                                        <option value='' >Ninguno</option>
                                        <option value='2'>cachengue</option>
                                        <option value='4'>Previa</option>
                                        <option value='5'>electronica</option>
                                      </select>
                                </div>
                            </div>   
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="tipo_evento2"></span></div>   

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>

<?php
        }
?>                    

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                 <label for="fecha_evento" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Fecha:</label>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="text-align: center;">
                                      <input class="form-control" id="fecha_evento" name="fecha_evento" placeholder="¿Cuando se hara el evento?" style="cursor: pointer;" >
                                      <span class="glyphicon glyphicon-remove-circle" id="reset-fecha-evento"  style="color:red; cursor: pointer;"></span>
                                </div>
                            </div>   
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="fecha_evento2"></span></div>   

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                 <label for="hora_inicio" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Hora inicio:</label>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="text-align: center;">
                                      <input class="form-control" id="hora_inicio" name="hora_inicio" placeholder="¿ A que hora empieza ?" style="cursor: pointer;" >
                                </div>
                            </div>   
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="hora_inicio2"></span></div>   

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                 <label for="hora_fin" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Hora fin:</label>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="text-align: center;">
                                      <input class="form-control" id="hora_fin" name="hora_fin" placeholder="¿ A que hora termina ?" style="cursor: pointer;" >
                                </div>
                            </div>   
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="hora_fin2"></span></div>   

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>
<?php
        if(isset($_SESSION['organizador']))
        {    
?>                    

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                <label for="direccion" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">Direccion:</label>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="text-align: center;">
                                      <input class="form-control" id="direccion" name="direccion" placeholder="¿ Donde queda ?"  >
                                </div>
                            </div>   
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="direccion2"></span></div>   

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>
<?php
        }

?>                    

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" style="margin-bottom: 35px;">

                        <div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
                        <div  class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 sin-padding">   
                            <label for="imagen_evento" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" id="div_portada" align="center" data-container="body" data-toggle="tooltip" data-placement="right" title="Agrega una foto de portada del evento aqui.">
                                      <span class="glyphicon glyphicon-plus" aria-hidden="true" id="icono_portada" ></span>
                                      <input type="file" id="imagen_evento" name="imagen_evento" style="display:none;">
                            </label>
                            <label for="imagen_evento" id="imagen_evento-error"  class="error" style="display: none;"></label>
                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>

                    </div>

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding"  style="margin-bottom: 20px;">

                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                        <div  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            
                            <div  class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10 sin-padding">
                                <label for="descripcion_evento" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3"></label>
               
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" id="campo" >
                                    <textarea class="form-control" id="descripcion_evento" name="descripcion_evento"  placeholder="Escribe una breve descripcion del evento" ></textarea>
                                </div>
                            </div>
                            <div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-ok-sign hidden" id="descripcion_evento2"></span></div>

                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                    </div>

                </div>     

                <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>

                <div  class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding" align="center">
                    <button class="btn btn-primary" id="crear_evento" name="crear_evento" value="Submit">crear evento</button>
                    <input type="reset" class="btn resetiar" value="Reset" />   
                </div>       

            </form>


                            
 <?php
    }
    else
    {

         echo 'Solo pueden ver el perfil los lugares<br><br>';
    }
?>



             
                      
     