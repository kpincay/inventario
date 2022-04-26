<?php

require_once "../controladores/cadenas.controlador.php";
require_once "../modelos/cadenas.modelo.php";

class AjaxCadenas{

	/*=============================================
	EDITAR CADENA
	=============================================*/	

	public $idCadena;

	public function ajaxEditarCadena(){

		$item = "id";
		$valor = $this->idCadena;

		$respuesta = ControladorCadenas::ctrMostrarCadenas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CADENA
=============================================*/	
if(isset($_POST["idCadena"])){

	$cadena = new AjaxCadenas();
    $cadena -> idCadena = $_POST["idCadena"];
    $cadena -> ajaxEditarCadena();
}
