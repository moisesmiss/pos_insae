<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
</head>
<style type="text/css">
th{
	/*font-weight: 300;*/
}
table{
	margin:auto; width: 90%;
	border-collapse: collapse;
}
.bordered td, .bordered th{
	border: 1px solid black;
	padding: 5px;
}
</style>
<body>
	<div style="border-top: 1px solid black; width: 90%; margin: auto;"></div>
	<table margin-top: 16px;">
		<tr>
			<th style="width: 30%; font-size: 40px;">
				<?php if(!empty($configuracion['logo'])): ?>
					<img style="max-width: 100%;" src="../views/img/plantilla/<?= $configuracion['logo'] ?>">
					<?php elseif(empty($configuracion['logo']) && !empty($configuracion['nombre_corto_empresa'])): ?>
					<?= $configuracion['nombre_corto_empresa'] ?>
				<?php endif; ?>
				
			</th>
			<th style="width: 30%;">
				<?php if(!empty($configuracion['direccion'])): ?>
					Dirección: <?= $configuracion['direccion'] ?>
				<?php endif; ?>
			</th>
			<th style="width: 30%;">
				<?php if(!empty($configuracion['telefono'])): ?>
					Teléfono: <?= $configuracion['telefono'] ?>
				<?php endif; ?>
				<br>
				<?php if(!empty($configuracion['correo'])): ?>
					Correo electronico: <?= $configuracion['correo'] ?>
				<?php endif; ?>
			</th>
			<th style="width: 10%; color: tomato;">
				Factura.N <?= $venta['id'] ?>
			</th>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 30px; margin-left: 0;">
		<tr>
			<th style="width: 70%;">Cliente</th>
			<td style="width: 30%;"><?= ucwords($venta['cliente']) ?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?= $venta['fecha'] ?></td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 30px;">
		<tr>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Subtotal</th>
		</tr>
		<?php foreach($productos as $producto): ?>
			<tr>
				<td style="width: 40%;"><?= $producto['nombre'] ?></td>
				<td style="width: 20%;"><?= $producto['cantidad'] ?></td>
				<td style="width: 20%;">$ <?php echo number_format(($producto['subtotal'] / $producto['cantidad']), 2, '.', ',') ?></td>
				<td style="width: 20%;">$ <?= number_format($producto['subtotal'], 2, '.', ',') ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<table class="bordered" style="margin-top: 30px;">
		<tr>
			<th style="width: 50%; border: none; border-right: 1px solid black"></th>
			<th style="width: 20%;">Neto</th>
			<td style="width: 30%;">$ <?= number_format($venta['neto'], 2) ?></td>
		</tr>
		<tr>
			<th style="border: none; border-right: 1px solid black"></th>
			<th>Impuesto (IVA - <?= $venta['impuesto'] ?>%)</th>
			<td>$ <?= number_format(($venta['neto'] / 100 * 16), 2) ?></td>
		</tr>
		<tr>
			<th style="border: none; border-right: 1px solid black"></th>
			<th>Total</th>
			<td>$ <?= number_format($venta['total'], 2) ?></td>
		</tr>
	</table>
</body>
</html>