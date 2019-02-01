<?php 
function revisarPaginaActiva($pagina){
	if($pagina == $_GET['url']){
		return 'active';
	}
}

$productosConBajoStock = Model::query('select count(*) from producto where stock <= 10')[0][0];
?>
<aside class="main-sidebar">
	<div class="user-panel">
		<div class="pull-left image">
			<img src="views/img/plantilla/img-user.png" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
			<p><?= ucwords($_SESSION['usuario']['nombre']) ?></p>
			<a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
		</div>
	</div>
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li class="<?= revisarPaginaActiva('inicio') ?>"><a href="inicio"><i class="fa fa-home"></i><span> Inicio</span></a></li>
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
				<li class="<?= revisarPaginaActiva('usuarios') ?>"><a href="usuarios"><i class="fa fa-user"></i><span> Usuarios</span></a></li>
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] == 'almacenista' || $_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li class="<?= revisarPaginaActiva('categorias') ?>"><a href="categorias"><i class="fa fa-th"></i><span> Categorias</span></a></li>
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] == 'almacenista' || $_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li class="<?= revisarPaginaActiva('productos') ?>">
					<a href="productos">
						<i class="fa fa-shopping-cart"></i>
						<span> Productos</span>
						<?php if($productosConBajoStock > 0): ?>
							<span class="pull-right-container">
								<span class="label label-danger pull-right" title="Productos con bajo inventario"><?= $productosConBajoStock; ?></span>
							</span>
						<?php endif; ?>
					</a>
				</li>
			<?php endif; ?>

			<li class="<?= revisarPaginaActiva('proveedores') ?>"><a href="proveedores"><i class="fa fa-address-book"></i><span> Proveedores</span></a></li>
			<?php if($_SESSION['usuario']['perfil'] == 'administrador' || $_SESSION['usuario']['perfil'] == 'vendedor'): ?>
				<li class="<?= revisarPaginaActiva('clientes') ?>"><a href="clientes"><i class="fa fa-users"></i><span> Clientes</span></a></li>
			<?php endif; ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cart-plus"></i>
					<span>Compras</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li><a href="crear-compra"><i  class="fa fa-circle-o"></i><span> Nueva Compra</span></a></li>
					<?php if($_SESSION['usuario']['perfil'] == 'administrador'): ?>
						<li><a href="compras"><i  class="fa fa-circle-o"></i><span> Administrar Compras</span></a></li>
					<?php endif; ?>
					<!-- <li><a href="reportes"><i  class="fa fa-circle-o"></i><span> Reporte de venta</span></a></li> -->
				</ul>
			</li>
			<?php if($_SESSION['usuario']['perfil'] == 'vendedor' || $_SESSION['usuario']['perfil'] == 'administrador'): ?>
				<li class="treeview <?= revisarPaginaActiva('crear-venta') ?><?= revisarPaginaActiva('ventas') ?>">
					<a href="#">
						<i class="fa fa-shopping-bag"></i>
						<span>Ventas</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>

					<ul class="treeview-menu">
						<li class="<?= revisarPaginaActiva('crear-venta') ?>"><a href="crear-venta"><i  class="fa fa-circle-o"></i><span> Nueva Venta</span></a></li>
						<?php if($_SESSION['usuario']['perfil'] == 'administrador'): ?>
							<li class="<?= revisarPaginaActiva('ventas') ?>"><a href="ventas"><i  class="fa fa-circle-o"></i><span> Administrar Ventas</span></a></li>
						<?php endif; ?>
						<!-- <li><a href="reportes"><i  class="fa fa-circle-o"></i><span> Reporte de venta</span></a></li> -->
					</ul>
				</li>
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] = 'administrador'): ?>
				<!-- <li class="<?= revisarPaginaActiva('bitacora') ?>"><a href="bitacora"><i class="fa fa-list"></i><span> Bitácora</span></a></li> -->
			<?php endif; ?>
			<?php if($_SESSION['usuario']['perfil'] = 'administrador'): ?>
				<li class="<?= revisarPaginaActiva('configuracion') ?>"><a href="configuracion"><i class="fa fa-cogs"></i><span> Configuración</span></a></li>
			<?php endif; ?>
		</ul>
	</section>
</aside>