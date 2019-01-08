<?php
class Model{
	public function query($sql){
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->execute();
		return $declaracion->fetchAll();
	}
	public function find($tabla, $campo, $valor){
		$sql = "select * from $tabla where $campo = :$campo";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->bindParam(":$campo", $valor, PDO::PARAM_STR);
		$declaracion->execute();
		return $declaracion->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($tabla, $datos){
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

	public function insertGetId($tabla, $datos){
		$conexion = Conexion::conectar();
		$campos = implode(', ', array_keys($datos));
		$camposParam = implode(", :", array_keys($datos));

		$sql = "insert into $tabla($campos) values (:$camposParam)";
		$declaracion = $conexion->prepare($sql);
		foreach ($datos as $key => &$value) {
			$declaracion->bindParam(":$key", $value);
		}
		if($declaracion->execute()){
			return $conexion->lastInsertId();
		} else {
			return $sql;
		}
	}

	public function getAll($tabla){
		$sql = "select * from $tabla";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->execute();
		return $declaracion->fetchAll();
	}

	function update($tabla, $datos, $where){
		$actualizarDatos = '';
		foreach ($datos as $key => $value) {
			$actualizarDatos .= "$key = :$key, ";
		}
		$actualizarDatos = trim($actualizarDatos, ', ');

		$campo = array_keys($where)[0];
		$valor = array_values($where)[0];

		$sql = "update {$tabla} set $actualizarDatos where $campo = '$valor'";
		$declaracion = Conexion::conectar()->prepare($sql);
		foreach ($datos as $key => $value) {
			$declaracion->bindValue(":$key", $value);
		}
		return $declaracion->execute();
	}

	function delete($tabla, $where){
		$campo = array_keys($where)[0];
		$valor = array_values($where)[0];

		$sql = "delete from $tabla where $campo = :$campo";
		$declaracion = Conexion::conectar()->prepare($sql);
		$declaracion->bindParam(":$campo", $valor);
		return $declaracion->execute();
	}
}