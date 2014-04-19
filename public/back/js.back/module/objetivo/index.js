/**
 * Lista de variables
 * @author Anb
 */
var $id = $('#id_objetivo').val();
jQuery("#list").jqGrid({
   	url:'/cuadro/jqlistar?id_objetivo=' + $id,
	datatype: "json",
   	colNames:['id','Titulo', 'Fecha registro'],
   	colModel:[
   		{name:'id_cuadro',index:'id_cuadro', width:55},
   		{name:'titulo',index:'titulo', width:400, editable:true},   		
   		{name:'fecha_registro',index:'fecha_registro', width:90, align:"right"}
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager',
   	sortname: 'id_cuadro',
    viewrecords: true,
    sortorder: "desc",
    editurl:"/cuadro/jqeditar",
    /*caption:"JSON Example"*/
});
//jQuery("#list").jqGrid('navGrid','#pager',{edit:true,add:false,del:false});
//add delete
$("#list").navGrid('#pager',
        {edit:true,add:false,del:true,search:true},{}, {},
        {width:500, url:'/cuadro/jqeditar',
            reloadAfterSubmit:true,
             onclickSubmit: function(param) {
                var sr = jQuery('#list').getGridParam('selrow');
                return {idUser:sr};
            },
            afterSubmit: function(reponse, data) {
                var json = reponse.responseJSON; console.log('json',json);
                if(json == true) {
                    //$("#list").trigger('reloadGrid');
                    return ['true',""];
                } else {
                    alert("No se puede eliminar, EL cuadro ya fue asignado a un usuario.");
                    return ['False',''];
                }
                
            }
        });
//$("#list47").jqGrid('setGridWidth', 250);
fixGridSize($("#list"));