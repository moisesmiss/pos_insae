<?php 
include_once '../models/conexion.php';
include_once '../models/Model.php';

class AjaxCompras extends Model{
	public function listar(){
		$respuesta['data'] = Model::getAll('view_compra');
		return json_encode($respuesta);
	}

	public function listarPorFecha(){
		$inicio = $_GET['fechaInicio'];
		$fin = $_GET['fechaFin'];
		$respuesta['data'] = self::query("select * from view_compra where fecha_sin_formato between cast('$inicio' as date) and date_add(cast('$fin' as date), interval 1 day);");
		return json_encode($respuesta);
	}

	public function agregar(){
		// var_dump($_POST);
		if(!empty($_POST)){
			$datosCompra = $_POST['data'][0];
			$productos = $_POST['data'][1];

			$idCompra = self::insertGetId('compra', $datosCompra);


			foreach ($productos as $producto) {
				$producto['compra_id'] = $idCompra;
				$resultado = self::insert('detalle_compra', $producto);

				//afectar stock, subir la cantidad que se compro
				$stockActual = self::find('producto', 'id', $producto['producto_id'])['stock'];
				$nuevoStock = $stockActual + $producto['cantidad'];
				self::update('producto', ['stock' => $nuevoStock], ['id' => $producto['producto_id']]);
			}
			if($resultado){
				$respuesta = ['respuesta' => true, 'mensaje' => 'Compra finalizada con exito'];
			} else {
				$respuesta = ['respuesta' => false, 'mensaje' => 'Error al crear la compra'];
			}
			return json_encode($respuesta);

		}
	}

	public function obtenerProductos(){
		if(!empty($_GET['proveedor_id'])){

			$proveedor_id = $_GET['proveedor_id'];
			$respuesta['data'] = self::query("select * from view_producto where proveedor_id = {$proveedor_id}");
		} else {
			$respuesta['data'] = self::query("select * from view_producto");
		}
		return json_encode($respuesta);
	}
}

switch ($_GET['action']) {
	case 'obtener-productos':
	echo AjaxCompras::obtenerProductos();
	break;
	case 'agregar':
	echo AjaxCompras::agregar();
	break;
	case 'listar':
	echo AjaxCompras::listar();
	break;
	case 'listarPorFecha':
	echo AjaxCompras::listarPorFecha();
	break;
}