<?php 
$objCategorias = new ControllerCategorias();
$categorias = $objCategorias->getAll();

$proveedores = Model::getAll('view_proveedor');
?>
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
				<input type="hidden" value="<?= $_SESSION['usuario']['perfil'] ?>" id="perfilUsuario">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">Agregar</button>
			</div>
			<div class="box-body">
				<table id="dtProductos" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Imagen</th>
							<th>Código</th>
							<th>Descripción</th>
							<th>Categoría</th>
							<th>Proveedor</th>
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
			<form method="post" id="formAgregarProducto" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Código</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
									<input type="text" name="codigo" class="form-control" placeholder="Codigo">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Nombre</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-archive"></i></span>
									<input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Descripción</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-align-left"></i></span>
									<textarea name="descripcion" class="form-control form-textarea" placeholder="Descripcion"></textarea>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Proveedor *</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-th"></i></span>
									<select class="form-control" name="proveedor_id" required>
										<option id="proveedor_id" value="" selected readonly>Seleccionar</option>
										<?php foreach($proveedores as $proveedor): ?>
											<option value="<?= $proveedor['id'] ?>"><?= $proveedor['nombre'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>

							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Categoría</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-th"></i></span>
									<select class="form-control" name="categoria_id">
										<option id="categoria_id" value="" selected readonly>Seleccionar</option>
										<?php foreach($categorias as $categoria): ?>
											<option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Stock</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<input min="0" type="number" class="form-control" name="stock" placeholder="Stock">
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Precio de compra</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<input min="0" step="any" type="number" class="form-control" name="precio_compra" placeholder="Precio de compra">
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Precio de venta</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<input min="0" step="any" type="number" class="form-control" name="precio_venta" placeholder="Precio de venta" readonly>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Porcentaje de utilidad</label>
								<div class="input-group">
									<input id="porcentajeUtilidad" type="number" class="form-control porcentaje" min="0" value="40">
									<span class="input-group-addon"><i class="fa fa-percent"></i></span>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label id="labelPorcentaje">
									<input type="checkbox" id="checkPorcentaje" class="minimal porcentaje" checked>
									<span> Utilizar porcentaje</span>
								</label>
							</div>
						</div>



						<div class="col-md-12">
							<label>Imagen</label>
							<div class="form-group">
								<input type="file" id="imagenProducto" name="imagen" accept="image/jpeg">
								<p class="help-block">Peso máximo de la imagen 2MB</p>
								<div class="div-prev-img">
									<img src="views/img/productos/default/anonymous.png" class="prev-img" style="max-width: 80%">
								</div>
								<input type="hidden" name="x1">
								<input type="hidden" name="x2">
								<input type="hidden" name="y1">
								<input type="hidden" name="y2">
							</div>
						</div>

					</div><!-- /.row -->
				</div><!-- /.modal-body -->
				<div class="modal-footer">
					<input type="hidden" name="id">
					<button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--====  End of MODAL AGREGAR PRODUCTO  ====-->
