<?php

require_once "conexion.php";

class ModeloPresupuestosM{

	/*=============================================
	CREAR Presupuesto
	=============================================*/

	static public function mdlIngresarPresupuesto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cadena, nombre, ciudad, email, telefono, direccion, fecha_registro) VALUES (:id_cadena, :nombre, :ciudad, :email, :telefono, :direccion, :fecha_registro)");

		$stmt->bindParam(":id_cadena", $datos["id_cadena"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_registro", $datos["fecha_registro"], PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PresupuestoS
	=============================================*/

	static public function mdlMostrarPresupuestos($tabla, $cadena, $fechaDesde,$fechaHasta){

		if($cadena != null){
            try {
                $pdo = new PDO("mysql:dbname=duobalsacom_promotores;host=localhost", "root", "");
            } catch ( PDOException $e ) {
                die ( $e->getMessage() );
            }

            $sql = "SELECT DISTINCT(fecha) FROM $tabla where fecha between '$fechaDesde' and '$fechaHasta' order  by fecha;";
            $endPoints = $pdo->query($sql, PDO::FETCH_COLUMN,0)->fetchAll();


            $templateSQL = "SUM(
                            CASE
                              WHEN fecha = '|ENDPOINT|'
                               THEN valor
                               ELSE 0
                            END
                        ) as '|ENDPOINT|',
                        SUM(
                            CASE
                              WHEN fecha = '|ENDPOINT|'
                               THEN id
                               ELSE 0
                            END
                        ) as '|ENDPOINT|_id'";

            $endPointsSQL = implode( ",".PHP_EOL, array_map( function( $endPoint ) use ( $templateSQL ) {
                return preg_replace( '/\|ENDPOINT\|/', $endPoint, $templateSQL ) ;
            }, $endPoints ) );
            $finalSQL = "select id, tienda, promotor,
            $endPointsSQL
            FROM presupuestos 
            where cadena = '$cadena'   
            GROUP BY tienda
            ;";

            $endP = $pdo->query($finalSQL)->fetchAll();
            return $endP;

		}else{

			$stmt = Conexion::conectar()->prepare("select cadena , sum(valor) as presupuesto  from presupuestos p group by cadena order by cadena");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Presupuesto
	=============================================*/

	static public function mdlEditarPresupuesto($idPresupuesto, $valor){
		$stmt = Conexion::conectar()->prepare("UPDATE presupuestos SET valor = $valor WHERE id = $idPresupuesto");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	CONSULTAR Presupuesto
	=============================================*/

	static public function mdlConsultarPresupuesto($cadena, $fechaDesde, $fechaHasta){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM presupuestos WHERE cadena = $cadena and fecha BETWEEN '$fechaDesde' and '$fechaHasta'");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR Presupuesto
	=============================================*/

	static public function mdlEliminarPresupuesto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR Presupuesto
	=============================================*/

	static public function mdlActualizarPresupuesto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR Presupuesto
	=============================================*/

	static public function mdlGenerarPresupuesto($idCadena, $fecha){

        try {
            $pdo = new PDO("mysql:dbname=duobalsacom_promotores;host=localhost", "root", "");
        } catch ( PDOException $e ) {
            die ( $e->getMessage() );
        }

        $sql = "SELECT * FROM presupuestos p   where cadena = (select nombre from cadenas c where id = $idCadena)  and fecha = '$fecha';";
        $respuesta = $pdo->query($sql)->fetchAll();

        if ($respuesta != []){
            return "Registros ya generados previamente para la fecha  $fecha";
        }

        $stmt = Conexion::conectar()->prepare("CALL obtenerTiendasPorCadenaM($idCadena, '$fecha');");


		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

}