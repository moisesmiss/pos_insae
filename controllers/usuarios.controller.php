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
				$_SESSION['usuario'] = $usuario;

				ModelUsuario::actualizarUltimoLogin(
					$this->tabla, 
					'persona_id',
					$usuario['persona_id']
				);
				echo "<script>window.location = 'inicio' </script>";
				echo "Datos correctos";
			} else {
				echo "datos incorrectos";
			}
		}
	}
}