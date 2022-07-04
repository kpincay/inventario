<style rel="stylesheet">

    .celdaError{
        background-color: red;
        color: white;
    }

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
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<?php

if($_SESSION["perfil"] == "Especial"){

    echo '<script>

    window.location = "inicio";

  </script>';

    return;

}

?>

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administración de Sell Out

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Sell Out</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border" >

                <div class="col-md-2" style="display: none;">
                    <h5><strong>Cadena</strong></h5>
                    <select class="form-control" id="seleccionarCadena" name="seleccionarCadena"  required>

                        <option value="">Seleccionar cadena</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorCadenas::ctrMostrarCadenas($item, $valor);

                        foreach ($categorias as $key => $value) {

                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                        }

                        ?>

                    </select>
                </div>

                <button class="btn btn-primary" id="btnValidarGrid">
                    <i class="fa fa-check"></i>
                    Validar

                </button>

                <button class="btn btn-success" id="btnGuardarGrid" >
                    <i class="fa fa-save"></i>
                    Guardar

                </button>

                <button class="btn btn-danger" id="btnLimpiarGrid" >
                    <i class="fa fa-search"></i>
                    Limpiar

                </button>


            </div>

            <div class="box-body">

                <div class="loader" style="align-self: center; display: none;"></div>
                <div class="table-responsive demo-x content">
                    <div style="width: 100%;" id="grid_json_copy"></div>
                </div>

            </div>

        </div>

    </section>

</div>

<script src="vistas/js/sell-out.js"></script>
<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="vistas/Resourse/datepicker/bootstrap-datepicker.js"></script>
<script src="vistas/Resourse/notify.js.txt"></script>
<script src="vistas/Resourse/jQueryUI/jquery-ui.js" type="text/javascript"></script>
<script src="vistas/paramquery-pro/pqgrid.min.js"></script>
<script src="vistas/alertifyjs/alertify.min.js"></script>

