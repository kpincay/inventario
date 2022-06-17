<?php

require_once "../controladores/sell-out.controlador.php";
require_once "../modelos/sell-out.modelo.php";

class AjaxSellOut{

	/*=============================================
	EDITAR CADENA
	=============================================*/	

	public $idCadena;

	public function ajaxAgregarSellOut(){

		$fecha = $this->fecha;
		$ciudad = $this->ciudad;
		$tienda = $this->tienda;
		$codigo = $this->codigo;
        $descripcion = $this->descripcion;
		$cadena = $this->cadena;
		$cantidad = $this->cantidad;
		$codigo_duocell = $this->codigo_duocell;
        $proveedor = $this->proveedor;

		$respuesta = ControladorSellOut::ctrCrearSellOut($fecha,  $ciudad,  $tienda,  $codigo,  $descripcion, $cadena,  $cantidad,  $codigo_duocell, $proveedor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CADENA
=============================================*/	
if(isset($_POST["codigo_duocell"])){

	$sellout = new AjaxSellOut();
    $sellout -> fecha = $_POST["fecha"];
    $sellout -> ciudad = $_POST["ciudad"];
    $sellout -> tienda = $_POST["tienda"];
    $sellout -> codigo = $_POST["codigo"];
    $sellout -> descripcion = $_POST["descripcion"];
    $sellout -> cadena = $_POST["cadena"];
    $sellout -> cantidad = $_POST["cantidad"];
    $sellout -> codigo_duocell = $_POST["codigo_duocell"];
    $sellout -> proveedor = $_POST["proveedor"];
    $sellout -> ajaxAgregarSellOut();

}
