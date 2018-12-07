<?php
class ControllerUsuarios{
	public $alert;
	public $tabla = 'usuario';


	public function find($campo, $valor){
		$usuario = ModelUsuario::find($this->tabla, $campo, $valor);
		return $usuario;
	}

	public function ctrIngresoUsuario(){
		if(!empty($_POST)){
			if(preg_match("/^[a-zA-Z0-9]+$/", $_POST['ingUsuario']) && preg_match("/^[a-zA-Z0-9]+$/", $_POST['ingPassword'])){
				$campo = 'usuario';
				$valor = $_POST['ingUsuario'];

				$usuario = ModelUsuario::find($this->tabla, $campo, $valor);

				if(password_verify($_POST['ingPassword'], $usuario['password'])){
					// session_start();
					$_SESSION['usuario'] = $usuario;
					echo "<script>window.location = 'inicio' </script>";
					echo "Datos correctos";
				} else {
					echo "datos incorrectos";
				}


			}
		}
	}

	public function ctrCrearUsuario(){
		if(!empty($_POST['usuario'])){
			$datos = $_POST; 

			$respuesta = ModelUsuario::insert($this->tabla, $datos);
			if($respuesta){
				$this->alert = 'success';
			} else {
				$this->alert = 'error';
			}
		}
	}

	public function getAll(){
		$datos = ModelUsuario::getAll($this->tabla);
		return $datos;
	}
}