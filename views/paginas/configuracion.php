<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Configuración
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar clientes</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Información de la empresa</a></li>
				<li class=""><a href="#tab_2" data-toggle="tab">Impuesto</a></li>
				<!-- <li class=""><a href="#tab_3" data-toggle="tab">Configuración general</a></li> -->
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<form id="formConfiguracionInformacionEmpresa" enctype="multipart/formdata">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Logo</label>
									<input accept=".jpg, .jpeg, .png" id="inputLogo" type="file" name="logo">
								</div>
								<img style="max-height: 400px; max-width: 500px; margin: 1rem;" src="" id="logoPreview" class="img-responsive">
								<button type="button" class="btn btn-default" id="btnEliminarLogo">Eliminar logo</button>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nombre corto de la empresa</label>
									<input class="form-control" type="text" name="nombre_corto_empresa">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nombre largo de la empresa</label>
									<input class="form-control" type="text" name="nombre_largo_empresa">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>RFC</label>
									<input class="form-control" type="text" name="rfc">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Teléfono</label>
									<input id="telefonoEmpresa" class="form-control" type="text" name="telefono">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Correo</label>
									<input class="form-control" type="email" name="correo">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Sitio web</label>
									<input class="form-control" type="text" name="sitio_web">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Dirección</label>
									<input class="form-control" type="text" name="direccion">
								</div>
							</div>
						</div><!-- /.row -->
						<button class="btn btn-primary">Guardar</button>
					</form>
				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<form id="formConfiguracionImpuesto">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>IVA</label>
									<div class="input-group">										
										<input min="0" max="100" class="form-control" type="number" name="iva">
										<span class="input-group-addon"><i class="fa fa-percent"></i></span>
									</div>
								</div>
							</div>
						</div>
						<button class="btn btn-primary">Guardar</button>
					</form>
				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_3">
					<p>tab 3</p>
				</div>
				<!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- nav-tabs-custom -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

<script type="text/javascript" src="views/js/configuracion.js"></script>