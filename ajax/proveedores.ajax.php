<?php 
require_once '../models/conexion.php';
require_once '../models/Model.php';

class AjaxProveedores extends Model{
	public function listar(){
		$resultado['data'] = self::getAll('view_proveedor');
		return json_encode($resultado);
	}

	public function agregarEditar(){
		$datosPersona = [
			'nombre' => $_POST['nombre'],
			'correo' => $_POST['correo'],
			'fecha_nacimiento' => $_POST['fecha_nacimiento'],
			'telefono' => $_POST['telefono'],
			'rfc' => $_POST['rfc'],
			'direccion' => $_POST['direccion'],
		];
		if(empty($_POST['id'])){

			$idPersona = self::insertGetId('persona', $datosPersona);
			$resultado = self::insert('proveedor', ['persona_id' => $idPersona]);
			if($resultado){
				$respuesta = ['respuesta' => true, 'mensaje' => 'Proveedor agregado correctamente'];
			}
		} else {
			$resultado = self::update('persona', $datosPersona, ['id' => $_POST['id']]);
			if($resultado){
				$respuesta = ['respuesta' => true, 'mensaje' => 'Proveedor editado correctamente'];
			}
		}
		return json_encode($respuesta);
	}

	public function eliminar(){
		$id = $_POST['id'];

		$resultado = self::delete('persona', ['id' => $id]);
		if($resultado){
			$respuesta = ['respuesta' => true, 'mensaje' => 'Proveedor Eliminado correctamente'];
		}
		return json_encode($respuesta);

	}
}

switch ($_GET['action']) {
	case 'listar':
	echo AjaxProveedores::listar();
	break;
	case 'agregar-editar':
	echo AjaxProveedores::agregarEditar();
	break;
	case 'eliminar':
	echo AjaxProveedores::eliminar();
	break;
}