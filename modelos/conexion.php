<?php


class Conexion{

	static public function conectar(){

//		$link = new PDO("mysql:host=localhost;dbname=duobalsacom_promotores",
//			            "root",
//			            "");

            $link = new PDO("mysql:host=62.171.142.124;dbname=duobalsacom_promotores",
            "flotapps",
            "BDFlotapps.21");

		$link->exec("set names utf8");

		return $link;

	}

}