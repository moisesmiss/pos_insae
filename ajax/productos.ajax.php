<?php
require_once "../models/productos.model.php";
session_start();

function resizeImage($original_image_data, $original_width, $original_height, $new_width, $new_height)
{
    $dst_img = ImageCreateTrueColor($new_width, $new_height);
    imagecolortransparent($dst_img, imagecolorallocate($dst_img, 0, 0, 0));
    imagecopyresampled($dst_img, $original_image_data, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
    return $dst_img;
}

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
		// var_dump($_POST);
		if(!empty($_POST)){
			if($_FILES['imagen']['size'] != 0){
				// var_dump($_FILES);
				//subir imagen al servidor
				list($ancho, $alto) = getimagesize($_FILES['imagen']['tmp_name']);
				$extension = pathinfo($_FILES['imagen']['name'])['extension'];
				$filename = pathinfo($_FILES['imagen']['name'])['filename'];
				$rutaTemporal = $_FILES['imagen']['tmp_name'];
				$ruta = "../views/img/productos/";

				$fecha = date('Y-m-d H.i.s ');
				$nombreImagenDestino = $fecha.md5($filename).".".$extension;
				$rutaDestino = $ruta.$nombreImagenDestino;

				$nuevoAncho = $_POST['x2'] - $_POST['x1'];
				$nuevoAlto = $_POST['y2'] - $_POST['y1'];

				if($_FILES['imagen']['type'] == 'image/jpeg'){
					$origen = imagecreatefromjpeg($rutaTemporal);
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresampled($destino, $origen, 0, 0, $_POST['x1'], $_POST['y1'], $ancho, $alto, $ancho, $alto);
					imagejpeg($destino, $rutaDestino);
				}	
				// fin subir imagen		
			}

			$data = [
				"codigo" => $_POST['codigo'],
				"nombre" => strtolower($_POST['nombre']),
				"descripcion" => $_POST['descripcion'],
				"imagen" => $nombreImagenDestino ?? '',
				"precio_compra" => $_POST['precio_compra'],
				"precio_venta" => $_POST['precio_venta'],
				"stock" => $_POST['stock'],
				"categoria_id" => !empty($_POST['categoria_id']) ? $_POST['categoria_id'] : null,
			];

			if(empty($_POST['id'])){
				$respuesta = ModelProductos::insert($this->tabla, $data);
				if($respuesta){
					$respuesta = [
						'respuesta' => $respuesta, 
						'mensaje' => 'Producto agregado correctamente'
					];
				} else {
					$respuesta = [
						'respuesta' => false, 
						'mensaje' => 'Error al agregar producto'
					];
				}
			} else {
				if(empty($data['imagen'])){
					$data['imagen'] = ModelProductos::find($this->tabla, 'id', $_POST['id'])['imagen'];
				}
				$respuesta = ModelProductos::update($this->tabla, $data, ['id' => $_POST['id']]);
				if($respuesta){
					$respuesta = [
						'respuesta' => $respuesta, 
						'mensaje' => 'Pruducto editado correctamente'
					];
				} else {
					$respuesta = [
						'respuesta' => false, 
						'mensaje' => 'Error al editar producto'
					];
				}
			}
			return json_encode($respuesta);
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

	public function eliminar(){
		if(!empty($_POST)){
			$id = ['id' => $_POST['id']];
			$respuesta = ModelProductos::delete($this->tabla, $id);
			return $respuesta;
		} 
	}

	

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

	case 'eliminar':
	echo $producto->eliminar();
	break;
}

/*=====  End of ACCIONES  ======*/