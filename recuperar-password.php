<?php
include 'models/conexion.php';
include 'models/Model.php';

//Método con str_shuffle() 
function generateRandomString($length = 10) { 
	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
}

if(isset($_POST['email'])){
	$usuario = Model::find('usuario', 'email', $_POST['email']);
	if(!empty($usuario)){
		$id = $usuario['persona_id'];
		$token = md5(generateRandomString());

		$respuesta = Model::update('usuario', ['token' => $token], ['persona_id' => $id]);

		$link = 'http://localhost/school-projects/pos-insae/recuperar-password.php?token='.$token;

		//datos para enviar el correo electronico
		$para = $_POST['email'];
		$titulo = 'Restablecer contraseña';

		// mensaje
		$mensaje = '
		<html>
		<head>
		<title>Restablecer contraseña</title>
		</head>
		<body>
		<p>Para cambiar tu contraseña por una nueva da <a href="'.$link.'">click aqui</a></p>
		</body>
		</html>
		';

		// Para enviar un correo HTML, debe establecerse la cabecera Content-type
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Enviarlo
		mail($para, $titulo, $mensaje, $cabeceras);
		echo "<script>window.location ='index.php'</script>";
	} else {
		echo "<script>alert('Usuario no registrado, por favor comprueba el correo')</script>";
	}

}

if(isset($_GET['token'])){
	$usuario = Model::find('usuario', 'token', $_GET['token']);
	if(isset($_POST['nuevaPassword'])){
		$respuesta = Model::update('usuario', ['password' => password_hash($_POST['nuevaPassword'] ,PASSWORD_DEFAULT), 'token' => ''], ['persona_id' => $usuario['persona_id']]);
		if($respuesta){
			echo "<script>window.location='index.php'</script>";
		}
	}
}
?>

<?php if(!isset($_GET['token'])): ?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Recuperar contraseña</title>
		<style type="text/css">
		*{
			font-family: sans-serif;
		}
		form{
			text-align: center;
			margin: 30px auto 0;
			width: 500px;
			max-width: 95%;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		form input{
			padding: .5rem;
			margin-bottom: 1rem;
			width: 100%;
		}
		form button{
			padding: .5rem;
			background: #2196F3;
			color: white;
			border: none;
			width: 25%;
		}
		form button:hover{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<form method="post">
		<h4>Ingresa tu correo para restablecer tu contraseña</h4>
		<input type="email" name="email">
		<button type="submit">Aceptar</button>
	</form>
</body> 
</html>
<?php elseif(isset($_GET['token']) && isset($usuario)): ?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Recuperar contraseña</title>
		<style type="text/css">
		*{
			font-family: sans-serif;
		}
		form{
			text-align: center;
			margin: 30px auto 0;
			width: 500px;
			max-width: 95%;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		form input{
			padding: .5rem;
			margin-bottom: 1rem;
			width: 100%;
		}
		form button{
			padding: .5rem;
			background: #2196F3;
			color: white;
			border: none;
			width: 25%;
		}
		form button:hover{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<form method="post">
		<h4>Nueva contraseña para el usuario <?= $usuario['email'] ?></h4>
		<input type="password" name="nuevaPassword">
		<button type="submit">Cambiar contraseña</button>
	</form>
</body> 
</html>
<?php endif; ?>