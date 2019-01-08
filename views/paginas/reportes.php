<div class="wrapper">
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Reportes de ventas
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Reportes de ventas</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="row">					
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<?php 
						$dias =cal_days_in_month(CAL_GREGORIAN, 2, 2019);
						echo "hubo $dias en el mes de enero del 2019";
						 ?>
						<h4>Ventas por periodo</h4>
						<select class="filtro-ventas" id="filtroMonthVentas" name="month">
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
							<?php 
							$minYear = Reportes::minYearVentas();
							$maxYear = Reportes::maxYearVentas();
							?>
							<?php for($i = $minYear; $i <= $maxYear; $i++): ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="box-body">
						<canvas id="ventasPorPeriodo"></canvas>
					</div><!-- /.box -->
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
</div>