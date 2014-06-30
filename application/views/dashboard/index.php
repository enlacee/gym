
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

                        <div id="profile" class="tab-pane itemdiv">
                            <?php $this->load->view('dashboard/index/_formEditSocio.php', $empresa_producto); ?>
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
<?php $this->load->view('dashboard/index/_formAddSocio.php'); ?>
        </div>
    </div>
</div>
<!-- modal suscribirse -->
<div class="modal fade" id="myModalSuscribirse" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
<?php $this->load->view('dashboard/index/_suscribirse.php'); ?>
        </div>
    </div>
</div>
