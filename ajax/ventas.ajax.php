<?php
require_once "../models/ventas.model.php";
session_start();

class AjaxVenta{
	//agrega la venta, detalle de la venta y actualiza el stock de los productos
	public function agregar(){
		$datos = $_POST['data'];
		$datos[0]['cliente_id'] = ($datos[0]['cliente_id'] != '') ? $datos[0]['cliente_id'] : null;
		$venta_id = ModelVentas::insertGetId('venta', $datos[0]);
		foreach ($datos[1] as $producto) {
			$producto['venta_id'] = $venta_id;
			$respuesta = ModelVentas::insert('detalle_venta', $producto);
			if($respuesta){
				$productoStock = Model::find('producto', 'id', $producto['producto_id'])['stock'];
				$nuevoStock = $productoStock - $producto['cantidad'];
				$declaracion = Model::update('producto', ['stock' => $nuevoStock], ['id' => $producto['producto_id']]);
			}
		}
		if($declaracion){
			$respuesta = ['respuesta' => true, 'mensaje' => 'Venta completada'];
		} else {
			$respuesta = ['respuesta' => false, 'mensaje' => 'Error al agregar venta'];
		}
		return json_encode($respuesta);

	}

	public function listar(){
		$respuesta['data'] = Model::getAll('view_venta');
		return json_encode($respuesta);
	}

	public function listarPorFecha(){
		$inicio = $_GET['fechaInicio'];
		$fin = $_GET['fechaFin'];
		$respuesta['data'] = Model::query("select * from view_venta where fecha_sin_formato between cast('$inicio' as date) and date_add(cast('$fin' as date), interval 1 day);");
		return json_encode($respuesta);
	}
}


$venta = new AjaxVenta;
switch ($_GET['action']) {
	case 'agregar':
	echo $venta->agregar();
	break;
	case 'listar':
	echo $venta->listar();
	break;
	case 'listarPorFecha':
	echo $venta->listarPorFecha();
}