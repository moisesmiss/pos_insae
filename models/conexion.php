<?php
class Conexion{
	public function conectar(){
		return new PDO('mysql:host=localhost;dbname=pos_insae;charset=utf8', 'root', '');
	}
}