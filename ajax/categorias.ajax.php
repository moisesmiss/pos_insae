<?php
require_once "../models/categorias.model.php";
session_start();

class AjaxCategorias{
	public $tabla = 'categoria';

	public function listar(){
		$respuesta = Model::getAll('categoria');
		foreach ($respuesta as $key => $value) {
			$respuesta[$key]['nombre'] = ucfirst($respuesta[$key]['nombre']);
		}
		$data['data'] = $respuesta;

		return json_encode($data);	
	}

	public function agregar(){
		if(!empty($_POST)){
			$data = [
				"nombre" => strtolower($_POST['nombre']),
			];
			$respuesta = ModelCategorias::insert($this->tabla, $data);
			return $respuesta;
		}
	}

	public function editar(){
		if(!empty($_POST)){
			$data = [
				"nombre" => strtolower($_POST['nombre']),
			];
			$id = ["id" => $_POST['id']];
			$respuesta = ModelCategorias::update($this->tabla, $data, $id);
			return $respuesta;
		}
	}

	public function eliminar(){
		if(!empty($_POST)){
			$id = ['id' => $_POST['id']];
			$respuesta = ModelCategorias::delete($this->tabla, $id);
			return $respuesta;
		} 
	}

	

}

/*================================
=            ACCIONES            =
================================*/

$categoria = new AjaxCategorias();
switch ($_GET['action']) {
	case 'listar':
	echo $categoria->listar();
	break;

	case 'agregar':
	echo $categoria->agregar();
	break;

	case 'editar':
	echo $categoria->editar();
	break;

	case 'eliminar':
	echo $categoria->eliminar();
	break;
}

/*=====  End of ACCIONES  ======*/
