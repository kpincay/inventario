<?php

class ControladorCadenas{

	/*=============================================
	CREAR CADENAS
	=============================================*/

	static public function ctrCrearCadena(){

		if(isset($_POST["nuevoRuc"])){
			// if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCadena"]) &&
			if(
			   preg_match('/^[0-9]+$/', $_POST["nuevoRuc"]
			//    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			//    preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			//    preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]
			)){
			   	$tabla = "cadenas";

			   	$datos = array("ruc"=>$_POST["nuevoRuc"],
				   			   "nombre"=>$_POST["nuevoNombre"],
					           "ciudad"=>$_POST["nuevoCiudad"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "fecha_registro"=>$_POST["nuevaFechaRegistro"]);
			   	$respuesta = ModeloCadenas::mdlIngresarCadena($tabla, $datos);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Cadena ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cadenas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La Cadena no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cadenas";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CadenaS
	=============================================*/

	static public function ctrMostrarCadenas($item, $valor){

		$tabla = "cadenas";

		$respuesta = ModeloCadenas::mdlMostrarCadenas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CADENA
	=============================================*/

	static public function ctrEditarCadena(){

		if(isset($_POST["editarRuc"])){

//			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCadena"]) &&
//			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
//			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) &&
//			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
//			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){
            if (true){

			   	$tabla = "cadenas";

			   	$datos = array("id"=>$_POST["idcadena"],
				   				"nombre"=>$_POST["nuevoNombre"],
								"ruc"=>$_POST["nuevoRuc"],
								"ciudad"=>$_POST["nuevoCiudad"],
								"email"=>$_POST["nuevoEmail"],
								"telefono"=>$_POST["nuevoTelefono"],
								"direccion"=>$_POST["nuevaDireccion"],
								"fecha_registro"=>$_POST["nuevaFechaRegistro"]);

			   	$respuesta = ModeloCadenas::mdlEditarCadena($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Cadena ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cadenas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La Cadena no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cadenas";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR Cadena
	=============================================*/

	static public function ctrEliminarCadena(){

		if(isset($_GET["idCadena"])){

			$tabla ="cadenas";
			$datos = $_GET["idCadena"];

			$respuesta = ModeloCadenas::mdlEliminarCadena($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Cadena ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "cadenas";

								}
							})

				</script>';

			}	else   {
                echo'<script>

				swal({
					  type: "error",
					  title: "Ocurrió un error al eliminar la Cadena, Verificar si la misma contiene tiendas creadas",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "cadenas";

								}
							})

				</script>';
            }

		}

	}

}

