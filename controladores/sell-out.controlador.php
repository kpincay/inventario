<?php

class ControladorSellOut{

    /*=============================================
    CREAR SELL OUT
    =============================================*/

    static public function ctrCrearSellOut($fecha,  $ciudad,  $tienda,  $codigo,  $descripcion, $cadena,  $cantidad,  $codigo_duocell, $proveedor){

        if(isset($codigo_duocell)){
            if (true){

                $codigo_duocell = (utf8_encode($codigo_duocell));
                $codigo_duocell = str_replace(
                    array('"', "¨", '"', 'Ã‘'),
                    array(" ", " ", " ", 'Ñ'),
                    $codigo_duocell
                );
                $tabla = "sell-out";

                $datos = array("fecha"=>$fecha,
                                "ciudad"=>$ciudad,
                                "tienda"=>$tienda,
                                "codigo"=>$codigo,
                                "descripcion"=>$descripcion,
                                "cadena"=>$cadena,
                                "cantidad"=>$cantidad,
                                "codigoDuocell"=>$codigo_duocell,
                                "proveedor"=>$proveedor);

                $respuesta = ModeloSellOut::mdlIngresarSellOut($tabla, $datos);

                if($respuesta == "ok"){

                    echo'<script>

					swal({
						  type: "success",
						  title: "Guardado correctamente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sell-out";

									}
								})

					</script>';

                }

            }else{

                echo'<script>

					swal({
						  type: "error",
						  title: "¡La Tienda no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tiendas";

							}
						})

			  	</script>';



            }

        }

    }

}