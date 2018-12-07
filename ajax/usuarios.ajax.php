<?php
require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class AjaxUsuarios{
	public $idUsuario;
	public $tabla = 'usuario';
	public function find($campo, $valor){
		$respuesta = ModelUsuario::find($this->tabla, $campo, $valor);
		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}
	public function listar(){
		$respuesta = ModelUsuario::getAll($this->tabla); 
		return $respuesta;
	}
}

$usuario = new AjaxUsuarios();
switch ($_GET['action']) {
	case 'find':
	if(!empty($_POST['idUsuario'])){	
		$usuario->find('id', $_POST['idUsuario']);
	}
	break;
	
	case 'listar':
	$registros = $usuario->listar();
	$data = [
		"sEcho" => 1, //información para el datatable
		"data" => $registros
	];
	echo json_encode($registros);
	break;
}

