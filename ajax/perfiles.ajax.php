<?php
require_once "../models/perfiles.model.php";
session_start();

class AjaxPerfiles{
	public $tabla = 'perfil';

	public function listar(){
		$respuesta = Model::getAll('perfil');
		foreach ($respuesta as $key => $value) {
			$respuesta[$key]['nombre'] = ucfirst($respuesta[$key]['nombre']);
		}
		$data['data'] = $respuesta;

		return json_encode($data);
		
	}

	public function agregar(){
		if(!empty($_POST)){
			$datos['nombre'] = ucfirst($_POST['nombre']);

			if($datos['nombre'] == Model::find('perfil', 'nombre', $datos['nombre'])['nombre']){
				return "El perfil {$datos['nombre']} ya existe";
				exit;
			}

			return Model::insert('perfil', $datos);
		}
	}

	public function editar(){
		if(!empty($_POST)){
			$datos = ['nombre' => strtolower($_POST['nombre'])];
			$id = ['id' => $_POST['id']];
			return Model::update('perfil', $datos, $id);

		}
	}

	public function eliminar(){
		if(!empty($_POST)){
			$id = ['id' => $_POST['id']];

			return Model::delete('perfil', $id);
		}
	}

}

/*================================
=            ACCIONES            =
================================*/

$perfil = new AjaxPerfiles();
switch ($_GET['action']) {
	case 'listar':
	echo $perfil->listar();
	break;

	case 'agregar':
	echo $perfil->agregar();
	break;

	case 'editar':
	echo $perfil->editar();
	break;

	case 'eliminar':
	echo $perfil->eliminar();
	break;
}

/*=====  End of ACCIONES  ======*/
