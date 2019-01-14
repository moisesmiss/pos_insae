<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li><a href="inicio"><i class="fa fa-home"></i><span> Inicio</span></a></li>
			<!-- <li class="treeview">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li><a href="usuarios"><i  class="fa fa-circle-o"></i><span> Usuarios</span></a></li>
					<!-- <li><a href="perfiles"><i  class="fa fa-circle-o"></i><span> perfiles</span></a></li>
					<!-- <li><a href="reportes"><i  class="fa fa-circle-o"></i><span> Permisos</span></a></li>
				</ul>
			</li> -->
			<?php if($_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li><a href="usuarios"><i class="fa fa-user"></i><span> Usuarios</span></a></li>
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] == 'almacenista' || $_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li><a href="categorias"><i class="fa fa-th"></i><span> Categorias</span></a></li>
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] == 'almacenista' || $_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li><a href="productos"><i class="fa fa-shopping-cart"></i><span> Productos</span></a></li>
			<?php endif; ?>

			<?php if($_SESSION['usuario']['perfil'] == 'administrador' || $_SESSION['usuario']['perfil'] == 'vendedor'): ?>
				<li><a href="clientes"><i class="fa fa-users"></i><span> Clientes</span></a></li>
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] == 'vendedor' || $_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-list-ul"></i>
						<span>Ventas</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>

					<ul class="treeview-menu">
						<li><a href="crear-venta"><i  class="fa fa-circle-o"></i><span> Crear Venta</span></a></li>
						<?php if($_SESSION['usuario']['perfil'] == 'administrador'): ?>
							<li><a href="ventas"><i  class="fa fa-circle-o"></i><span> Administrar Ventas</span></a></li>
						<?php endif; ?>
						<!-- <li><a href="reportes"><i  class="fa fa-circle-o"></i><span> Reporte de venta</span></a></li> -->
					</ul>
				</li>
			<?php endif; ?>
		</ul>
	</section>
</aside>