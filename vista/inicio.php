<!DOCTYPE html>
<html lang="es">
<head>
   <title>Sistema boliches</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="assess/css/bootstrap.min.css">
    <link rel="stylesheet" href="assess/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assess/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assess/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assess/css/jquery-confirm.min.css">
    <link rel="stylesheet" href="assess/css/jquery.timepicker.css">
    <link rel="stylesheet" href="assess/css/font-awesome.min.css">
    <link rel="stylesheet" href="assess/css/estilo.css">
    <script src="assess/js/jquery-latest.js"></script>
    <script src="assess/js/bootstrap.min.js"></script>
    <script src="assess/js/bootstrap-select.min.js"></script>
    <script src="assess/js/jquery-ui.min.js"></script>
    <script src="assess/js/jquery-confirm.min.js"></script>
    <script src="assess/js/jquery.timepicker.min.js"></script>
    <script src="assess/js/cycle.js"></script>
    <script src="assess/js/jquery.validate.js"></script>
    <script src="assess/js/app.js"></script>
    <script src="assess/js/validar-forms.js"></script>
    <script src="assess/js/menu-desplegable.js"></script>
    <script src="assess/js/navegador-trasladable.js"></script>
    <script src="assess/js/galeria-fotos.js"></script>
    <script src="assess/js/jquery.popmenu.min.js"></script>
    <script>
            $(document).ready(function()
            {
                $('[data-toggle="tooltip"]').tooltip(); 

                $('#hora_inicio, #hora_fin').timepicker({ 'step': 15, 'timeFormat': 'H:i' });


                $(window).load(function()
                {
                    $('#menu_user').show();

                    $('#menu_user').popmenu(
                    {
                            'controller': true,       // use control button or not
                            'width': '150px',         // width of menu
                            'background': '#1D1D1D',  // background color of menu
                            'focusColor': '#3C3C3C',  // hover color of menu's buttons
                            'borderRadius': '10px',   // radian of angles, '0' for right angle
                            'top': '0',              // pixels that move up
                            'left': '0',              // pixels that move left
                            'iconSize': '60px'       // size of menu's buttons
                    });
                 
                });
         
            });
    </script>

    <?php include("assess/js/accion-botones.php");?>
    
</head>
<body>

    <div class="container hidden-xs" id="header_margen"></div>
   
    <div class="container" id="titulo">
        <header>
            <h2>Donde Salgo</h2>
        </header>
    </div>
    <div class="container sin-padding" id="navegador">

        <?php include('navegador.php');?> 

    </div>

    <div class="container" id="secciones">     
        <section class="main row hidden" id="menu1">

          <?php include('boliches.php');?>

        </section>

        <section class="main row hidden" id="menu2">
          
          <?php include('previas.php');?> 
      
        </section>
        <section class="main row hidden" id="menu3">
        
          <?php include('ubicacion.php');?>

        </section>
        <section class="main row hidden" id="menu4">
        
          <?php require('registro.php');?>
           
        </section>
        <section class="main row hidden" id="menu5">
        
          <?php require('login.php');?>
           
        </section>
        <section class="main row hidden" id="menu6">
        
          <?php require('contacto.php');?>
           
        </section>
        <section class="main row hidden" id="menu7">
        
          <?php include('evento.php');?>
           
        </section>
        <section class="main row hidden" id="menu8">
        
          <?php include('perfil.php');?>
           
        </section>                
    </div>    
        
    <div class="container" >
     <section class="row" id="footer">
        <footer class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <p>
                Website Design by Matias Vivaldi. Copyright © 2016. All rights reserved.
            </p>
        </footer>
     </section>
    </div>
   
</body>
</html>
