<style>
    .loader {
        position: center;
        border: 10px solid #f3f3f3; /* Light grey */
        border-top: 10px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<?php

if ($_SESSION["perfil"] == "Especial") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;

}

?>

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administración de Presupuestos para Mercaderistas

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar presupuesto</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

<!--                <div class="col-md-2">-->
<!--                    <h5><strong>Cadena</strong></h5>-->
<!--                    <select class="form-control" id="seleccionarCadena" name="seleccionarCadena" required>-->
<!---->
<!--                        <option value="">Seleccionar cadena</option>-->
<!---->
<!--                        --><?php
//
//                        $item = null;
//                        $valor = null;
//
//                        $categorias = ControladorCadenas::ctrMostrarCadenas($item, $valor);
//
//                        foreach ($categorias as $key => $value) {
//
//                            echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
//
//                        }
//
//                        ?>
<!---->
<!--                    </select>-->
<!--                </div>-->

                <div class="col-md-2">
                    <h5><strong>Zona</strong></h5>
                    <select class="form-control" id="seleccionarCadena" name="seleccionarCadena" required>

                        <option value="">Seleccionar zona</option>
                        <option value="">Quito</option>
                        <option value="">Guayaquil</option>

                    </select>
                </div>

                <div class="col-md-2">
                    <h5><strong>Mes desde</strong></h5>
                    <input type="month" min="2017-01" id="mesDesde"/>
                </div>

                <div class="col-md-2">
                    <h5><strong>Mes hasta</strong></h5>
                    <input type="month" id="mesHasta"
                           max="<?php echo date("Y", strtotime('+1 year')) . "-" . date("m") ?>"/>
                </div>

                <br>

                <button class="btn btn-primary" id="btnGenerarPlantilla">
                    <i class="fa fa-calendar"></i>
                    Generar Plantilla

                </button>

                <button class="btn btn-success" id="btnConsultarPlantilla">
                    <i class="fa fa-search"></i>
                    Consultar

                </button>


            </div>

            <div class="box-body">

                <div class="loader" style="align-self: center; display: none;"></div>
                <table class="table dt-responsive " id="tablaPresupuesto" style="display: block; overflow-x: auto; "
                       width="100%">

                    <thead>

                    <tr>


                    </tr>

                    </thead>

                    <tbody>


                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>
<div class="box-footer">
    <button class="btn btn-success" style="float: right; display: none;" id="btnActualizarPlantilla">
        <i class="fa fa-search"></i>
        Guardar

    </button>
</div>

<!--=====================================
MODAL AGREGAR PRESUPUESTO
======================================-->

<div id="modalAgregarTienda" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Tienda</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoNombre"
                                       placeholder="Ingresar nombre" required>

                            </div>

                        </div>

                        <!--=====================================
                             ENTRADA DE LA CADENA
                             ======================================-->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                <select class="form-control" id="seleccionarCadena" name="seleccionarCadena"
                                        onchange="cadenaSelected()" required>

                                    <option value="">Seleccionar cadena</option>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    $categorias = ControladorCadenas::ctrMostrarCadenas($item, $valor);

                                    foreach ($categorias as $key => $value) {

                                        echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';

                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA CIUDAD -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoCiudad"
                                       placeholder="Ingresar ciudad" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group" style="display: none;">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" class="form-control input-lg" name="nuevoEmail" value=""
                                       placeholder="Ingresar email">

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL TELEFONO -->

                        <div class="form-group" style="display: none;">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoTelefono" value=""
                                       placeholder="Ingresar telefono">

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DIRECCIÓN -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaDireccion"
                                       placeholder="Ingresar dirección" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaFechaRegistro"
                                       value="<?= date('Y-m-d') ?>" placeholder="Fecha de registro" readonly required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar Tienda</button>

                </div>

            </form>

            <?php

            $crearTienda = new Controladortiendas();
            $crearTienda->ctrCrearTienda();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR Tienda
======================================-->

<div id="modalEditarTienda" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Tienda</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <input type="hidden" class="form-control input-lg" name="editarid_cadena" id="editarid_cadena">
                        <!--              ENTRADA PARA LA CADENA-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="editarCadena" readonly required>

                                    <option id="editarCadena"></option>

                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="editarTienda" id="editarTienda"
                                       required>
                                <input type="hidden" id="idTienda" name="idTienda">
                            </div>

                        </div>

                        <!-- ENTRADA PARA LA CIUDAD -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="text" class="form-control input-lg" PLACEHOLDER="Ingrese la ciudad"
                                       name="editarCiudad" id="editarCiudad">

                            </div>

                        </div>


                        <!-- ENTRADA PARA LA DIRECCIÓN -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input type="text" class="form-control input-lg" name="editarDireccion"
                                       id="editarDireccion" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" class="form-control input-lg" name="editarFechaRegistro"
                                       id="editarFechaRegistro" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask
                                       required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

            </form>

            <?php

            //        $editarTienda = new Controladortiendas();
            //        $editarTienda -> ctrEditarTienda();

            ?>


        </div>

    </div>

</div>

<?php

//  $eliminarTienda = new Controladortiendas();
//  $eliminarTienda -> ctrEliminarTienda();

?>


