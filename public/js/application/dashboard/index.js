/**
 * @author anbCopitan
 * @company SA
 *
 * Class Socio
 * functiones basicas para gestionar operaciones del socio
 */

// object
var socio = {};
    socio.param = [];
    socio.param.id = '#id';
    socio.param.socioSuscriptorId = '#ac_socios_suscriptores.id';
    socio.param.modalNew = '#myModal';
    socio.param.modalNewButtonMore = '#linkMoreSocio';
    socio.param.tabPrincipal = '#myTab';
    socio.param.gridBody = '#grid-table';
    socio.param.gridPage = '#grid-pager';
    socio.param.formAddSocio = '#formAddSocio';
    socio.param.formEditSocio = '#formEditSocio';
    socio.param.formSuscribirseSocio = '#formSuscribirseSocio';


    socio.param.modalSuscribirse = '#myModalSuscribirse';

// object + class (ref prototype Constructor)
socio.fn = function() {};

socio.fn.prototype.init = function() { //console.log('socio',socio); //console.log('this',this);
    initModalNew();
    initModalSuscribirse();

    /**
    * - Listener iniciar el modal Agregar nuevo socio
    * - formulario desplegable (mas inputs)
    * - formatear campos de telefono. (2)
    */
    function initModalNew () {

        $(socio.param.modalNew).modal({
            keyboard: false, backdrop: 'static', show: false
        });

        // toogle button
        $(socio.param.modalNewButtonMore).click(function(event) {
            event.preventDefault();
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
    };

    /**
    * Listener 
    * Suscribirse ah 1 producto cambiando la interfaz del modal
    * por cada accion (boton).
    */
    function initModalSuscribirse() {
        // basic
        $(socio.param.modalSuscribirse).modal({
            keyboard: false, backdrop: 'static', show: false
        });
        // listener buttons : change data modal = .buttonSuscribirse
        $('.buttonSuscribirse').click(function() {
            var button = $(this);
            var modal = $(socio.param.modalSuscribirse).find(socio.param.formSuscribirseSocio).children();
            var modal_sector_1 = modal.find('div .jumbotron h1');
            var modal_sector_2 = modal.find('input#suscrip_idEmpresaProducto');
            var modal_sector_3 = modal.find('span#suscrip_precio');

            var texto = button.text();
            var nroDia = parseInt(button.attr('data-nrodia'));
            var idEmpresaProducto = parseInt(button.attr('value'));
            var precio = parseFloat(button.attr('data-precio'));
            if (idEmpresaProducto <= 0|| precio<=0) {
                alert("#404 idEmpresaProducto and idPeriodo");
            }

            var subTexto = '<span class="label label-primary"> ';           
            if (nroDia == 1) {
                subTexto += nroDia + ' dia';
            } else if (nroDia > 1) {
                subTexto += nroDia + ' dias';
            } else {
                alert ("#404 definir nroDia");
            }
            subTexto += '</span>';
            
            modal_sector_1.html( texto + subTexto );
            modal_sector_2.val(idEmpresaProducto);
            modal_sector_3.html(precio);

            var idSc = socio.param.socioSuscriptorId.replace('#','');
            var idSocio = parseInt(document.getElementById(idSc).value);

            if (idSocio > 0) {
                $("#suscrip_idSocio").val(idSocio);
            } else {
                alert("seleccione un socio");
            }

            $('#suscrip_idSocio').val();
        });
    }
}

// load jqgrid
socio.fn.prototype.grid = function() {

    jQuery(socio.param.gridBody).jqGrid({
        url:'socio/listGrid',
        datatype: "json",
        colNames:['id','nombre', 'apellido', 'sexo','celular','mail','direccion','nota','Fecha registro',
            'id_empresa_producto'],
        colModel:[
            {name:'ac_socios_suscriptores.id',index:'ac_socios_suscriptores.id', width:55, search:false},
            {name:'first_name',index:'first_name', width:130, editable:true},
            {name:'last_name',index:'last_name', width:130, editable:true},
            {name:'sexo',index:'sexo', width:50},
            {name:'celular',index:'celular', width:100, hidden:true},
            {name:'email',index:'email', width:100, hidden:true},
            {name:'direccion',index:'direccion', width:100, hidden:true},
            {name:'observacion',index:'observacion', width:100, hidden:true},
            {name:'fecha_registro',index:'fecha_registro', width:120, align:"right"},
            //socio suscrito
            {name:'id_empresa_producto',index:'id_empresa_producto', width:130, align:"right", hidden:true}
        ],
        rowNum:10,
        rowList:[10,20,30],
        pager: socio.param.gridPage,
        sortname: 'ac_socios_suscriptores.id',
        viewrecords: true,
        sortorder: "desc",
        editurl:'socio/del',
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
            var gsr = jQuery(socio.param.gridBody).jqGrid('getGridParam','selrow');
            console.log(gsr)
            rowData = $(this).jqGrid("getRowData", id);
            console.log('rowData',rowData);
            if (gsr){
                $(this).jqGrid('GridToForm',gsr,"#formEditSocio");
                $('#myTab li:eq(1) a').tab('show');

                // disabled
                $(socio.param.formEditSocio).children()[0].removeAttribute('disabled');
                //
                gridEditEvent(rowData);
            } else {
                alert("Please select Row")
            }
        }
    });

// -- nav
    jQuery(socio.param.gridBody).jqGrid('navGrid', socio.param.gridPage,
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
            viewicon: 'icon-zoom-in grey'
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
            },
            multipleSearch: false
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

    /**
     *
     * @param objSocio
     * get nodes and operation into direction.
     */
    function gridEditEvent(objSocio) {
        var button = $(socio.param.formEditSocio).children().children('div:first').find('button');
        if (parseInt(objSocio.id_empresa_producto) > 0) {
            button.addClass('disabled'); //console.log('button',button);
        } else {
            button.removeClass('disabled');
        }
    }
};

socio.fn.prototype.validateNewSocio = function() {
    $(socio.param.formAddSocio).validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
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

                        $(socio.param.gridBody).trigger("reloadGrid");
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
}

/**
 * Register validation of socio
 * when these is register
 */
socio.fn.prototype.validateSuscripcionSocio = function() {
    $(socio.param.formSuscribirseSocio).validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
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
                    //obj[0].currentForm[10].innerHTML ="Enviando...";
                },
                success: function(response) {
                    //$('#answers').html(response);
                    /*if (response == 1) {
                        form.children[0].removeAttribute('disabled');
                        $('#myModal').modal('hide');
                        form.reset();
                        obj[0].currentForm[10].innerHTML ="Enviar";

                        $(socio.param.gridBody).trigger("reloadGrid");
                        bootbox.alert("Se Guardo correctamente!", function() {
                            //Example.show("Hello world callback");
                        });
                    } else {
                        alert("error request");
                    }*/
                }
            });
        },
        invalidHandler: function (form) {
        }
    });
}
/**
 * Init Object and Functionalities
 * @type {socio.fn}
 */
