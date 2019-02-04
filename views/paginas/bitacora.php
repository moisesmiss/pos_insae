<?php 
$fechasBitacora = Model::query(
	"select fecha, date_format(fecha, '%Y-%m-%d') as fecha_formateada 
	from bitacora 
	group by CAST(fecha AS DATE) 
	order by fecha desc"
);
?>
<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Bitácora
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar clientes</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">
		<ul class="timeline">
			<?php foreach ($fechasBitacora as $fecha): ?>
				<!-- timeline time label -->
				<li class="time-label">
					<span class="bg-green">
						<?= $fecha['fecha_formateada'] ?>
					</span>
				</li>
				<!-- /.timeline-label -->
				<!-- timeline item -->
				<?php 
				$bitacorasPorFecha = Model::query(
					"select * from view_bitacora where fecha like '%{$fecha['fecha_formateada']}%'"
				);
				?>
				<?php foreach ($bitacorasPorFecha as $bitacora): ?>
					<li>
						<!-- timeline icon -->
						<i class="fa fa-user bg-blue"></i>
						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> hace una hora</span>

							<h3 class="timeline-header">Usuarios</h3>

							<div class="timeline-body">
								El usuario Moisés editó los datos del usuario Daniel 
								<a class="btn btn-primary btn-xs pull-right"> Ver más</a>
							</div>
						</div>
					</li>
				<?php endforeach ?>
			<?php endforeach ?>
			<!-- timeline time label -->
			<li class="time-label">
				<span class="bg-green">
					10 Feb. 2014
				</span>
			</li>
			<!-- /.timeline-label -->
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-user bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> hace una hora</span>

					<h3 class="timeline-header">Usuarios</h3>

					<div class="timeline-body">
						El usuario Moisés editó los datos del usuario Daniel 
						<a class="btn btn-primary btn-xs pull-right"> Ver más</a>
					</div>
				</div>
			</li>

			<li>
				<!-- timeline icon -->
				<i class="fa fa-clock-o bg-gray"></i>
			</li>
			<!-- END timeline item -->
		</ul>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>