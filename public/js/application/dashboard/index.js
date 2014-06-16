
// modal option manager
$('#myModal').modal({
  keyboard: false,backdrop : 'static',show:false
});

// control tab
$('#click').click(function(){
    $('#myTab li:eq(1) a').tab('show');
});


var grid_selector = "#grid-table";
var pager_selector = "#grid-pager";

jQuery(grid_selector).jqGrid({
    url:'socio/listGrid',
    datatype: "json",
    colNames:['id','nombre', 'apellido', 'sexo','celular','mail','direccion','nota','Fecha registro',
    'uno'],
    colModel:[
        {name:'id',index:'id', width:55, search:false},
        {name:'first_name',index:'first_name', width:150, editable:true},
        {name:'last_name',index:'last_name', width:100, editable:true},
        {name:'sexo',index:'sexo', width:100},
        {name:'celular',index:'celular', width:100, hidden:true},
        {name:'email',index:'email', width:100, hidden:true},
        {name:'direccion',index:'direccion', width:100, hidden:true},
        {name:'observacion',index:'observacion', width:100, hidden:true},
        {name:'fecha_registro',index:'fecha_registro', width:130, align:"right"},
        
        //socio suscrito        
        {name:'id_empresa_producto',index:'id_empresa_producto', width:130, align:"right", hidden:true},
    ],
    rowNum:10,
    rowList:[10,20,30],
    pager: pager_selector,
    sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    editurl:'/adm_variable/jqeditar',
    //caption: "Manipulating Array Data",
    loadComplete: function() {
	    var table = this;
	    setTimeout(function() {
	        styleCheckbox(table);
	        updateActionIcons(table);
	        updatePagerIcons(table);
	        enableTooltips(table);
	    }, 0);
	},
	ondblClickRow: function(id) {
		//alert("You double click row with id: "+id);
		var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
		console.log(gsr)
		rowData = $(this).jqGrid("getRowData", id);
		console.log('rowData',rowData);
		if(gsr){
			$(this).jqGrid('GridToForm',gsr,"#formEditSocio");
			$('#myTab li:eq(1) a').tab('show');
		} else {
			alert("Please select Row")
		}
	},	
});

// -- nav
jQuery(grid_selector).jqGrid('navGrid', pager_selector,
    {//navbar options
        edit: true,
        editicon: 'icon-pencil blue',
        add: false,
        addicon: 'icon-plus-sign purple',
        del: true,
        delicon: 'icon-trash red',
        search: true,
        searchicon: 'icon-search orange',
        refresh: true,
        refreshicon: 'icon-refresh green',
        view: false,
        viewicon: 'icon-zoom-in grey',
    },
    {
        //edit record form
        //closeAfterEdit: true,
        recreateForm: true,
        beforeShowForm: function(e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_edit_form(form);
        }
    },
	{
	    //new record form
	    closeAfterAdd: true,
	    recreateForm: true,
	    viewPagerButtons: false,
	    beforeShowForm: function(e) {
	        var form = $(e[0]);
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_edit_form(form);
	    }
	},
	{
	    //delete record form
	    recreateForm: true,
	    beforeShowForm: function(e) {
	        var form = $(e[0]);
	        if (form.data('styled'))
	            return false;

	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_delete_form(form);

	        form.data('styled', true);
	    },
	    onClick: function(e) {
	        alert(1);
	    }
	},
	{
	    //search form
	    recreateForm: true,
	    afterShowSearch: function(e) {
	        var form = $(e[0]);
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	        style_search_form(form);
	    },
	    afterRedraw: function() {
	        style_search_filters($(this));
	    }
	    ,
	    multipleSearch: false,
	    /**
	     multipleGroup:true,
	     showQuery: true
	     */
	},
    {
        //view record form
        recreateForm: true,
        beforeShowForm: function(e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
        }
    }
);




// toogle button
$("#linkMoreSocio").click(function(event){
	event.preventDefault();
	//console.log($(this).html());
	if ($(this).html() == '[+ mas]') {
		$(this).html('[- menos]');
	} else {
		$(this).html('[+ mas]');
	}
});

// mask formulario
$.mask.definitions['~']='[+-]';
$('#addSocio_celular').mask('999-999-9?99');
$('#celular').mask('999-999-9?99');


// validation
$(function(){
$('#formAddSocio').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
/*rules: {
    title: {required : true, minlength: 3, maxlength: 50}
  },*/
    invalidHandler: function (event, validator) { //display error alert on form submit
        //$('.alert-danger', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
            if(element.is(':checkbox') || element.is(':radio')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else {
                error.insertAfter(element); //error.insertAfter(element.parent());
            }
    },
    submitHandler: function (form) {            
        //console.log("form",form.children);
        console.log("submit");
        var obj = $(this);

        //obj[0].currentForm[10].text("enviandooo");            
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            beforeSend: function() {
                //form.children[0].setAttribute("disabled","disabled");
                obj[0].currentForm[10].innerHTML ="Enviando...";
            },
            success: function(response) {
                //$('#answers').html(response);                    
                if (response == 1) {
                    form.children[0].removeAttribute('disabled');
                    $('#myModal').modal('hide');
                    form.reset();
                    obj[0].currentForm[10].innerHTML ="Enviar";
                    
                    $(grid_selector).trigger("reloadGrid"); 
                    bootbox.alert("Se Guardo correctamente!", function() {
                        //Example.show("Hello world callback");
                    });
                } else {
                    alert("error request");
                }
            }
        });
    },
    invalidHandler: function (form) {

    }
});

});


