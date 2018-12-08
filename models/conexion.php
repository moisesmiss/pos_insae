<?php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
class Conexion{
	public function conectar(){
		return new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', '');
	}
}