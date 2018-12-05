<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'modules/head.php' ?>
</head>


<?php if(isset($_SESSION['iniciarSesion']) and $_SESSION['iniciarSesion']): ?>
	<body class="hold-transition skin-blue sidebar-mini sidebar-collapse login-page">
		<!-- Site wrapper -->
		<div class="wrapper">
			<?php include 'modules/header.php' ?>
			<?php include 'modules/menu.php' ?>

			<?php 
		// PAGINAS DEL SISTEMA
			$paginas = scandir('views/paginas');
			unset($paginas[0]);
			unset($paginas[1]);
			$paginas = (
				array_map(
					function($paginas){
						return str_replace('.php', '', $paginas);
					}, 
					$paginas
				)
			); 
		// 
			if(isset($_GET['url'])){
				switch (in_array($_GET['url'], $paginas)) {
					case true:
					include "paginas/{$_GET['url']}.php";
					break;

					case false:
					include 'paginas/404.php';
					break;
				}
			} else {
				include 'paginas/inicio.php';
			}
			?>

			<?php include 'modules/footer.php' ?>
		</div>
		<!-- ./wrapper -->
		<script type="text/javascript" src="views/js/plantilla.js"></script>
	</body>
	<?php else: ?>
		<?php include 'paginas/login.php' ?>
	<?php endif; ?>



	</html>
