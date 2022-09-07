<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProducto(){

  	$item = "id_categoria";
  	$valor = $this->idCategoria;
    $orden = "id";

  	$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

  	echo json_encode($respuesta);

  }

  /*=============================================
  VALIDAR IMEI
  =============================================*/
  public function ajaxValidarImeiProducto()
  {

      $res = "";
      $valor = $this->idCategoria;

      try {

          $dbhost = 'duocell.myocitel.com';
          $dbname = 'fragata_duocell';
          $dbuser = 'powerbi';
          $dbpass = 'Fiscal2031';

          $dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass")
          or die('Could not connect: ' . pg_last_error());

          $query = "SELECT id_ref_doc_in FROM public.inv_inventario_serie where serie = $valor";
          $result = pg_query($query) or die('Error message: ' . pg_last_error());

          $final = pg_fetch_all($result);
          if ($final == null) {
              echo json_encode("NOINV"); //Imei no se encuentra registrado en inventario
              return;
          }

          $query2 = "SELECT * FROM public.inv_ingresobodega_xoc where id_ref_doc in (SELECT id_ref_doc_out FROM public.inv_inventario_serie where serie = $valor) and factura_id > 0";
          $result2 = pg_query($query2) or die('Error message: ' . pg_last_error());


          $final2 = pg_fetch_all($result2);

          if ($final2 != null) {
              echo json_encode("VENDID"); //Imei se encuentra fuera de inventario
              return;
          } else {
              echo json_encode("OK");
              return;
          }
          pg_close($dbconn);


      } catch (Exception $exception) {
          echo $exception;
      }


  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcion";
      $valor = $this->nombreProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else if(isset($this->opCadena)){
        if ($this-> opCadena  != ""){
            $item = "cod_duocell";
            $opCadena = $this->opCadena;
            $valor = $this->codCadena;

            $respuesta = ControladorProductos::ctrMostrarCodigoProductoPorCadena($item, $opCadena,  $valor);

            echo json_encode($respuesta);
        }

    }else{

      $item = "id";
      $valor = $this->idProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}


/*=============================================
VALIDAR IMEI DE PRODUCTO CON FRAGATA
=============================================*/	

if(isset($_POST["imei_prod"])){

	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["imei_prod"];
	$codigoProducto -> ajaxValidarImeiProducto();

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/

if(isset($_POST["idCategoria"])){

	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> ajaxCrearCodigoProducto();

}


/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}


/*=============================================
TRAER CODIGO DUOCELL PRODUCTO
=============================================*/

if(isset($_POST["opCadena"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> opCadena = $_POST["opCadena"];
  $traerProductos -> codCadena = $_POST["codCadena"];
  $traerProductos -> ajaxEditarProducto();

}






