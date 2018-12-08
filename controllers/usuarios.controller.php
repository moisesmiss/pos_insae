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
			$campo = 'email';
			$valor = strtolower($_POST['ingUsuario']);

			$usuario = ModelUsuario::login('view_usuario', $campo, $valor);

			if(password_verify($_POST['ingPassword'], $usuario['password'])){
					// session_start();
				$_SESSION['usuario'] = $usuario;

				ModelUsuario::actualizarUltimoLogin(
					$this->tabla, 
					'id',
					$usuario['id']
				);
				echo "<script>window.location = 'inicio' </script>";
				echo "Datos correctos";
			} else {
				var_dump($usuario);
				echo "datos incorrectos";
			}
		}
	}
}