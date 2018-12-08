<?php
require_once 'conexion.php';
require_once 'Model.php';

class ModelUsuario extends Model{
	public function login($tabla, $campo, $valor){
		$sql = "select * from $tabla where $campo = :$campo and activo = 'Y'";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->bindParam(":$campo", $valor);
		$declaracion->execute();
		return $declaracion->fetch(PDO::FETCH_ASSOC);
	}

	public function actualizarUltimoLogin($tabla, $campo, $valor){
		$sql = "update usuario set ultimo_login = curtime() where $campo = $valor";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->bindParam(":$campo", $valor);
		return $declaracion->execute();
	}
}