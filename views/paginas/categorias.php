<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrar categorías
			</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrar categorías</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar</button>
			</div>
			<div class="box-body">
				<!--======================================
				=            TABLA CATEGORIAS            =
				=======================================-->
				
				<table id="dtCategorias" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<!-- aqui el contenido de la tabla que viene desde ajax con datatable -->
					</tbody>
				</table>
				
				<!--====  End of TABLA CATEGORIAS  ====-->
				
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
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Categoria</h4>
			</div>
			<form method="post" id="formAgregarCategoria">
				<div class="modal-body">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" class="form-control" placeholder="Nombre">
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

<!--============================================
=            MODAL EDITAR CATEGORIA            =
=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Categoria</h4>
			</div>
			<form method="post" id="formEditarCategoria">
				<div class="modal-body">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" class="form-control" placeholder="Nombre">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id">
					<button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--====  End of MODAL EDITAR CATEGORIA  ====-->
