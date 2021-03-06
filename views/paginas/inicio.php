<?php 
$total_clientes = count(Model::getAll('cliente'));
$total_productos = count(Model::getAll('producto'));
$total_categorias = count(Model::getAll('categoria'));
$total_vendedores = count(Model::findAll('view_usuario', 'perfil', 'vendedor'));
?>
<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Inicio
				<small>Panel de control</small>
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Tablero</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<?php if($_SESSION['usuario']['perfil'] == 'administrador'): ?>
	<section class="content">
		<div class="row">

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-orange">
					<div class="inner">
						<h3 class="count"><?= $total_vendedores ?></h3>

						<p>Vendedores</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="usuarios" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3 class="count"><?= $total_clientes ?></h3>

						<p>Clientes</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="clientes" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-blue">
					<div class="inner">
						<h3 class="count"><?= $total_productos ?></h3>

						<p>Productos</p>
					</div>
					<div class="icon">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<a href="productos" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3 class="count"><?= $total_categorias ?></h3>

						<p>Categorias</p>
					</div>
					<div class="icon">
						<i class="fa fa-th"></i>
					</div>
					<a href="categorias" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

		</div>
		<!-- Default box -->
		<div class="row">					
			<div class="col-md-12">
				<div class="box box-solid box-primary">
					<div class="box-header with-border">
						<h4>Ventas por periodo</h4>
					</div>
					<div class="box-body">
						<select class="filtro-ventas" id="filtroMonthVentas" name="month">
							<option selected disabled>Mes</option>
							<option value="todos">Todos</option>
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
						<select class="filtro-ventas" id="filtroYearVentas" name="year">
							<option selected disabled>Año</option>
							<?php 
							$minYear = Reportes::minYearVentas();
							$maxYear = Reportes::maxYearVentas();
							?>
							<?php for($i = $minYear; $i <= $maxYear; $i++): ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
						<canvas id="graficaVentas"></canvas>
					</div><!-- /.box -->
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.row -->
	</section>
	<?php else: ?>
		<section class="content">
			<div class="box box-primary">
				<div class="box-body">
					<h2>Bienvenido <?= ucwords($_SESSION['usuario']['nombre']) ?></h2>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
<script type="text/javascript" src="views/js/reportes.js"></script>