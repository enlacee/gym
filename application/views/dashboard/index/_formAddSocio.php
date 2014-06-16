            <form action="socio/add" name="formAddSocio" id="formAddSocio" method="POST">
                <fieldset name="fset_formAddSocio" id="fset_formAddSocio">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Socio (client)</h4>
                </div>
                <div class="modal-body">

                    <div class="row form-group">
                        <div class="col-md-4 col-sm-2"><label>Nombres</label></div>
                        <div class="col-md-4 col-sm-5">
                            <input type="text" id="addSocio_first_name" name="addSocio_first_name" value="" class="required form-control" placeholder="Nombres"
                            minlength="3" maxlength="30">
                        </div>
                        <div class="col-md-4 col-sm-5">
                            <input type="text" id="addSocio_last_name" name="addSocio_last_name" value="" class="required form-control" placeholder="Apellidos"
                            minlength="3" maxlength="30">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-2"><label>Sexo</label></div>
                        <div class="col-md-8 col-sm-10">
                            <div class="radio-inline">
                                <label>
                                    <input class="required" type="radio" id="addSocio_sexo" name="addSocio_sexo" value="F">Femenino
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input class="required" type="radio" id="addSocio_sexo" name="addSocio_sexo" value="M">Masculino
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4"><label>Correo</label></div>
                        <div class="col-md-8">
                            <input type="text" id="addSocio_email" name="addSocio_email" value="" class="required email form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4"><label>Celular</label></div>
                        <div class="col-md-8">
                            <input type="text" id="addSocio_celular" name="addSocio_celular" value="" class="required phone {number} form-control">
                        </div>
                    </div>

                    <a href="#" class="btn btn-minier btn-primary" id="linkMoreSocio" data-toggle="collapse" data-target="#moreSocio">[+ mas]</a>

                    <div id="moreSocio" class="collapse">
                        <div class="row form-group">
                            <div class="col-md-4"><label>Direccion</label></div>
                            <div class="col-md-8">
                                <input type="text" id="addSocio_direccion" name="addSocio_direccion" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4"><label>Nota</label></div>
                            <div class="col-md-8">
                                <textarea id="addSocio_observacion" name="addSocio_observacion" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                </fieldset>
                <div class="modal-footer">
                    <button class="btn btn-default">Enviar</button>
                    <!--<button id ="btnSave"  class="btn btn-default" data-dismiss="modal">Save</button>-->
                    <button id ="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>