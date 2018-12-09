<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrar Perfiles
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar productos</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPerfil">Agregar</button>
			</div>
			<div class="box-body">
				<!--====================================
				=            TABLA PERFILES            =
				=====================================-->
				
				<table id="dtPerfiles" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				
				<!--====  End of TABLA PERFILES  ====-->
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

<!--===================================
=            MODAL AGREGAR            =
====================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarPerfil" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Perfil</h4>
			</div>
			<form method="post" id="formAgregarPerfil">
				<div class="modal-body">
					<div class="box-body">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control" placeholder="Nombre">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--====  End of MODAL AGREGAR  ====-->

<!--=========================================
=            MODAL EDITAR PERFIL            =
==========================================-->

<div class="modal fade" id="modalEditarPerfil" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Perfil</h4>
			</div>
			<form method="post" id="formEditarPerfil">
				<div class="modal-body">
					<div class="box-body">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="idEditarPerfil" name="id">	
					<button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--====  End of MODAL EDITAR PERFIL  ====-->

<div class="modal fade" id="modalEliminarPerfil" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">¿Seguro que desea eliminar el perfil?</h4>
			</div>
			<form method="post" id="formEliminarPerfil">
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<input type="hidden" id="idEliminarPerfil" name="id">
					<button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
					<button type="submit" class="btn btn-danger">SI</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->