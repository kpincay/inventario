<?php

class ControladorTiendas{

	/*=============================================
	CREAR TiendaS
	=============================================*/

	static public function ctrCrearTienda(){

		if(isset($_POST["nuevoNombre"])){
            $datosu = $_POST["nuevoNombre"];
//			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]))
//			   preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
//			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) &&
//			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
//			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])){
                if (true){

			   	$tabla = "Tiendas";

			   	$datos = array("id_cadena"=>$_POST["seleccionarCadena"],
                                "nombre"=>$_POST["nuevoNombre"],
					           "ciudad"=>$_POST["nuevoCiudad"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "fecha_registro"=>$_POST["nuevaFechaRegistro"]);

			   	$respuesta = ModeloTiendas::mdlIngresarTienda($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Tienda ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tiendas";

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

	/*=============================================
	MOSTRAR TiendaS
	=============================================*/

	static public function ctrMostrarTiendas($item, $valor){

		$tabla = "Tiendas";
		$respuesta = ModeloTiendas::mdlMostrarTiendas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR TIENDAS POR CADENAS
	=============================================*/

	static public function ctrMostrarTiendasPorCadenas($item, $valor){

		$tabla = "Tiendas";
        $item = "id_cadena";

		$respuesta = ModeloTiendas::mdlMostrarTiendasPorCadenas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR Tienda
	=============================================*/

	static public function ctrEditarTienda(){

		if(isset($_POST["editarTienda"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTienda"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "Tiendas";

			   	$datos = array("id"=>$_POST["idTienda"],
			   				   "id_cadena"=>$_POST["editarIdCadena"],
			   				   "nombre"=>$_POST["editarNombre"],
					           "ciudad"=>$_POST["editarCiudad"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_registro"=>$_POST["editarFechaRegistro"]);

			   	$respuesta = ModeloTiendas::mdlEditarTienda($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Tienda ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tiendas";

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

	/*=============================================
	ELIMINAR Tienda
	=============================================*/

	static public function ctrEliminarTienda(){

		if(isset($_GET["idTienda"])){

			$tabla ="Tiendas";
			$datos = $_GET["idTienda"];

			$respuesta = ModeloTiendas::mdlEliminarTienda($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Tienda ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
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

