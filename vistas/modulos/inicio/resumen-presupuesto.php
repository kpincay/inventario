<div>
    <div class="col-lg-10">

        <table class="table table-bordered table-striped dt-responsive" id="tablaPresupuesto">

            <thead>

            <tr>

                <th>Cadena</th>
                <th>Presupuesto</th>
                <th>ventas</th>
                <th>Cumplimiento</th>

            </tr>

            </thead>

            <tbody>

            <?php

            $idCadena = null;
            $fechaDesde = null;
            $FechaHasta = null;
            $presupuestos = ControladorPresupuestos::ctrMostrarPresupuestos($idCadena, $fechaDesde, $FechaHasta);

            foreach ($presupuestos as $presupuesto) {
                $item = null;
                $valor = $presupuesto["cadena"];
                $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                $cumpliento = $presupuesto["presupuesto"] != 0 ?  ($ventas[0] / $presupuesto["presupuesto"]) * 100 : 0;
                echo '<tr>

                    <td>'.$presupuesto["cadena"].'</td>

                    <td class="presupuesto">'.$presupuesto["presupuesto"].'</td>
                    <td class="presupuesto">'.$ventas[0].'</td>
                    <td class="presupuesto">'.number_format($cumpliento,2).'%</td>
                    
                  </tr>';
            }

            ?>

            </tbody>

        </table>
    </div>

</div>

<script>
    $( document ).ready(function() {

        var cont = $("#tablaPresupuesto tr").length;
        var cont2 = $("#tablaVentas tr").length -1;
        var presupuesto = [];
        var venta = [];
        localStorage.clear();
        $('#tablaPresupuesto tr').each(function(){

            /* Obtener todas las celdas */
            var celdas = $(this).find('td');

            /* Mostrar el valor de cada celda */
            //celdas.each(function(){ alert($(this).html()); });

            /* Mostrar el valor de la celda 2 */
            presupuesto = $(celdas[1]).html() ;
            for (let i = 0; i < cont; i++) {
                localStorage.setItem(cont, presupuesto);
            }
        });
        $('#tablaVentas tbody tr').each(async function() {
            for (let index = 0; index < cont; index++){
                venta = $(this).find('td').eq(0).text();

            }
        });
        console.log(presupuesto);
        console.log("okokokoko");
        console.log(venta);
    });
</script>