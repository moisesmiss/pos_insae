<?php 
$proveedores = Model::getAll('view_proveedor');
?>
<div class="wrapper">
	<div class="content-wrapper">
		<section class="content-header">
			<h1>Nueva compra</h1>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-lg-5">
					<div class="box box-success">
						<form id="formAgregarCompra">
							<div class="box-header with-border">
								<label>Productos</label>
							</div>
							<div class="box-body">
								<div id="listaProductosCompra">
									
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label>Inpuesto</label>
											<div class="input-group">
												<input id="impuestoCompra" type="number" class="form-control input-lg" min="0" max="100" name="impuesto" value="0">
												<span class="input-group-addon"><i class="fa fa-percent"></i></span>
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label>Total</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
												<input id="precioTotalCompra" data-total="" class="form-control input-lg" type="text" name="total" placeholder="0" required readonly>
											</div>
										</div>
									</div>
								</div> <!-- /.row -->
							</div>
							<div class="box-footer">
								<button class="btn btn-success pull-right">Finalizar Compra</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="box box-primary">
						<div class="box-body">
							<table id="dtProductosCompra" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
								<thead>
									<th>Nombre</th>
									<th>Agregar</th>
									<th>Imagen</th>
									<th>Stock</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>


<!--==================================
=            AJAX LOADER             =
===================================-->

<div class="div-spinner">
	<div class="spinner">
		<div class="double-bounce1"></div>
		<div class="double-bounce2"></div>
	</div>
</div>

<!--====  End of AJAX LOADER   ====-->

<script src="views/js/crear-compra.js"></script>