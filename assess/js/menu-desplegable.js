 //visual movil: si se presiona un boton del menu desplegable oculta el menu y muestra solo el nombre del btn presionado

 $(document).ready(function()
{

    $("#boton_desp1, #boton_desp2, #boton_desp3").click(function()
    {

        $("#menu_desplegable").attr("class","collapse navbar-collapse");
        $("#menu_desplegable").attr("aria-expanded","false");
        $("#nav_press").attr("class","nav col-xs-10  hidden-lg hidden-md hidden-sm show");

    });

    $("#boton_desp1").click(function()
    {          
        $("#boton_press1").attr("class","btn_despleg show");
    });

    $("#boton_desp2").click(function()
    {   
        $("#boton_press2").attr("class","btn_despleg show");
    });

    $("#boton_desp3").click(function()
    {   
        $("#boton_press3").attr("class","btn_despleg show");
    });


    $(".navbar-toggle").click(function()
    {
        $("#nav_press").attr("class","nav col-xs-10  hidden-lg hidden-md hidden-sm hidden");
        $(".btn_despleg").attr("class","btn_despleg hidden");

    });

});        