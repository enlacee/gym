                <div class="row">
                    <div class="">
                            <div class="widget-main panel panel-primary padding-10">
                                <ul class=" spaced list-inline">
                                    <li><strong class="blue">Suscrito a:</strong></li>    
                                <li><button class="btn btn-xs btn-grey disabled">GYM 1DIA</button></li>
                                <li><button class="btn btn-xs btn-grey disabled ">GYM 1SEM</button></li>
                                <li><button class="btn btn-sm btn-primary ">GYM 1MES</button></li>
                                <li><button class="btn btn-xs btn-grey ">GYM 3MES</button></li>
                                <li><button class="btn btn-xs btn-grey ">GYM 6MES</button></li>
                                <li><button class="btn btn-xs btn-grey ">GYM 1AN</button></li>
                                </ul>
                            </div>                            
                                                
                    </div>

                    <div class="col-md-6">
                        <form action="" id="formEditSocio" name="formEditSocio">
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
                                        <input class="required" type="radio" id="sexo" name="sexo" value="1">Femenino
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input class="required" type="radio" id="sexo" name="sexo" value="2">Masculino
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
                        

                        </form>
                    </div>

                    <div class="col-md-6">
                        +
                    </div>
                </div>                                          
