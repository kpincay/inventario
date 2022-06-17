<?php

require_once "conexion.php";

class ModeloSellOut{

    /*=============================================
    CREAR SellOut
    =============================================*/

    static public function mdlIngresarSellOut($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO duobalsacom_promotores.sell_out (fecha, ciudad, tienda, codigo, descripcion, cadena, cantidad, codigo_duocell, proveedor) VALUES (:fecha, :ciudad, :tienda, :codigo, :descripcion, :cadena, :cantidad, :codigo_duocell, :proveedor)");

        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":tienda", $datos["tienda"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cadena", $datos["cadena"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo_duocell", $datos["codigoDuocell"], PDO::PARAM_STR);
        $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

}