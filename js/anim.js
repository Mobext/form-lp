$(document).ready(function(){
    

    $( ".btn-terminos" ).click(function() {
        $(".cont-legales").animate({"top":"0%","opacity":"1"});
    });

    $( ".close-legal" ).click(function() {
        $(".cont-legales").animate({"top":"100%","opacity":"0"});
    });
    
    
    
    $( ".ancla-localidad" ).click(function() {
        $(".cont-localidades1").animate({"top":"0%","opacity":"1"});
    });
    
    $( ".close-localidades1" ).click(function() {
        $(".cont-localidades1").animate({"top":"100%","opacity":"0"});
    });
    
    
    
    $( ".lista-consecionarios li" ).click(function() {
        $(".cont-localidades1").animate({"top":"100%","opacity":"0"});
        $(".cont-localidades2").animate({"top":"100%","opacity":"0"});
        var loc = $(this).find(".valor").html();
        $("#valor-localidad").val(loc)
    });
    
    
    
    
    $( ".localizacion" ).click(function() {
        $(".cont-localidades2").animate({"top":"0%","opacity":"1"});
    });
    
    $( ".close-localidades2" ).click(function() {
        $(".cont-localidades2").animate({"top":"100%","opacity":"0"});
    });
    
    
    
    $( ".sino li" ).click(function() {
        $( ".sino li" ).removeClass("active");
        $(this).addClass("active");
    });
    
    
    /*
    $( ".btn-continuar" ).click(function() {
        $(".form-paso1").fadeOut(200);
        $(".form-paso2").delay(300).fadeIn(500);
        $("#envia1").fadeIn(400);
    });
    */
    
    
    
    $( ".trans-si" ).click(function() {
        $("#envia1").hide(0);
        $(".btn-continuar").show(0);
    });
    
    $( ".trans-no" ).click(function() {
        $("#envia1").show(0);
        $(".btn-continuar").hide(0);
    });

    
    
    $( ".form-paso2 .flecha-atras" ).click(function() {
        $(".form-paso1").delay(300).fadeIn(500);
        $(".form-paso2").fadeOut(200);
        $("#envia1").hide(0);
        $(".btn-continuar").show(0);
        //$('.textarea-field').val("Ingrese su descripción de la transformación aquí...");
        
        
        $(".barra-transformaciones").fadeOut(300);

        $(".el-modelo .modelo").removeClass("achica-auto");

        
    });
    
    
    
    
    
    

});