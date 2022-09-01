<?php


class Conexion_postgres{

    static public function conectarP(){

//		$link = new PDO("mysql:host=localhost;dbname=duobalsacom_promotores",
//			            "root",
//			            "");

        $link = pg_connect("host=duocell.myocitel.com port=5432 dbname=fragata_duocell user=powerbi password=Fiscal2031");
        if (!$link)
        {
            $result["result"] = 0;
            $result["error"] = 'Ocurrio un error en la conexion!!';
            echo json_encode($result);
            exit;
        }

        return $link;

    }

}
