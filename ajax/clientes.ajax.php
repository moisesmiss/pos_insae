<?php  
require_once '../models/clientes.model.php';
session_start();

class AjaxClientes{
	public $tabla = 'cliente';

	public function agregar_editar(){
		if(!empty($_POST)){
			$data = [
				'nombre' => strtolower($_POST['nombre']),
				'correo' => $_POST['correo'],
				'fecha_nacimiento' => $_POST['fecha_nacimiento'],
				'telefono' => $_POST['telefono'],
				'direccion' => $_POST['direccion'],
			];
			if(empty($_POST['id'])){
				// AGREGAR	
				$id = ModelClientes::insertGetId('persona', $data);
				$respuestaQuery = ModelClientes::insert('cliente', ['persona_id' => $id]);
				if($respuestaQuery){
					$respuesta = ['respuesta' => true, 'mensaje' => 'Cliente agregado correctamente'];
				} else {
					$respuesta = ['respuesta' => false, 'mensaje' => 'Error al agergar cliente'];
				}
				return json_encode($respuesta);
			} else {
				// EDITAR
				$respuestaQuery = ModelClientes::update('persona', $data, ['id' => $_POST['id']]);
				if($respuestaQuery){
					$respuesta = ['respuesta' => true, 'mensaje' => 'Cliente editado correctamente'];
				} else {
					$respuesta = ['respuesta' => false, 'mensaje' => 'Erro al editar cliente'];
				}
				return json_encode($respuesta);
			}
		}
	}

	public function listar(){
		$respuesta = ModelClientes::getAll('view_cliente');
		$data['data'] = $respuesta;
		return json_encode($data);
	}

	public function eliminar(){
		$respuesta = ModelClientes::delete('persona', ['id' => $_POST['id']]);
		if($respuesta){
			$respuesta = ['respuesta' => true, 'mensaje' => 'Cliente eliminado correctamente'];
		} else {
			$respuesta = ['respuesta' => false,'mensaje' => 'Error al eliminar cliente'];
		}
		return json_encode($respuesta);
	}

}


/*================================
=            ACCIONES            =
================================*/
$clientes = new AjaxClientes;
switch ($_GET['action']) {
	case 'agregar_editar':
	echo $clientes->agregar_editar();
	break;

	case 'listar':
	echo $clientes->listar();
	break;

	case 'eliminar':
	echo $clientes->eliminar();
	break;
}

/*=====  End of ACCIONES  ======*/
