<?php

class ControladorPresupuestos{



	/*=============================================
	MOSTRAR PRESUPUESTOS
	=============================================*/

	static public function ctrMostrarPresupuestos($cadena, $fechaDesde, $fechaHasta){

		$tabla = "presupuestos";
		$respuesta = ModeloPresupuestos::mdlMostrarPresupuestos($tabla, $cadena, $fechaDesde, $fechaHasta);
		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRESUPUESTOS POR CADENAS
	=============================================*/

	static public function ctrMostrarPresupuestosPorCadenas($item, $valor){

		$tabla = "Presupuestos";
        $item = "id_cadena";

		$respuesta = ModeloPresupuestos::mdlMostrarPresupuestosPorCadenas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	GENERAR PRESUPUESTOS
	=============================================*/

	static public function ctrGenerarPresupuestosPorCadenas($idCadena, $fecha){


		$respuesta = ModeloPresupuestos::mdlGenerarPresupuesto($idCadena, $fecha);

		return $respuesta;

	}

	/*=============================================
	EDITAR PRESUPUESTOS
	=============================================*/


    static public function ctrEditarPresupuestos($idPresupuesto, $valor){

        $respuesta = ModeloPresupuestos::mdlEditarPresupuesto($idPresupuesto, $valor);
        return $respuesta;
    }

	/*=============================================
	CONSULTAR PRESUPUESTOS
	=============================================*/


    static public function ctrConsultarPresupuestos($cadena, $fechaDesde, $fechaHasta){

        $respuesta = ModeloPresupuestos::mdlConsultarPresupuesto($cadena, $fechaDesde, $fechaHasta);
        return $respuesta;
    }

	/*=============================================
	ELIMINAR PRESUPUESTO
	=============================================*/

	static public function ctrEliminarPresupuesto(){

		if(isset($_GET["idPresupuesto"])){

			$tabla ="Presupuestos";
			$datos = $_GET["idPresupuesto"];

			$respuesta = ModeloPresupuestos::mdlEliminarPresupuesto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Presupuesto ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "Presupuestos";

								}
							})

				</script>';

			}		

		}

	}

}

