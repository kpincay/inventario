/*=============================================
CAPTURA DE DATOS
=============================================*/
$("#btnConsultarPlantillaM").click(function () {
    debugger;
    $(".loader").show();
    var idCadena = $('#seleccionarCadena').find(":selected").text();
    var fechaDesde = $("#mesDesde").val();
    var fechaHasta = $("#mesHasta").val();
    // $('#tablaPresupuesto tr').remove();

    if (idCadena == ''){
        swal({
            title: 'Alerta',
            text: "Seleccione una Cadena",
            type: 'warning'
        })
        $(".loader").hide();
        return;
    }

    if (fechaHasta == "" || fechaDesde == ""){
        swal({
            title: 'Alerta',
            text: "Seleccione un rango de meses",
            type: 'warning'
        })
        $(".loader").hide();
        return;
    }
    if (fechaDesde > fechaHasta){
        swal({
            title: 'Error',
            text: "Mes Desde no puede ser mayor a Mes Hasta",
            type: 'error'
        })
        $(".loader").hide();
        return;
    }

    var diferencia = restaMeses(new Date(fechaDesde) , new Date(fechaHasta));
    if (diferencia > 12){
        swal({
            title: 'Error',
            text: "El rango de meses no debe ser mayor a 15",
            type: 'error'
        });
        $(".loader").hide();
        return;
    }

    limpiarTabla();

    /*CONSULTA DE TIENDAS SEGUN CADENA SELECCIONADA*/

    // $('#tablaPresupuestoM').DataTable();
    $('.odd').remove();

    var datos2 = new FormData();
    datos2.append("cadena", idCadena);
    datos2.append("fechaDesde", fechaDesde);
    datos2.append("fechaHasta", fechaHasta);
    $.ajax({

        url:"ajax/prespuestos_mercaderistas.ajax.php",
        method: "POST",
        data: datos2,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            $(".loader").hide();
            console.log(respuesta.valueOf().length);
            if (respuesta.valueOf().length == 0){
                    swal({
                    title: 'Error',
                    text: "No hay datos, por favor generarlos",
                    type: 'error'
                });
                    return;
            }
            $('.dataTables_filter').remove();
            $('.dataTables_length').remove();
            $("#btnActualizarPlantilla").css('display', 'block');

            var reg = new RegExp("(((([1][9][0-9][0-9])|([2][0-9][0-9][0-9]))-(0[123456789]|10|11|12)))_id");
            var reg2 = new RegExp("(((([1][9][0-9][0-9])|([2][0-9][0-9][0-9]))-(0[123456789]|10|11|12)))");
            var cabecera = "";
            var cabecerah = "";
            $("#tablaPresupuestoM tbody").append('<th><strong>Tienda</strong></th><th><strong>Promotor</strong></th>');
            for (var key1 in respuesta[0]) {

                if (reg.test(key1)){
                    cabecerah = key1.valueOf();
                    $("#tablaPresupuestoM tbody").append('<th style="display: none;"><strong>' + cabecerah+ '</strong></th>');
                }else if (reg2.test(key1)){
                    cabecera = key1.valueOf();
                    $("#tablaPresupuestoM tbody").append('<th class="text-center"><strong>' + cabecera+ '</strong></th>');
                }
            }

            $.each(respuesta, function(index, item) {

                html = '<tr id="'+item.id+'"><td>'+ item.tienda +'</td><td>'+ item.promotor +'</td>';
                for (var key1 in item) {

                    if (reg.test(key1)){

                        cabecera = item[key1.valueOf()];

                        html += '<td style="display: none;"><input type=\"number\" class="id_mes" value="'+cabecera+'"/></td>';
                    }
                    else if (reg2.test(key1)){

                        cabecera = item[key1.valueOf()];

                        html += '<td><input type=\"number\" class="valor_mes" value="'+cabecera+'"/></td>';
                    }
                }
                html += '</tr>';
                $("#tablaPresupuestoM").append(html);

            });
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $(".loader").hide();
            swal({
                title: 'Error',
                text: "Datos de presupuesto no generados!",
                type: 'error'
            });
            console.log(errorThrown.valueOf());
            console.log(XMLHttpRequest.valueOf());
        }
    });
});


