                <div class="row">
                    <form action="<?php echo base_url('socio/update') ?>" id="formEditSocio" name="formEditSocio" method="POST">
                        <fieldset disabled>
                            id_socio
                            <input type="text" name="id_socio" id="id_socio" value=""/>
                            id_empresa_producto
                            <input type="text" name="id_empresa_producto" id="id_empresa_producto" value=""/>
                            id_suscrito
                            <input type="text" name="ac_socios_suscriptores.id" id="ac_socios_suscriptores.id" value=""/>

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

                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-4"><label>Fecha Inicio</label></div>
                                    <div class="col-md-8">
                                        <input type="text" id="fecha_inicio" name="fecha_inicio" value="" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4"><label>Fecha Fin</label></div>
                                    <div class="col-md-8">
                                        <input type="text" id="fecha_fin" name="fecha_fin" value="" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-4"><label>Vence</label></div>
                                    <div class="col-md-8">
                                        <div class="countdown callback btn btn-sm btn-danger"></div>
                                    </div>
                                </div>


                            </div>

                            <!-- floatando TOOL-->
                            <div class="tools">
                                <div class="action-buttons bigger-125">
                                    <button class="btn no-radius"><i class="icon-save bigger-130"></i> Guardar</button>
                                    <button type="button" class="btn btn-default no-radius">Cancelar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>