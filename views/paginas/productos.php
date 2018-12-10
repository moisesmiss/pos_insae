<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrar productos
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
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">Agregar</button>
			</div>
			<div class="box-body">
				<table id="dtProductos" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Código</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Categoría</th>
							<th>Stock</th>
							<th>Precio compra</th>
							<th>Precio venta</th>
							<th>Agregado en</th>
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


<!--============================================
=            MODAL AGREGAR PRODUCTO            =
=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Producto</h4>
			</div>
			<form method="post" id="formAgregarUsuario" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
									<input type="text" name="codigo" class="form-control" placeholder="Codigo">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-archive"></i></span>
									<input type="text" name="nombre" class="form-control" placeholder="Nombre">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-align-left"></i></span>
									<textarea name="codigo" class="form-control form-textarea" placeholder="Descripcion"></textarea>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-th"></i></span>
									<select class="form-control" name="categoria_id">
										<option>Categoria 1</option>
										<option>Categoria 2</option>
										<option>Categoria 3</option>
										<option>Categoria 4</option>
										<option>Categoria 5</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<input min="0" type="number" class="form-control" name="stock" placeholder="Stock">
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<input min="0" type="number" class="form-control" name="precio_compra" placeholder="Precio de compra">
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<input min="0" type="number" class="form-control" name="precio_venta" placeholder="Precio de venta">
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<input type="number" class="form-control porcentaje" min="0" value="40">
									<span class="input-group-addon"><i class="fa fa-percent"></i></span>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>
									<input type="checkbox" class="minimal porcentaje" checked>
									 <span> Utilizar porcentaje</span>
								</label>
							</div>
						</div>



						<div class="col-md-12">
							<div class="form-group">
								<input type="file" id="imagenProducto" name="imagen">
								<p class="help-block">Peso máximo de la imagen 2MB</p>
								<img src="views/img/productos/default/anonymous.png" class="img-thumbnail img-responsive" width="100px">
							</div>
						</div>

					</div><!-- /.row -->
				</div><!-- /.modal-body -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--====  End of MODAL AGREGAR PRODUCTO  ====-->
