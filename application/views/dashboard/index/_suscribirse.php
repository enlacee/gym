<form action="socio/add" name="formSuscribirse" id="formSuscribirse" method="POST">
    <fieldset name="fset_formSuscribirse" id="fset_formSuscribirse">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Suscribirse</h4>
        </div>
        <div class="modal-body">

            <div class="jumbotron">
                <h1>1 Dia!</h1>
            </div>

            <div class="row form-group">
                <div class="col-md-4"><label>Fecha de inicio</label></div>
                <div class="col-md-8 input-group input-group-sm">
                    <input type="text" id="suscrip_fecha_inicio" name="suscrip_fecha_inicio" value="<?php echo date("d\/m\/Y") ?>" class="required form-control">
                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-4"><label>Fecha fin</label></div>
                <div class="col-md-8 input-group input-group-sm">
                    <input type="text" id="suscrip_fecha_fin" name="suscrip_fecha_fin" value="" class="required form-control" readonly="readonly">
                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                </div>
            </div>

        </div>
    </fieldset>
    <div class="modal-footer">
        <button type="button" class="btn btn-default">Aceptar</button>
        <!--<button id ="btnSave"  class="btn btn-default" data-dismiss="modal">Save</button>-->
        <button id ="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    </div>
</form>