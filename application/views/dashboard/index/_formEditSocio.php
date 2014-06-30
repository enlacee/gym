                <div class="row">
                    <form action="" id="formEditSocio" name="formEditSocio">

                        <fieldset>
                            id_empresa_producto<input type="text" name="id_empresa_producto" value=""/>

                            <div class="widget-main panel panel-primary padding-10">
                                <ul class=" spaced list-inline">
                                    <li><strong type="button" class="blue">Suscrito a:</strong></li>
                                    <?php if (is_array($empresa_producto) && count($empresa_producto) > 0) : ?>
                                        <?php foreach($empresa_producto as $array) : ?>
                                            <?php $classButton = ($array['nro_dia'] == 30) ? 'btn btn-sm btn-primary' : 'btn btn-xs btn-grey'; ?>
                                            <li><button type="button"
                                                        value="<?php echo $array['id'] ?>"
                                                        data-categoria="<?php echo $array['id_categoria'] ?>"
                                                        data-periodo="<?php echo $array['id_periodo'] ?>"
                                                        data-precio="<?php echo $array['precio'] ?>"
                                                        data-nroDia="<?php echo $array['nro_dia'] ?>"
                                                        data-toggle="modal" data-target="#myModalSuscribirse"
                                                        class="buttonSuscribirse <?php echo $classButton ?>"><?php echo $array['nombre'] ?></button></li>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <li>No existen productos disponibles (configure esta opcion)!</li>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </fieldset>


                    <div class="col-md-6">

                        <div class="row form-group">
                            <div class="col-md-4 col-sm-2"><label>Nombres</label></div>
                            <div class="col-md-4 col-sm-5">
                                <input type="text" id="first_name" name="first_name" value="" class="required form-control" placeholder="Nombres"
                                minlength="3" maxlength="30">
                            </div>
                            <div class="col-md-4 col-sm-5">
                                <input type="text" id="last_name" name="last_name" value="" class="required form-control" placeholder="Apellidos"
                                minlength="3" maxlength="30">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4 col-sm-2"><label>Sexo</label></div>
                            <div class="col-md-8 col-sm-10">
                                <div class="radio-inline">
                                    <label>
                                        <input class="required" type="radio" id="sexo" name="sexo" value="F">Femenino
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input class="required" type="radio" id="sexo" name="sexo" value="M">Masculino
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4"><label>Correo</label></div>
                            <div class="col-md-8">
                                <input type="text" id="email" name="email" value="" class="required email form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4"><label>Celular</label></div>
                            <div class="col-md-8">
                                <input type="text" id="celular" name="celular" value="" class="required phone {number} form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4"><label>Direccion</label></div>
                            <div class="col-md-8">
                                <input type="text" id="direccion" name="direccion" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4"><label>Nota</label></div>
                            <div class="col-md-8">
                                <textarea id="observacion" name="observacion" class="form-control" ></textarea>
                            </div>
                        </div>


                            <div class="row"></div>
                            <div class="row"></div>
                            <div class="row"></div>
                    </div>

                    <div class="col-md-6">+</div>

                    <!-- floatando TOOL-->
                    <div class="tools">
                        <div class="action-buttons bigger-125">
                            <button class="btn btn-danger no-radius"><i class="icon-save bigger-130"></i> Guardar</button>
                            <button type="button" class="btn btn-default no-radius">Cancelar</button>
                        </div>
                    </div>
                    </form>
                </div>