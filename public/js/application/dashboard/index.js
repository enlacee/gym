
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
    colNames:['id','name', 'Tipo variable', 'Patro a validar','Fecha registro'],
    colModel:[
        {name:'id',index:'id', width:55},
        {name:'name',index:'name', width:150, editable:true},
        {name:'tipo_variable',index:'tipo_variable', width:100},
        {name:'patron_a_validar',index:'patron_a_validar', width:100},                
        {name:'fecha_registro',index:'fecha_registro', width:130, align:"right"}
    ],
    rowNum:10,
    rowList:[10,20,30],
    pager: pager_selector,
    sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    editurl:'/adm_variable/jqeditar',
    caption: "Manipulating Array Data",
    loadComplete: function() {
    var table = this;
    setTimeout(function() {
        styleCheckbox(table);
        updateActionIcons(table);
        updatePagerIcons(table);
        enableTooltips(table);
    }, 0);
},
});


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
$('#celular').mask('999-999-9?99');


// validation
$(function(){
$('#formSocio').validate({
	errorElement: 'div',
	errorClass: 'help-block',
	focusInvalid: false,
    /*rules: {
        title: {required : true, minlength: 3, maxlength: 50}
      },*/
	invalidHandler: function (event, validator) { //display error alert on form submit   
		$('.alert-danger', $('.login-form')).show();
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
		console.log("submit");
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                $('#answers').html(response);
            }            
        });
	},
	invalidHandler: function (form) {

	}   
});

});


