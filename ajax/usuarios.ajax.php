<?php
require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";
session_start();

class AjaxUsuarios{
	public $tabla = 'usuario';

	public function listar(){
		$respuesta = ModelUsuario::getAll('view_usuario'); 
		foreach ($respuesta as $key => $usuario) {
			$respuesta[$key]['nombre'] = ucfirst($respuesta[$key]['nombre']);
			$newDate = '';
			$date = strtotime($respuesta[$key]['ultimo_login']);
			if($date != false){
				$newDate = strftime('%a %d de %b del %Y a las %H:%M:%S', $date);
			}
			$respuesta[$key]['ultimo_login'] = $newDate;
		}
		return $respuesta;
	}

	public function agregar(){
		if(!empty($_POST)){
			$_POST['nombre'] = strtolower($_POST['nombre']);
			$_POST['email'] = strtolower($_POST['email']);
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$datosUsuario = ['email' => $_POST['email'], 'password' => $_POST['password'], 'perfil_id' => 1];
			$datosPersona = ['nombre' => $_POST['nombre']];

			if($datosUsuario['email'] == ModelUsuario::find($this->tabla, 'email', $datosUsuario['email'])['email']){
				return 'El usuario ya existe';
				exit;
			}
			$datosUsuario['persona_id'] = Model::insertGetId('persona', $datosPersona);
			$respuesta = ModelUsuario::insert($this->tabla, $datosUsuario);
			return $respuesta;

		}
	}

	public function editar(){
		if(!empty($_POST)){
			$personaId = $_POST['persona_id'];
			$datosUsuario = [
				"email" => strtolower($_POST['email']),
				"password" => $_POST['password'],
			];
			$datosPersona = ['nombre' => strtolower($_POST['nombre'])];


			$usuario = ModelUsuario::find($this->tabla, 'persona_id', $personaId);

			if($datosUsuario['password'] == ""){
				$datosUsuario['password'] = $usuario['password'];
			} else {
				$datosUsuario['password'] = password_hash($datosUsuario['password'], PASSWORD_DEFAULT);
			}

			$r1 = ModelUsuario::update('usuario', $datosUsuario, ['persona_id' => $personaId]);
			$r2 = ModelUsuario::update('persona', $datosPersona, ['id' => $personaId]);
			if($r1 && $r2)
				return true;
		}
	}

	public function eliminar(){
		if(!empty($_POST)){
			$id = $_POST['persona_id'];
			if($id == $_SESSION['usuario']['persona_id']){
				return "Error al eliminar usuario, usuario logueado";
				exit;
			}
			$respuesta = ModelUsuario::delete('persona', ['id' => $id]);	
			return $respuesta;
			
		}
	}

	public function cambiarEstado(){
		if(!empty($_POST)){
			$estado = $_POST['estado'];
			$persona_id = $_POST['persona_id'];

			if($persona_id == $_SESSION['usuario']['persona_id']){
				return "Error al desactivar usuario, usuario logueado";
			}

			if($estado == 'Y'){
				$respuesta = ModelUsuario::update($this->tabla, ['estado' => 'N'], ['persona_id' => $persona_id]);
			} else {
				$respuesta = ModelUsuario::update($this->tabla, ['estado' => 'Y'], ['persona_id' => $persona_id]);
			}
			return $respuesta;
		}
	}
}


/*================================================
=            ACCIONES DEL METODO POST            =
================================================*/

$usuario = new AjaxUsuarios();
switch ($_GET['action']) {
	case 'agregar':
	echo $usuario->agregar();
	break;
	
	case 'listar':
	$usuarios = $usuario->listar();
	$data['data'] = $usuarios;
	echo json_encode($data);
	break;

	case 'editar':
	echo $usuario->editar();
	break;

	case 'eliminar':
	echo $usuario->eliminar();
	break;

	case 'cambiar-estado':
	echo $usuario->cambiarEstado();
	break;
}

/*=====  End of ACCIONES DEL METODO POST  ======*/


