<?php

require_once "../controladores/tiendas.controlador.php";
require_once "../modelos/tiendas.modelo.php";

class AjaxTiendas{

	/*=============================================
	EDITAR TIENDA
	=============================================*/	

	public $idTienda;

	public function ajaxEditarTienda(){

		$item = "id";
		$valor = $this->idTienda;

		
		$respuesta = ControladorTiendas::ctrMostrarTiendas($item, $valor);

		echo json_encode($respuesta);


	}
    public function ajaxConsultarTiendas(){

		$item = "id_cadena";
        $valor = null;
        $respuesta = null;
        if (isset($this->idTienda)){
            $valor = $this->idTienda;
            $respuesta = ControladorTiendas::ctrMostrarTiendas($item, $valor);

            echo json_encode($respuesta);
        }else{
            $valor = $this->cadena;
            $respuesta = ControladorTiendas::ctrMostrarTiendasPorCadenas($item, $valor);

            echo json_encode($respuesta);
        }




	}

}

/*=============================================
EDITAR TIENDA
=============================================*/	

if(isset($_POST["idTienda"])){

	$cadena = new AjaxTiendas();
	$cadena -> cadena = $_POST["idTienda"];
	$cadena -> ajaxEditarTienda();

}else {

    $cadena = new AjaxTiendas();
    $cadena -> cadena = $_POST["idCadena"];
    $cadena -> ajaxConsultarTiendas();
}