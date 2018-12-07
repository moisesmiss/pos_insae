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
				<table class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$objUsuarios = new ControllerUsuarios;
						$usuarios = $objUsuarios->getAll();
						?>
						<?php foreach ($usuarios as $usuario): ?>
							<tr>
								<td><?= $usuario['nombre'] ?></td>
								<td><?= $usuario['usuario'] ?></td>
								<td><button class="btn btn-success btn-xs">Activado</button></td>
								<td>
									<div class="btn-group">
										<button class="btn btn-warning btn-editar-usuario" data-toggle="modal" data-target="#modalEditarUsuario" data-id-usuario="<?= $usuario['id'] ?>"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-danger"><i class="fa fa-times"></i></button>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
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
			<form method="post"></form>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar usuario</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" name="nombre" class="form-control" placeholder="Nombre">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key"></i></span>
								<input type="text" name="usuario" class="form-control" placeholder="Usuario">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" name="password" class="form-control" placeholder="Contraseña">
							</div>
						</div>

						<!-- <div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-users"></i></span>
								<select name="rol" class="form-control">
									<option value="">Seleccionar perfil</option>
									<option value="Administrador">Administrador</option>
									<option value="especial">Especial</option>
									<option value="vendedor">Vendedor</option>
								</select>
							</div>
						</div> -->

        		<!-- <div class="form-group">
        			<div class="panel text-uppercase">subir-foto</div>
        			<input type="file" id="foto" name="foto">
        			<p class="help-bock">Peso máximo de la foto 2MB</p>
        			<img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail">
        		</div> -->

        		

        	</div>
        </div>
        <div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
        <?php 
        $objUsuarios->ctrCrearUsuario();
        ?>
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
			<form method="post"></form>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<form method="post">
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
								<input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
							</div>
						</div>

						<div class="form-group">
							<label>Contraseña</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" name="password" class="form-control" placeholder="Nueva Contraseña">
							</div>
						</div>

						<!-- <div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-users"></i></span>
								<select name="rol" class="form-control">
									<option value="">Seleccionar perfil</option>
									<option value="Administrador">Administrador</option>
									<option value="especial">Especial</option>
									<option value="vendedor">Vendedor</option>
								</select>
							</div>
						</div> -->

        		<!-- <div class="form-group">
        			<div class="panel text-uppercase">subir-foto</div>
        			<input type="file" id="foto" name="foto">
        			<p class="help-bock">Peso máximo de la foto 2MB</p>
        			<img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail">
        		</div> -->

        		

        	</div>
        </div>
        <div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
        <?php 

        ?>
    </form>
</div>
</div>
</div>

<!--====  End of MODAL EDITAR USUARIO  ====-->


<!--=============================
=            ALERTAS            =
==============================-->

<?php if(@$objUsuarios->alert == 'success'): ?>
	<script>
		swal({
			type: 'success', 
			title: 'Datos agregados correctamente',
			showConfirmButton: true,
			confirmButtonText: 'Cerrar',
		}).then((result) => {
			if(result.value){
				window.location = 'usuarios';
			}
		});
	</script>
	<?php elseif(@$objUsuarios->alert == 'error'): ?>
		<script>
			swal({
				type: 'error', 
				title: 'Error al ingresar datos',
				showConfirmButton: true,
				confirmButtonText: 'Cerrar',
			}).then((result) => {
				if(result.value){
					window.location = 'usuarios';
				}
			});
		</script>
	<?php endif; ?>

	<!--====  End of ALERTAS  ====-->

