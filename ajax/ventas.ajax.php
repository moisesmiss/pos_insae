<?php
error_reporting(0);
require_once "../models/ventas.model.php";
require __DIR__ . '/../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
session_start();

class AjaxVenta{
	//agrega la venta, detalle de la venta y actualiza el stock de los productos
	public function imprimirTicket($vendedor, $cliente, $productos, $neto, $impuesto, $total){
	//Este ejemplo imprime un hola mundo en una impresora de tickets en Windows. La impresora debe estar instalada como genérica y debe estar compartida
		$nombre_impresora = "impresoratermica"; 
		$connector = new WindowsPrintConnector($nombre_impresora);
		$printer = new Printer($connector);

		// try{
		// 	$logo = EscposImage::load("../views/img/plantilla/imgTicket.jpg", false);
		// 	$printer->bitImage($logo);
		// }catch(Exception $e){/*No hacemos nada si hay error*/}
		$printer->text("Vendedor: $vendedor \n");
		$printer->text("Cliente: $cliente \n");
		$printer->text("Fecha: ".date('d/m/Y H:i:s')."\n\n");

		foreach ($productos as $producto) {
			/*Alinear a la izquierda para la cantidad y el nombre*/
			$nombreProducto = Model::find('producto', 'id', $producto['producto_id'])['nombre'];
			// $printer->setJustification(Printer::JUSTIFY_LEFT);
			$printer->text($producto['cantidad'] . " x " . $nombreProducto . "\n");

			/*Y a la derecha para el importe*/
			// $printer->setJustification(Printer::JUSTIFY_RIGHT);
			$printer->text(' $' . number_format($producto['subtotal'], 2) . "\n");
		}
		$printer->text("Neto: $".number_format($neto, 2)."\n");
		$printer->text("IVA: $impuesto% \n\n");
		$printer->text("--------\n");
		$printer->text("Total: $".number_format($total, 2)."\n\n");
		$printer->text("Gracias por su compra");

		$printer->feed(3);
		$printer->cut();
		$printer->pulse();
		$printer->close();
	}
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

		$vendedor = Model::find('view_usuario', 'persona_id', $datos[0]['vendedor_id'])['nombre'];
		$cliente = Model::find('view_cliente', 'id', $datos[0]['cliente_id'])['nombre'];
		$productos = $datos[1];
		$neto = $datos[0]['neto'];
		$impuesto = $datos[0]['impuesto'];
		$total = $datos[0]['total'];
		self::imprimirTicket($vendedor, $cliente, $productos, $neto, $impuesto, $total);
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