/*=============================================
GENERACION DE DATOS
=============================================*/
$("#btnGenerarPlantillaM").click(async function () {
    $(".loader").show();
    limpiarTabla();
    var idCadena = $("#seleccionarCadena").val();
    var nombreCadena = $('#seleccionarCadena').find(":selected").text();
    var fechaDesde = $("#mesDesde").val();
    var fechaHasta = $("#mesHasta").val();


    if (nombreCadena == ''){
        swal({
            title: 'Alerta',
            text: "Seleccione una Zona",
            type: 'warning'
        });
        $(".loader").hide();
        return;
    }

    if (fechaHasta == "" || fechaDesde == ""){
        swal({
            title: 'Alerta',
            text: "Seleccione un rango de meses",
            type: 'warning'
        });
        $(".loader").hide();
        return;
    }
    if (fechaDesde > fechaHasta){
        swal({
            title: 'Error',
            text: "Mes Desde no puede ser mayor a Mes Hasta",
            type: 'error'
        });
        $(".loader").hide();
        return;
    }

    var diferencia = restaMeses(new Date(fechaDesde) , new Date(fechaHasta));
    if (diferencia > 12){
        swal({
            title: 'Error',
            text: "El rango de meses no debe ser mayor a 15",
            type: 'error'
        });
        $(".loader").hide();
        return;
    }


    var nuevaFechaDesdeCons = fechaCompletaQuery(new Date(fechaDesde));
    var nuevaFechaHastaCons = fechaCompletaQuery(new Date(fechaHasta));


    // var datos2 = new FormData();
    // datos2.append("idCadenaCons", idCadena);
    // datos2.append("fechaDesde", nuevaFechaDesdeCons);
    // datos2.append("fechaHasta", nuevaFechaHastaCons);
    //
    // $.ajax({
    //
    //     url:"ajax/prespuestos.ajax.php",
    //     method: "POST",
    //     data: datos2,
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     dataType: "json",
    //     success:function(respuesta){
    //         if (respuesta= "ok"){
    //             console.log(respuesta);
    //             swal({
    //                 title: 'Alerta',
    //                 text: "Datos ya han sido generados",
    //                 type: 'alert'
    //             });
    //             return;
    //         }
    //
    //     }
    // });

    var nuevaFechaDesde = new Date(fechaDesde);
    var nuevaFechaHasta = new Date(fechaHasta);
     nuevaFechaDesde.setMonth(nuevaFechaDesde.getMonth() - 1);

    while(nuevaFechaHasta.getTime() >= nuevaFechaDesde.getTime()){
        nuevaFechaDesde.setMonth(nuevaFechaDesde.getMonth() + 1);
        var anio  = nuevaFechaDesde.getFullYear();
        var mes  = ("0" + (nuevaFechaDesde.getMonth() + 1)).slice(-2);
        var fechaFinal = anio + "-" + mes;


        var datosInsert = new FormData();

        datosInsert.append("fecha", fechaFinal);
        datosInsert.append("idCadena", nombreCadena);
        datosInsert.append("metodo", "generar");
        $.ajax({

            url:"ajax/prespuestos_mercaderistas.ajax.php",
            method: "POST",
            data: datosInsert,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if (respuesta != "ok"){
                    $(".loader").hide();
                    swal({
                        title: 'Error',
                        text: respuesta,
                        type: 'error'
                    })
                }else {
                    $(".loader").hide();
                    swal({
                        title: 'Generación exitosa',
                        text: "Se generó correctamente",
                        type: 'success'
                    })
                }
            }
        });
    }
});


/*=============================================
CAPTURA DE DATOS
=============================================*/
$("#btnActualizarPlantilla").click(function(){
    $(".loader").show();
    var filas = [];
    var cont = $("#tablaPresupuestoM tr:last td").length -2;
    var e = 0;
    var f = 0;
    $('#tablaPresupuestoM tbody tr').each(async function() {
        for (let index = 0; index < cont; index++){
            var tienda = $(this).find('td').eq(0).text();
            var promotor = $(this).find('td').eq(1).text();
            var valor = $(this).find('input[class=valor_mes]').eq(index).val() ? $(this).find('input[class=valor_mes]').eq(index).val() : 0;
            // var valor = $(this).find('input').eq(index).val() ? $(this).find('input').eq(index).val() : 0;
            var data = $(this).find('input[class=id_mes]').eq(index).val();
            debugger;
            // var data = $(this).find('input').eq(index).attr("class");

            var datosInsert = new FormData();
            e = e+1;
            datosInsert.append("idPresupuesto", data);
            datosInsert.append("valorPresupuesto", valor);
            $.ajax({

                url:"ajax/prespuestos_mercaderistas.ajax.php",
                method: "POST",
                data: datosInsert,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){
                    f = f+1;

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $(".loader").hide();
                    swal({
                        title: 'Error al actualizar!',
                        text: errorThrown.valueOf(),
                        type: 'error'
                    });
                }
            });


        }
    });
    console.log(f);
    window.setTimeout( swal({
        title: 'Actualización exitosa',
        text: "Se actualizó correctamente",
        type: 'success'
    }), 5000 );
    window.setTimeout( $(".loader").hide(), 5000 ); // 5 seconds

});



function eliminaFilas()
{
//OBTIENE EL NÚMERO DE FILAS DE LA TABLA
    var n=0;
    $("#tablaPresupuestoM tbody tr").each(function ()
    {
        n++;
    });
//BORRA LAS n-1 FILAS VISIBLES DE LA TABLA
//LAS BORRA DE LA ULTIMA FILA HASTA LA SEGUNDA
//DEJANDO LA PRIMERA FILA VISIBLE, MÁS LA FILA PLANTILLA OCULTA
    for(i=n-1;i>1;i--)
    {
        $("#tablaPresupuestoM tbody tr:eq('"+i+"')").remove();
    };
};

function restaMeses(dateFrom, dateTo) {
    // return dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
    return dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
}


function convierteMeses(mes) {
    // return dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
    switch (mes) {
        case '01':
            return  "Enero";
        case '02':
            return "Febrero";
        case '03':
            return "Marzo";
        case '04':
            return "Abril";
        case '05':
            return "Mayo";
        case '06':
            return "Junio";
        case '07':
            return "Julio";
        case '08':
            return "Agosto";
        case '09':
            return "Septiembre";
        case '10':
            return "Octubre";
        case '11':
            return "Noviembre";
        default:
            return "Diciembre";

    }
    return dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
}


function fechaCompletaQuery($fecha) {
    var anio  = $fecha.getFullYear();
    var mes  = ("0" + ($fecha.getMonth() + 1)).slice(-2);
    var fechaFinal = anio + "-" + mes;
    return fechaFinal;
}


function limpiarTabla() {
    if ($("#tablaPresupuestoM tr").length > 2){
    $("#tablaPresupuestoM tr").remove();
    $("#tablaPresupuestoM th").remove();
    }
}