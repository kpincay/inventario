$.ajaxSetup({


    error: function (jqXHR, textStatus, errorThrown) {

        if (jqXHR.status === 0) {

            alert('Error de red, veifique la red de internet');

        } else if (jqXHR.status == 404) {

            alert('Servidor no econtrado 404');

        } else if (jqXHR.status == 500) {


            alert('Error interno DEL SERVIDOR... ');

        } else if (textStatus === 'parsererror') {

            console.log("ERROR : " + jqXHR.responseText + "FIN ", errorThrown);
            alert
        } else if (textStatus === 'timeout') {

            alert('Error de tiempo de espera ');

        } else if (textStatus === 'abort') {

            alert('Solicitud de ajax abortada .');

        } else {

            alert('Error no econtrado: ' + jqXHR.responseText);

        }

    }
});







//Configurar la salida del alertify
//kpi comment
// alertify.set('notifier', 'position', 'top-center');
var intervalo1;
$(function() {
    var numeroFilas = 15,
        cols = 1,
        toLetter = pq.toLetter,
        colModel = [];
    var cant = 0;
    var data = [];

    for (var i = 0; i < data; i++) {
        data[i] = {
            title: toLetter(i),
            width: 15,

        };

    }

    //Definicion del Modelo (dataIndx: Nombre del campo o colummna)

    colModel[0] = { title: "fecha",                                width: 100, dataIndx: "fecha",                               dataType: "string",  editable: true };
    colModel[1] = { title: "ciudad",                               width: 200, dataIndx: "ciudad",                              dataType: "string",  editable: true };
    colModel[2] = { title: "tienda",                               width: 200, dataIndx: "tienda",                              dataType: "string",  editable: true };
    colModel[3] = { title: "codigo",                               width: 150, dataIndx: "codigo",                              dataType: "string", editable: true };
    colModel[4] = { title: "descripcion",                          width: 300, dataIndx: "descripcion",                         dataType: "string", editable: true };
    colModel[5] = { title: "cadena",                               width: 200, dataIndx: "cadena",                              dataType: "string",  editable: true };
    colModel[6] = { title: "cantidad",                             width: 100, dataIndx: "cantidad",                            dataType: "string",  editable: true };
    colModel[7] = { title: "codigo_duocell",                       width: 150, dataIndx: "codigo_duocell",                      dataType: "string",  editable: true };
    colModel[8] = { title: "proveedor",                            width: 200, dataIndx: "proveedor",                           dataType: "string",  editable: true };


    var toolbar = {
        // items: [
        //     {
        //         type: 'button',
        //         label: '<span class="uk-button uk-button-primary uk-button-small"> Cargar Datos </span>',
        //         listener: function() {
        //             AlertaEspera('esperando');
        //             // contador(TIEMPO_ESPERA);
        //
        //             setTimeout(function(){
        //                 guardarRegistros();
        //             }, 100);
        //
        //         }
        //     },
        //     {
        //         type: 'button',
        //         label: '<span class="uk-button uk-button-primary uk-button-small"> Actualizar </span>',
        //         listener: function() {
        //             Limpiar();
        //         }
        //     },
        // ]
    };



    //Configuracion de la grid
    var obj = {
        id: 'gridddId',
        colModel: colModel,
        dataModel: { data: data },
        width: '100%-2',
        // width: '99%',
        height: '130%',
        title: "Datos de SellOut",
        toolbar: toolbar,
        virtualX: true,
        virtualY: true,
        selectionModel: { column: true },
        //	columnBorders: true,
        direction: "",
        title: "<div class='uk-text-center uk-bebas-neue uk-h3 uk-text-primary uk-margin-top'>Data Sell Out.</div>",
        flexHeight: false,
        draggable: false,
        scrollModel: { horizontal: false },
        freezeCols: 0,
    }


    /*************************
     * LIMPIAR DATAGRIP
     *************************/

    $("#btnLimpiarGrid").click(function() {
        window.location = window.location;
    });

    //FUNCION PARA REPRODUCIR SONIDO. CAMBIO POR: BRYAN MOREIRA
    function sonido_alerta(){
        var audio = new Audio("../dist/mp3/alerta_carga.mp3");
        audio.play();
    }

    /*******************************
     * VALIDAR REGISTROS
     ******************************/

    $("#btnValidarGrid").click(function(){
        $(".loader").show();
        // var idCadena = $('#seleccionarCadena').find(":selected").text();
        var idCadena_ = $('#seleccionarCadena').val();
        var opCadena = 0;
        var codigos = [];
        // $('#tablaPresupuesto tr').remove();

        // if (idCadena == '' || idCadena == 'Seleccionar cadena'){
        //     swal({
        //         title: 'Alerta',
        //         text: "Seleccione una Cadena",
        //         type: 'warning'
        //     })
        //     $(".loader").hide();
        //     return;
        // }

        var upper = "";

        let conteo = $("#grid_json_copy").pqGrid("pageData");
        if (conteo.length === 1 || conteo.length === 0){
                swal({
                    title: 'Alerta',
                    text: "Ingrese registros!",
                    type: 'warning'
                })
                $(".loader").hide();
                return;
        }

        for (let i = 0; i < conteo.length; i++) {
            var row1Data = $("#grid_json_copy").pqGrid("getRowData", { rowIndx: i });

            if (row1Data.cantidad  == '' || row1Data.cantidad == null){
                $("#grid_json_copy").pqGrid("addClass", { rowIndx: i, dataIndx: 'cantidad', cls: "celdaError"  });
            }else  {
                $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'cantidad', cls: "celdaError"  });
            }

            var linea = i + 1;

            if (row1Data.cadena.toUpperCase() == "ARTEFACTA"){
                opCadena = 1;
            }else if (row1Data.cadena.toUpperCase() == "CRECOS"){
                opCadena = 2;
            }else if (row1Data.cadena.toUpperCase() == "DE PRATTI"){
                opCadena = 3;
            }else if (row1Data.cadena.toUpperCase() == "LA GANGA"){
                opCadena = 4;
            }else if (row1Data.cadena.toUpperCase() == "MARCIMEX"){
                opCadena = 5;
            }else if (row1Data.cadena.toUpperCase() == "PYCCA"){
                opCadena = 6
            }else if (row1Data.cadena.toUpperCase() == "ICESA"){
                opCadena = 7;
            }else  {
                $("#grid_json_copy").pqGrid("addClass", { rowIndx: i, dataIndx: 'cadena', cls: "celdaError"  });
                alert("Por favor corrija el valor de la cadena en la fila: " + linea);
                $(".loader").hide();
                return ;
            }

            if (opCadena != 0){
                $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'cadena', cls: "celdaError"  });
            }

            var datos2 = new FormData();
            datos2.append("opCadena", opCadena);
            datos2.append("codCadena", row1Data.codigo);

            $.ajax({

                url:"ajax/productos.ajax.php",
                method: "POST",
                data: datos2,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){

                    var codigo = respuesta.imei;
                    var id = i;
                    var dato = "";
                    if (respuesta == 0){
                        $("#grid_json_copy").pqGrid("updateRow", { rowIndx: i, newRow : { 'codigo_duocell' : 'NO DATA'} });
                        $("#grid_json_copy").pqGrid("addClass", { rowIndx: i, dataIndx: 'codigo_duocell', cls: "celdaError"  });
                    }else{
                        dato = codigo;
                        $("#grid_json_copy").pqGrid("updateRow", { rowIndx: i, newRow : { 'codigo_duocell' : codigo} });
                        $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'codigo_duocell', cls: "celdaError"  });
                    }
                }

            });



        }
        validaTiendas();

    });


    function validaTiendas() {
        var idCadena_ = 0;
        // $('#tablaPresupuesto tr').remove();
        let conteo = $("#grid_json_copy").pqGrid("pageData");

        for (let i = 0; i < conteo.length; i++) {
            var row1Data = $("#grid_json_copy").pqGrid("getRowData", { rowIndx: i });

            $("#seleccionarCadena option").each(function(){
                if (row1Data.cadena.valueOf() == $(this).text()){
                    idCadena_ = $(this).attr('value');
                }
            });
            var linea = i + 1;

            if (idCadena_ === 0){
                alert("Por favor corrija el valor de la cadena en la fila: " + linea);
                $("#grid_json_copy").pqGrid("addClass", { rowIndx: i, dataIndx: 'cadena', cls: "celdaError"  });
                return;
            }

            var datos3 = new FormData();
            datos3.append("nombreTienda", row1Data.tienda.toUpperCase());
            datos3.append("ciudadTienda", row1Data.ciudad);
            datos3.append("idCadena", idCadena_);
            $.ajax({

                url:"ajax/tiendas.ajax.php",
                method: "POST",
                data: datos3,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){
                var tiendaC = '';
                var ciudadC = '';
                    if (respuesta.result === 0){
                        if (respuesta.tienda === 0){
                            // tiendaC = 'CORREGIR TIENDA ' + row1Data.tienda.toUpperCase();
                            // $("#grid_json_copy").pqGrid("updateRow", { rowIndx: i, newRow : { 'tienda' : tiendaC} });
                            $("#grid_json_copy").pqGrid("addClass", { rowIndx: i, dataIndx: 'tienda', cls: "celdaError"  });
                        }else  if (respuesta.tienda === 1){
                            $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'tienda', cls: "celdaError"  });
                        }
                        if (respuesta.ciudad == 0){
                            // ciudadC = 'CORREGIR CIUDAD ';
                            // $("#grid_json_copy").pqGrid("updateRow", { rowIndx: i, newRow : { 'ciudad' : ciudadC} });
                            $("#grid_json_copy").pqGrid("addClass", { rowIndx: i, dataIndx: 'ciudad', cls: "celdaError"  });
                        }else if (respuesta.ciudad === 1){
                            $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'ciudad', cls: "celdaError"  });
                        }
                    }else{
                        $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'tienda', cls: "celdaError"  });
                        $("#grid_json_copy").pqGrid("removeClass", { rowIndx: i, dataIndx: 'ciudad', cls: "celdaError"  });
                    }
                    $(".loader").hide();
                }

            });
        }
    }



    /*******************************
     * GUARDAR REGISTROS
     *******************************/
    $("#btnGuardarGrid").click(function(){
        valores = new Array();
        valores2 = new Array();

        let conteo = $("#grid_json_copy").pqGrid("pageData");
        $("#btnValidarGrid").click();

        for (var i = 0; i < conteo.length; i++) {

            var linea = i + 1;
            var row1Data = $("#grid_json_copy").pqGrid("getRowData", { rowIndx: i });
            if (row1Data.tienda.includes("CORREGIR TIENDA") || row1Data.codigo_duocell == "NO DATA" || row1Data.ciudad.includes("CORREGIR CIUDAD")){
                alert("Corrija los errores en la línea: " + linea);
                return;
            }


            if ($("#grid_json_copy").pqGrid("hasClass", { rowIndx: i, dataIndx: 'cantidad', cls: "celdaError"  })){
                alert("Corrija los errores en la línea: " + linea);
                return;
            }
        }
        for (var i = 0; i < conteo.length; i++) {
            var row1Data = $("#grid_json_copy").pqGrid("getRowData", { rowIndx: i });

            var cod_duocel = "";
            cod_duocel = "1-" + row1Data.codigo_duocell;

            var datos2 = new FormData();
            datos2.append("fecha", row1Data.fecha);
            datos2.append("ciudad", row1Data.ciudad);
            datos2.append("tienda", row1Data.tienda);
            datos2.append("codigo", row1Data.codigo);
            datos2.append("descripcion", row1Data.descripcion);
            datos2.append("cadena", row1Data.cadena);
            datos2.append("cantidad", row1Data.cantidad);
            datos2.append("codigo_duocell", cod_duocel);
            datos2.append("proveedor", row1Data.proveedor);

            $.ajax({

                url:"ajax/sellout.ajax.php",
                method: "POST",
                data: datos2,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){
                    if (respuesta == 1){

                    }else {
                        swal({
                            title: "Ocurrió un error al procesar!",
                            type: "error",
                            confirmButtonText: "¡Cerrar!"
                        }).then(function(result) {
                            return;
                        });
                    }


                },
                complete : function(xhr, status) {

                    swal({
                        title: "Registros guardados correctamente!",
                        type: "success",
                        confirmButtonText: "¡Cerrar!"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "sell-out";
                        }
                    });
                }

            });

        }
        // debugger;

        // registrar(valores);

    });

    var TIEMPO_ESPERA=86400;


    function registrar(valores) {

        var datos2 = new FormData();
        // datos2.append("opCadena", valores.);
        datos2.append("codCadena", row1Data.codigo);

        $.ajax({

            url:"ajax/productos.ajax.php",
            method: "POST",
            data: datos2,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){

                var codigo = respuesta.imei;
                var id = i;
                var dato = "";
                if (respuesta == 0){
                    $("#grid_json_copy").pqGrid("updateRow", { rowIndx: i, newRow : { 'codigo_duocell' : 'NO DATA'} });
                }else{
                    dato = codigo;
                    $("#grid_json_copy").pqGrid("updateRow", { rowIndx: i, newRow : { 'codigo_duocell' : codigo} });
                }
            }

        });
    }

    var intervalo;
    function contador(ESPERA) {
        var n = 1;
        $(".contador").show();
        intervalo = window.setInterval(
            function () {
                $(".segundos").html(n + "/" + ESPERA);

                n++;
                if (ESPERA == n) {
                    document.getElementById("detalle_error").innerHTML = "<pre style='font-size:18px;  color:#ff0000; text-align: center '>TIMEPO ESPERA LLEGO A LAS 24 HORAS </pre>";
                    clearInterval(intervalo);
                    AlertaExito('EXITO', 'EXITO');
                }
            }, 1000);
    }


     var grid = $("#grid_json_copy").pqGrid(obj);
    $("#grid_json_copy").pqGrid("addRow", { newRow: {}, rowIndx: 0 });
    $("#grid_json_copy").pqGrid({
        editorEnd: function(event, ui) {
            var filaActual = ui.rowIndx;
            var colActual = ui.colIndx;
            var descripcion = '';
            var costo = '';
            if (ui.rowData) {
                var rowIndx = ui.rowIndx,
                    colIndx = ui.colIndx,
                    dataIndx = ui.dataIndx,
                    cellData = ui.rowData[dataIndx],
                    currentRowIndex = rowIndx;
            }
        }
    })
});
















