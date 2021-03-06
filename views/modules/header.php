<?php 
$configuracion = Model::getAll('configuracion')[0];
?>
<header class="main-header">
	<!--==============================
	=            LOGOTIPO            =
	===============================-->
	<a href="inicio" class="logo">
		<!-- logo mini -->
		<span class="logo-mini">
			<i class="fa fa-shopping-cart"></i>
		</span>

		<span class="logo-lg">
			<span><?= $configuracion['nombre_corto_empresa'] ?? 'POS' ?> </span>
			<i class="fa fa-shopping-cart"></i>
		</span>
	</a>
	<!--====  End of LOGOTIPO  ====-->

	<!--=========================================
	=            BARRA DE NAVEGACION            =
	==========================================-->
	<nav class="navbar navbar-static-top">
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			
		</a>

		<!-- PERFIL USUARIO -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="views/img/plantilla/img-user.png" class="user-image">
						<span class="hidden-xs">Usuario: <?= ucwords($_SESSION['usuario']['nombre']) ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="views/img/plantilla/img-user.png" class="img-circle">
							<p><?= ucwords($_SESSION['usuario']['nombre']) ?></p>
							<p><?= $_SESSION['usuario']['email'] ?></p>
						</li>
						<li class="user-footer">
							<div class="pull-right">
								<a href="salir" class="btn btn-default btn-flat">Salir</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>

		
	</nav>
	
	
	<!--====  End of BARRA DE NAVEGACION  ====-->
	
	
</header>