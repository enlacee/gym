$(function () {
    
    var $variable = $('#variable');
    $variable.autocomplete({
        source: function (request, response) {
           $.ajax({
               url: '/adm_variable/jsonlistavariable/',
               type: 'post',
               dataType: 'json',
               data: request,
               success: function (data) {
                   //console.log('data',data);
                   response($.map(data, function (value, key) { 
                        return {
                            label: value,
                            value: value+':'+key,
                            //value: key
                        };
                   }));
               }
           });
        },
        minLength: 2
    });
    
    $('#add').click(function() { 
        //var patron = /^([a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ 0-9]+)(:)(\d+)$/;stión
        var patron = /^([a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ 0-9 \/ \( \) -_,\s]+)(\|)([A-Z]+)(:)(\d+)$/;
        if (patron.test($variable.val())) {            
            var $input = '<input type="text" name="variableData[]" value="'+$variable.val()+'" readonly class="form-control input-sm"/>';
            var s = getTipodeVariable($variable.val());            
            if(getTipodeVariable($variable.val()) == 'LISTA') {
                var checkbox = 'Multiple : <input type="checkbox" name="variableDataListaMultiple" onclick="esListaMultiple(this)" value = "1" />';
                $input += checkbox;
            }
            $("#lista-variables").append('<p>'+$input+'</p>');
            $variable.val('')
                    .focus();
        } else {
            alert("Expresion no es adecuado corregir.");
        }

    });
});


// ----------------------- function de ayuda
function getTipodeVariable(str) {
    //var str = "sexo|LISTA:5";
    var res = str.split(":",1);    
    var string_tvariable = res[0];
    var arreglo_tvariable = string_tvariable.split("|");    
    return arreglo_tvariable[1];
}

/**
 * Vodid ejecuta proceso de : marcar si es LISTA SIMPLE O MULTIPLE.
 * @param {type} dom
 * @returns {String|Boolean}
 * Patron definido :  sexo|LISTA|1:4  - sexo|LISTA:4
 *  
 * sexo = Nombre de la variable
 * |LISTA = tipo de variable
 * |1 = tipo de lista seleccion Simple o Multiple.
 * :4 = id_variable (codigo q identifica a la variable)
 */
function esListaMultiple(dom) {    
    var response = false;
    var inputConstruido = dom.previousSibling.previousSibling;    
    
    var valorInput = inputConstruido.value;
    //console.log('valorInput',valorInput);
    
    if(dom.checked == 1) {
        var arreglo = valorInput.split(":");
        var dataString = arreglo[0];
        var dataCodigo = arreglo[1];        
        var stringAgregado = '|1';
        
        response = dataString + stringAgregado + ':'+dataCodigo;
        inputConstruido.value = response;    
        
    } else {
        var arreglo = valorInput.split(":");
        var dataString = arreglo[0];
        var dataCodigo = arreglo[1];        
        var dataQuitar = valorInput.substring(0,(dataString.length-2));
        
        response = dataQuitar + ':'+dataCodigo;
        inputConstruido.value = response;        
    }
    
    return response;
}
