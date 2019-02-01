<?php 
$clientes = Model::getAll('view_cliente');
?>
<div class="wrapper">
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Nueva venta</h1>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<!--=============================================
				=            FORM PARA GENERAR VENTA            =
				==============================================-->

				<div class="col-lg-5">
					<div class="box box-success">
						<form id="formAgregarVenta">
							<div class="box-header">
								<div class="form-group">
									<label>Vendedor</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input type="text" class="form-control" value="<?= ucwords($_SESSION['usuario']['nombre']) ?>" readonly>
										<input id="vendedor_id" type="hidden" name="vendedor_id" value="<?= $_SESSION['usuario']['persona_id'] ?>">
									</div>
								</div>

								<div class="form-group">
									<label>Cliente</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-users"></i></span>
										<select id="cliente_id" name="cliente_id" class="form-control">
											<option value="">Anonimo</option>
											<?php foreach($clientes as $cliente): ?>
												<option value="<?= $cliente['cliente_id'] ?>"><?= ucwords($cliente['nombre']) ?></option>
											<?php endforeach; ?>
										</select>

										<!-- <a class="input-group-addon btn btn-default btn-xs" data-toggle="modal" data-target="#modalCliente">Agregar cliente</a> -->

									</div>
								</div>
							</div> <!-- /.box-header -->

							<div id="nuevaVenta">
								<div class="box-body">
									<label>Productos</label>
									<div id="listaProductos">
										<!-- LISTA DE PRODUCTOS AÑADIDAS CON JQUERY -->
									</div>

									<hr>

									<div class="row">
										<div class="col-xs-offset-2 col-xs-4">
											<div class="form-group">
												<label>Inpuesto</label>
												<div class="input-group">
													<input id="impuestoVenta" type="number" class="form-control input-lg" min="0" max="100" name="impuesto" value="0" required readonly>
													<span class="input-group-addon"><i class="fa fa-percent"></i></span>
												</div>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="form-group">
												<label>Total</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
													<input id="precioTotalVenta" data-total="" class="form-control input-lg" type="text" name="total" placeholder="0" required readonly>
												</div>
											</div>
										</div>
									</div> <!-- /.row -->

									<div class="row">
										<div class="col-md-4 pr-0" id="colMetodoPago">
											<div class="form-group">
												<label>Metodo de pago</label>
												<select id="metodoPago" name="metodoPago" class="form-control">
													<option selected value="Efectivo">Efectivo</option>
													<option value="TC">Tarjeta Credito</option>
													<option value="TD">Tarjeta Debito</option>
												</select>
											</div>
										</div>
										<div class="col-md-6" id="codigoTransaccion">
											<div class="form-group">
												<label>Codigo de Transacción</label>
												<div class="input-group">
													<input id="inputCodigoTransaccion" type="text" class="form-control" name="codigoTransaccion">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
												</div>
											</div>
										</div>

										<div id="pagoCambio">
											<div class="col-md-4">
												<div class="form-group">
													<label>Pago</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
														<input id="inputPago" class="form-control" type="text" name="pago">
													</div>
												</div>
											</div>
											<div class="col-md-4 pl-0">
												<div class="form-group">
													<label>Cambio</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
														<input id="inputCambio" class="form-control" type="text" name="pago" readonly>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- /.row -->

								</div> <!-- /.box-body -->

								<div class="box-footer">
									<button id="btnFinalizarVenta" type="submit" class="btn btn-success pull-right">Finalizar Venta</button>
								</div> <!-- /.box-footer -->
							</div> <!-- /#nuevaVenta -->
						</form>
					</div> <!-- /.box -->
				</div><!-- /.col-lg-5 -->

				<!--====  End of FORM PARA GENERAR VENTA  ====-->

				<!--========================================
				=            TABLA DE PRODUCTOS            =
				=========================================-->
				
				<div class="col-lg-7">
					<div class="box box-primary">
						<div class="box-body">
							<table id="dtAgregarProductos" class="table table-bordered table-striped tabla-datatable dt-responsive nowrap" style="width: 100%;">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Agregar</th>
										<th>Imagen</th>
										<th>Codigo</th>
										<th>Stock</th>
										<th>Descripcion</th>

									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<!--====  End of TABLA DE PRODUCTOS  ====-->
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
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

<script type="text/javascript" src="views/js/crear-ventas.js"></script>