<?php
require_once "../models/productos.model.php";
session_start();

class AjaxCategorias{
	public $tabla = 'producto';

	public function listar(){
		$productos = ModelProductos::getAll('view_producto');
		foreach ($productos as $key => $value) {
			$productos[$key]['nombre'] = ucfirst($productos[$key]['nombre']);
		}
		$data['data'] = $productos;

		return json_encode($data);	
	}

	public function agregar(){
		if(!empty($_POST)){
			$data = [
				"codigo" => $_POST['codigo'],
				"nombre" => strtolower($_POST['nombre']),
				"descripcion" => $_POST['descripcion'],
				"imagen" => '',
				"precio_compra" => $_POST['precio_compra'],
				"precio_venta" => $_POST['precio_venta'],
				"stock" => $_POST['stock'],
				"categoria_id" => $_POST['categoria_id'],
			];
			$respuesta = ModelProductos::insert($this->tabla, $data);
			return $respuesta;
		}
	}

	// public function editar(){
	// 	if(!empty($_POST)){
	// 		$data = [
	// 			"nombre" => strtolower($_POST['nombre']),
	// 		];
	// 		$id = ["id" => $_POST['id']];
	// 		$respuesta = ModelCategorias::update($this->tabla, $data, $id);
	// 		return $respuesta;
	// 	}
	// }

	// public function eliminar(){
	// 	if(!empty($_POST)){
	// 		$id = ['id' => $_POST['id']];
	// 		$respuesta = ModelCategorias::delete($this->tabla, $id);
	// 		return $respuesta;
	// 	} 
	// }

	

}

/*================================
=            ACCIONES            =
================================*/

$producto = new AjaxCategorias();
switch ($_GET['action']) {
	case 'listar':
	echo $producto->listar();
	break;

	case 'agregar':
	echo $producto->agregar();
	break;

	// case 'editar':
	// echo $categoria->editar();
	// break;

	// case 'eliminar':
	// echo $categoria->eliminar();
	// break;
}

/*=====  End of ACCIONES  ======*/
