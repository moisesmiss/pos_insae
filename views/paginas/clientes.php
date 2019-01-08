<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrar clientes
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar clientes</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<button data-toggle='modal' data-target='#modalCliente' class="btn btn-primary">Agregar</button>
			</div>
			<div class="box-body">
				<table id="dtClientes" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Dirección</th>
							<th>Ultima compra</th>
							<th>Fecha de nacimiento</th>
							<!-- <th>Total Compras</th> -->
							<th>Cliente desde</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
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

<!--===================================================
=            MODAL AGREGAR/EDITAR CLIENTES            =
====================================================-->

<div id="modalCliente" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Cliente</h4>
			</div>
			<form id="formCliente">
				<div class="modal-body">
					<div class="row">						
						<div class="col-md-6">
							<div class="form-group">
								<label>Nombre</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
									<input type="text" name="nombre" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Correo</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
									<input type="email" name="correo" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Fecha de nacimiento</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
									<input type="date" name="fecha_nacimiento" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Numero de teléfono</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-phone"></i></div>
									<input type="tel" name="telefono" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Dirección</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<input class="form-control" id="autocomplete" placeholder="Ingresa tu dirección" type="text" autocomplete="off" name="direccion">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id">
					<button class="btn btn-primary" type="submit">Aceptar</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--====  End of MODAL AGREGAR/EDITAR CLIENTES  ====-->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgFLaPp5c21WIX6lafkd5rS2c2-sWkxro&libraries=places"></script>
<script type="text/javascript">
	//input autocompletar de google
	var autocomplete;
	function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
        	/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        	{types: ['geocode']});
    }
    initAutocomplete();
</script>