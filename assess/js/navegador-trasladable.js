$(document).ready(function()
{
        
        //menu trasladable al hacer scroll

        var altura = $("#nav_principal").offset().top;

        $(window).resize(function()
        {
            var ancho= $("#footer").width();

            var alto_nav= $("#nav_principal").height();

            $("#nav_principal").css({'width' : ancho});

            $("#espacio_nav").css({'height' : alto_nav});  
        }); 

                     
        $(window).scroll(function()
        {
            var ancho= $("#footer").width();

            var alto_nav= $("#nav_principal").height();

            if($(window).scrollTop() >= altura)
            {
                $("#espacio_nav").show();

                $("#espacio_nav").css({'height' : alto_nav});

                $("#nav_principal").addClass('navegador-fixed');

                $("#nav_principal").css({'width' : ancho});

                                   
            }
            else
            {
                                         
                $("#nav_principal").removeClass('navegador-fixed');

                $("#espacio_nav").hide();

                $("#nav_principal").css({'width' : '100%'});
                                   
            }
                             
        });


});    