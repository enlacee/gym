// interaccion con el formulario


$( document ).ready(function() {
    $(".bg-info").hide();
    
    var lastID;
    
    $("#tipo_variable").change(function () {
        
        $( "#tipo_variable option:selected" ).each(function() {
            
            var idSeleccion = $( this ).val();
            
            $("#"+idSeleccion).show();
            //--            
            var $dataPatron = $("#"+idSeleccion).attr('data-patron-validar');
            
            if ( typeof $dataPatron === "undefined" || $dataPatron == "") {
                $("#patron").hide();
            } else {
                $("#patron").show();
                $("#patron_a_validar").attr('placeholder',$dataPatron);
            }
            //--
            if (idSeleccion != lastID) {
                
                $("#"+lastID).hide();
            }
            
            lastID = idSeleccion;
        });
        
    }).change();
  
});



