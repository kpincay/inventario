<?php

require_once "../controladores/presupuestos.controlador.php";
require_once "../modelos/presupuestos.modelo.php";

class AjaxPresupuestos{

	/*=============================================
	EDITAR Presupuesto
	=============================================*/	

	public $idPresupuesto;

	public function ajaxEditarPresupuesto(){

		$item = "id";
		$idPresupuesto = $this->idPresupuesto;

        $valorPresupuesto = $this->valorPresupuesto;
		
		$respuesta = ControladorPresupuestos::ctrEditarPresupuestos($idPresupuesto, $valorPresupuesto);

		echo json_encode($respuesta);


	}

	public function ajaxMostrarPresupuesto(){

		$item = "id";
		$idCadena = $this->idCadena;
		$fechaDesde = $this->fechaDesde;
		$fechaHasta = $this->fechaHasta;

        $valorPresupuesto = $this->valorPresupuesto;

		$respuesta = ControladorPresupuestos::ctrConsultarPresupuestos($idCadena, $fechaDesde, $fechaHasta);

		echo json_encode($respuesta);

	}

	public function ajaxGenerarPresupuestos(){

		$item = "id";
		$valor = $this->idPresupuesto;

        $idCadena = $this->idCadena;
        $fecha = $this->fecha;

		$respuesta = ControladorPresupuestos::ctrGenerarPresupuestosPorCadenas($idCadena, $fecha);

		echo json_encode($respuesta);


	}
    public function ajaxConsultarPresupuestos(){

		$item = "id_cadena";
        $valor = null;
        $respuesta = null;
        if (isset($this->idPresupuesto)){
            $valor = $this->idPresupuesto;
            $respuesta = ControladorPresupuestos::ctrMostrarPresupuestosPorCadenas($item, $valor);

            echo json_encode($respuesta);
        }else{
            $cadena = $this->cadena;
            $fechaDesde = $this->fechaDesde;
            $fechaHasta = $this->fechaHasta;
            $respuesta = ControladorPresupuestos::ctrMostrarPresupuestos($cadena, $fechaDesde, $fechaHasta);

            echo json_encode($respuesta);
        }

	}

}

/*=============================================
EDITAR Presupuesto
=============================================*/


if(isset($_POST["idPresupuesto"])){

	$cadena = new AjaxPresupuestos();
	$cadena -> idPresupuesto = $_POST["idPresupuesto"];
	$cadena -> valorPresupuesto = $_POST["valorPresupuesto"];
	$cadena -> ajaxEditarPresupuesto();

}else if(isset($_POST["metodo"])) {

    $cadena = new AjaxPresupuestos();
    $cadena -> idCadena = $_POST["idCadena"];
    $cadena -> fecha = $_POST["fecha"];
    $cadena -> ajaxGenerarPresupuestos();
}else{
    $cadena = new AjaxPresupuestos();
    $cadena -> cadena = $_POST["cadena"];
    $cadena -> fechaDesde = $_POST["fechaDesde"];
    $cadena -> fechaHasta = $_POST["fechaHasta"];
    $cadena -> ajaxConsultarPresupuestos();
}