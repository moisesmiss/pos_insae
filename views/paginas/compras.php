<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrar Compras
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar ventas</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<a href="crear-compra" class="btn btn-primary">Nueva Compra</a>
				<button class="btn btn-default pull-right" id="btn-daterange2">
					<i class="fa fa-calendar"></i>
					<span> Rango de fecha </span>
					<i class="fa fa-caret-down"></i>
				</button>
			</div>
			<div class="box-body">
				<table id="dtCompras" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
					<thead>
						<tr>
							<th>ID</th>
							<th>Neto</th>
							<th>Total</th>
							<th>Fecha</th>
							<th>Acciones</th>							
						</tr>
					</thead>
					<tbody style="text-transform: capitalize;">
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

<script src="views/js/compras.js"></script>