var classSocio = new socio.fn();
classSocio.init();
classSocio.validateNewSocio();
classSocio.grid();
classSocio.validateSuscripcionSocio();


$( "#suscrip_fecha_inicio").datepicker({
    showButtonPanel: true,
    dateFormat: 'dd-mm-yy'
    /*showOtherMonths: true,
    selectOtherMonths: false,
    //isRTL:true,
    changeMonth: true,
    changeYear: true,

    showButtonPanel: true,
    beforeShow: function() {
        //change button colors
        var datepicker = $(this).datepicker( "widget" );
        setTimeout(function(){
            var buttons = datepicker.find('.ui-datepicker-buttonpane')
            .find('button');
            buttons.eq(0).addClass('btn btn-xs');
            buttons.eq(1).addClass('btn btn-xs btn-success');
            buttons.wrapInner('<span class="bigger-110" />');
        }, 0);
    }*/

});


//test timer
$(function () {
    $('.countdown.callback').countdown({
        date: +(new Date) + 10000,
        render: function(data) {
            var stringTime = data.days + " days "+
            this.leadingZeros(data.hours, 2) + " hours "+
            this.leadingZeros(data.min, 2) + " min "+
            this.leadingZeros(data.sec, 2) + " sec";
            $(this.el).text(stringTime);
        },
        onEnd: function() {
            $(this.el).addClass('ended');
        }
    }).on("click", function() {
        $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
    });
});

