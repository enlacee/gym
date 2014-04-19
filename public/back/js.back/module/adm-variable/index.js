/**
 * Lista de variables
 * @author Anb
 */
jQuery("#list").jqGrid({
   	url:'/adm_variable/jqlistar?q=2',
	datatype: "json",
   	colNames:['id','Nombre', 'Tipo variable', 'Patro a validar','Fecha registro'],
   	colModel:[
   		{name:'id_variable',index:'id_variable', width:55},
   		{name:'nombre',index:'nombre', width:150, editable:true},
   		{name:'tipo_variable',index:'tipo_variable', width:100},
                {name:'patron_a_validar',index:'patron_a_validar', width:100},                
   		{name:'fecha_registro',index:'fecha_registro', width:130, align:"right"}
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager',
   	sortname: 'id_variable',
    viewrecords: true,
    sortorder: "desc",
    editurl:'/adm_variable/jqeditar'
    /*caption:"JSON Example"*/
});
//jQuery("#list").jqGrid('navGrid','#pager',{edit:true,add:false,del:false});
//add delete
$("#list").navGrid('#pager',
        {edit:true,add:false,del:true,search:true},{}, {},
        {width:500, url:'/adm_variable/jqeditar',
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
                    alert("No se puede eliminar, La variable esta siendo usada por uno o varios cuadros.");
                    return ['False',''];
                }
                
            }
        });

//$("#list47").jqGrid('setGridWidth', 250);
fixGridSize($("#list"));