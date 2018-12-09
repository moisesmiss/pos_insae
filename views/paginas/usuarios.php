<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrar usuarios
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar usuarios</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
					Agregar Usuario
				</button>
				
			</div>
			<div class="box-body">
				<table id="dtUsuarios" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Estado</th>
							<th>Ultimo login</th>
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

<!--===========================================
=            MODAL AGREGAR USUARIO            =
============================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar usuario</h4>
			</div>
			<form method="post" id="formAgregarUsuario">
				<div class="modal-body">
					<div class="box-body">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" name="nombre" class="form-control" placeholder="Nombre">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="text" name="email" class="form-control" placeholder="Correo">
							</div>
							<span class="help-block"></span>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" name="password" class="form-control" placeholder="Contraseña">
							</div>
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

<!--====  End of MODAL AGREGAR USUARIO  ====-->


<!--==========================================
=            MODAL EDITAR USUARIO            =
===========================================-->

<div class="modal fade" id="modalEditarUsuario" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>
			</div>
			<form method="post" id="formEditarUsuario">
				<div class="modal-body">
					<div class="form-group">
						<label>Usuario</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
						</div>
					</div>

					<div class="form-group">
						<label>Nombre</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" id="email" name="email" class="form-control" placeholder="Usuario">
						</div>
						<span class="help-block"></span>
					</div>

					<div class="form-group">
						<label>Contraseña</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" name="password" class="form-control" placeholder="Nueva Contraseña">
						</div>
					</div>

				</div> <!-- /.modal-body -->

				<div class="modal-footer">
					<input type="hidden" id="idEditarUsuario" name="persona_id">
					<input type="hidden" name="emailActual">
					<button type="submit" id="btnEditarUsuario" class="btn btn-primary">Aceptar</button>
				</div> 
			</form>
		</div>
	</div>
</div>

<!--====  End of MODAL EDITAR USUARIO  ====-->

<!--============================================
=            MODAL ELIMINAR USUARIO            =
=============================================-->

<div class="modal fade" id="modalEliminarUsuario" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">¿Seguro que desea eliminar el usuario?</h4>
			</div>
			<form method="post" id="formEliminarUsuario">
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<input type="hidden" id="idEliminarUsuario" name="persona_id">
					<button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
					<button type="submit" class="btn btn-danger">SI</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--====  End of MODAL ELIMINAR USUARIO  ====-->
