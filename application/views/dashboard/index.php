
<div class="page-content">    

    <div class="row">
        <div class="col-md-12">
            <!--- INICIO -->
            <div class="col-md-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#socio">                                                            
                                <i class="green glyphicon-check icon-user"></i>Socios
                            </a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#profile">Edicion</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="socio" class="tab-pane active">                            
                            <div class="row form-group">
                                <div class="col-md-10 col-xs-12"> <b>Administrar Membresias</b>
                                    <a href="#" id="click">tab 2</a>
                                </div>

                                <div class="col-md-2 col-xs-12">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                                        <i class="icon-plus align-top bigger-125"></i>
                                        Agregar
                                    </button>
                                </div>                            
                            </div>                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">                                        
                                        <table id="grid-table"></table>
                                        <div id="grid-pager"></div>
                                    </div>
                                    
                                    
                                </div>                      
                            </div>                            
                             
                            
                        </div>                            

                        <div id="profile" class="tab-pane">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                        </div>

                    </div>
                </div>
            </div>                        
            <!-- FIN -->
        </div>                    
    </div>

</div><!-- End page-content --> 



<!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <form action="socio/add" name="formSocio" id="formSocio" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Socio (client)</h4>
                </div>
                <div class="modal-body">
                    
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
                    <!--<div class="row form-group">
                        <input type="hidden" id="key" name ="key" value ="">
                        <input type="hidden" id="parameter_antes" name ="parameter_antes" value ="">
                        <div class="col-md-4"><label>Sexo</label></div>
                        <div class="col-md-6">
                            <select name="parameter" id ="parameter" class="form-control input-sm">
                                <option value="">-</option>
                                <option value="2">Masculino</option>
                                <option value="1">Femenino</option>
                            </select>
                        </div>
                    </div>-->
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

                    <a href="#" class="btn btn-minier btn-primary" id="linkMoreSocio" data-toggle="collapse" data-target="#moreSocio">[+ mas]</a>
                    
                    <div id="moreSocio" class="collapse">
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
                    </div>                                
                    
                </div>
                <div class="modal-footer">
                    <button >enviar</button>
                    <button id ="btnSave"  class="btn btn-default" data-dismiss="modal">Save</button>
                    <button id ="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>   
