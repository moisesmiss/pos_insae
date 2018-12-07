<?php
class Model{
	public function find($tabla, $campo, $valor){
		$sql = "select * from $tabla where $campo = :$campo";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->bindParam(":$campo", $valor, PDO::PARAM_STR);
		$declaracion->execute();
		return $declaracion->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($tabla, $datos){
		$datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
		$campos = implode(', ', array_keys($datos));
		$camposParam = implode(", :", array_keys($datos));

		$sql = "insert into $tabla($campos) values (:$camposParam)";
		$declaracion = Conexion::conectar()->prepare($sql);
		foreach ($datos as $key => &$value) {
			$declaracion->bindParam(":$key", $value);
		}
		
		/**
		 * arroja true si se añadieron los datos a la db o false si no
		 * @var [boolean]
		 */
		return $declaracion->execute();
	}

	public function getAll($tabla){
		$sql = "select * from $tabla";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->execute();
		return $declaracion->fetchAll();
	}
}