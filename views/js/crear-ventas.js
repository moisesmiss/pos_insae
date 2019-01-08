var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/productos.ajax.php?action=listar",
	}, 
	"columns" : [
	{"data" : "nombre"},
	{
		"data": null,
		"render" : function(data){
			if(data.stock > 0){				
				return '<td><button class="btn btn-primary btn-agregar-producto recuperar-btn" data-id-producto="'+data.id+'"><i class="fa fa-plus"></i></button></td>';
			} else {
				return '<td><button class="btn btn-default disabled"><i class="fa fa-plus"></i></button></td>';
			}
		}
	},
	{
		"data" : "imagen",
		"render" : function(data){
			if(data == '' || data === null){
				return "<img src='views/img/productos/default/anonymous.png' class'img-responsive' width='50px'>";
			} else {
				return "<a href='views/img/productos/"+data+"' data-toggle='lightbox'><img src='views/img/productos/"+data+"' class'img-responsive' width='50px'></a>";
			}
		}
	},
	{"data": "codigo"},
	{
		"data" : 'stock',
		"render": function(data, type, row, meta){
			if(data <= 10){
				return "<button class='btn btn-xs btn-danger'>"+data+"</button>";
			} else if(data > 10 && data < 50){
				return "<button class='btn btn-xs btn-warning'>"+data+"</button>";
			} else {
				return "<button class='btn btn-xs btn-success'>"+data+"</button>";
			}
		}
	},
	{"data": "descripcion"}
	]
};

$("#dtAgregarProductos").DataTable(options);

/*=========================================
=            AGREGAR PRODUCTOS            =
=========================================*/
// $("#nuevaVenta").hide();
$('#dtAgregarProductos tbody').on('click', '.btn-agregar-producto', function(){
	// $("#nuevaVenta").show();
	$("#dtAgregarProductos").dataTable().fnFilter('');

	var boton = $(this);
	var tr = $(this).closest('tr');
	if(tr.hasClass('child')){
		tr = tr.prev();
	}
	var data = $('#dtAgregarProductos').DataTable().row(tr).data();

	// quitar el id de la lista de localstorage
	if(idQuitarProducto != null){

		var index = idQuitarProducto.indexOf(parseInt(data.id));
		if (index > -1) {
		  idQuitarProducto.splice(index, 1);
		}
	}

	boton.removeClass('btn-primary btn-agregar-producto');
	boton.addClass('btn-default disabled');

	$("#listaProductos").append(
		'<div class="form-group lista-productos-item">'+
			'<div class="row">'+
				'<div class="col-xs-6 pr-0">'+
					'<div class="input-group">'+
						'<a class="input-group-addon btn btn-danger btn-xs btn-quitar-producto" data-id-producto="'+data.id+'"><i class="fa fa-times"></i></a>'+
						'<input type="text" class="form-control no-focus" id="agregarProducto" name="agregarProducto" value="'+data.nombre+'" readonly required>'+
					'</div>'+
				'</div>'+
				'<div class="col-xs-2 px-0">'+
					'<input type="number" name="cantidad" class="form-control input-cantidad" min="1" max="'+data.stock+'" data-stock="'+data.stock+'" value="1" required>'+
				'</div>'+
				'<div class="col-xs-4 pl-0">'+
					'<div class="input-group">'+												
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						'<input type="text" name="precio" class="form-control no-focus no-focus-next input-precio" value="'+data.precio_venta+'" data-precio="'+data.precio_venta+'" readonly required>'+
					'</div>'+
				'</div>'+
			'</div><!-- /.row -->'+
		'</div>'
	);
	//dar formato de numero a los input con jqueryNumberFormat
	$(".input-precio").number(true, 2);
	$("#precioTotalVenta").number(true, 2);
	sumarPrecios();
	calcularImpuesto();
	calcularCambio();
});

/*=====  End of AGREGAR PRODUCTOS  ======*/

/*==============================================
=            NAVEGACION EN LA TABLA            =
==============================================*/

$("#dtAgregarProductos").on('draw.dt', function(){
	if(idQuitarProducto != null){
		for(var i = 0; i < idQuitarProducto.length; i++){
			$(".recuperar-btn[data-id-producto="+idQuitarProducto[i]+"]").removeClass('disabled btn-default');
			$(".recuperar-btn[data-id-producto="+idQuitarProducto[i]+"]").addClass('btn-primary btn-agregar-producto');
		}
	}
});

/*=====  End of NAVEGACION EN LA TABLA  ======*/


/*====================================================
=            QUITAR PRODUCTOS DE LA LISTA            =
====================================================*/
var idQuitarProducto = [];

$("#listaProductos").on('click', '.btn-quitar-producto', function(){
	//ocultar div #nuevaVenta
	if($(".btn-quitar-producto").length == 1){
		// $("#nuevaVenta").hide();
	}
	$(this).closest('.form-group').remove();
	var idProducto = $(this).data('id-producto');

	// if(localStorage.getItem('quitarProducto') != null){
	// 	idQuitarProducto.concat(localStorage.getItem('quitarProducto'));
	// } 

	idQuitarProducto.push(idProducto);

	$(".recuperar-btn[data-id-producto="+idProducto+"]").removeClass('disabled btn-default');
	$(".recuperar-btn[data-id-producto="+idProducto+"]").addClass('btn-primary btn-agregar-producto');
	sumarPrecios();
	calcularImpuesto();
	calcularCambio();
});

/*=====  End of QUITAR PRODUCTOS DE LA LISTA  ======*/

/*==========================================
=            MODIFICAR CANTIDAD            =
==========================================*/

$("#formAgregarVenta").on('change keyup', '.input-cantidad', function(){
	var input = $(this).closest('.row').find('.input-precio');
	var precio = input.data('precio');
	var cantidad = $(this).val();
	var stock = $(this).data('stock');

	precioFinal = precio * cantidad;
	input.val(precioFinal);

	if(cantidad > stock){
		Swal({
			title: 'Supero el stock',
			type: 'error',
		});
		$(this).val(stock);
		input.val(precio * stock);
	}

	sumarPrecios();
	calcularImpuesto();

});

/*=====  End of MODIFICAR CANTIDAD  ======*/

/*===============================================
=            SUMAR TODOS LOS PRECIOS            =
===============================================*/

function sumarPrecios(){
	var precioItem = $(".input-precio");

	var listaPrecios = [];
	var precioTotalVenta = 0;
	for (var i = 0; i < precioItem.length; i++) {
		listaPrecios.push(parseFloat($(precioItem[i]).val()));
	}
	for (var i2 = 0; i2 < listaPrecios.length; i2++){
		precioTotalVenta += listaPrecios[i2];
	}
	$("#precioTotalVenta").val(precioTotalVenta);
	$("#precioTotalVenta").data('total', precioTotalVenta);

}

/*=====  End of SUMAR TODOS LOS PRECIOS  ======*/

/*=====================================================
=            CALCULAR INPUESTO DE LA VENTA            =
=====================================================*/

$("#impuestoVenta").on('change keyup', function(){
	calcularImpuesto();
	if($(this).val() > 100){
		$(this).val(100);
	}
});

function calcularImpuesto(){
	var impuesto = parseFloat($("#impuestoVenta").val());
	var precioTotalVenta = parseFloat($("#precioTotalVenta").data('total'));
	precioTotalVenta = precioTotalVenta + (precioTotalVenta / 100 * impuesto);
	$("#precioTotalVenta").val(precioTotalVenta);
}

/*=====  End of CALCULAR INPUESTO DE LA VENTA  ======*/

/*======================================
=            METODO DE PAGO            =
======================================*/

// $("#inputPago").number(true, 2);
$("#inputCambio").number(true, 2);
$("#codigoTransaccion").hide();

$("select[name=metodoPago]").on('change', function(){
	if($(this).val() == 'Efectivo'){
		$("#codigoTransaccion").hide();
		$("#pagoCambio").show();
		$("#colMetodoPago").removeClass('col-md-6').addClass('col-md-4');
	} else {
		$("#colMetodoPago").removeClass('col-md-4').addClass('col-md-6');
		$("#pagoCambio").hide();
		$("#codigoTransaccion").show();
	}
});

/*=====  End of METODO DE PAGO  ======*/

/*=======================================
=            CALCULAR CAMBIO            =
=======================================*/
//tambien se tiene que calcular cuando se agregan o quitan productos
$("#inputPago").on('keyup', function(){
	calcularCambio();
});
$("#impuestoVenta").on('change keyup', function(){
	calcularCambio();
});
$("#formAgregarVenta").on('change keyup', '.input-cantidad', function(){
	calcularCambio();
});

function calcularCambio(){
	var total = $("#precioTotalVenta").val();
	var pago = $("#inputPago").val();
	var cambio = pago - total;
	if(pago > 0){	
		$("#inputCambio").val(cambio);
	}
}

/*=====  End of CALCULAR CAMBIO  ======*/

/*===================================================================
=            LISTAR LOS PRODUCTOS EN JSON Y ENVIAR DATOS POR AJAX  =
====================================================================*/

$("#formAgregarVenta").on('submit', function(event){
	event.preventDefault();
	var listaProductos = [];
	var productos = $(".lista-productos-item");

	for(var i = 0; i < productos.length; i++){
		var idProducto = $(productos[i]).find('.btn-quitar-producto').data('id-producto');
		var cantidad = parseFloat($(productos[i]).find('.input-cantidad').val());
		var stock = parseFloat($(productos[i]).find('.input-cantidad').data('stock')) - cantidad;
		var subtotal = parseFloat($(productos[i]).find('.input-precio').val());

		listaProductos.push({
			"producto_id": idProducto,
			"cantidad": cantidad,
			// "stock": stock,
			"subtotal": subtotal,
		});
	}
	var data = [{
		"vendedor_id": $("#vendedor_id").val(),
		"cliente_id": $("#cliente_id option:selected").val(),
		"impuesto": $("#impuestoVenta").val(),
		"total": $("#precioTotalVenta").val(),
		"neto": parseFloat($("#precioTotalVenta").data("total")),
		"metodo_pago": $("#metodoPago option:selected").val(),
	}];
	if($("#inputCodigoTransaccion").val() != ''){
		data[0].metodo_pago = $("#metodoPago option:selected").val() + '-' + $("#inputCodigoTransaccion").val();
	}
	data.push(listaProductos);

	cambio = $("#inputPago").val() - $("#precioTotalVenta").val();
	if(cambio < 0 && $("#metodoPago option:selected").val() == 'Efectivo') {
		Swal({
			title: 'Pago incompleto',
			type: 'warning',
		});
	} else if ($("#precioTotalVenta").val() == 0){
		Swal({
			title: 'Ningún producto seleccionado',
			type: 'warning',
		});
	} else if(isNaN($("#inputPago").val())){
		Swal({
			title: 'Pago incorrecto',
			type: 'error',
		});
	}else {
		// RESETEAR EL FORMULARIO PARA LA VENTA
		// $("#nuevaVenta").hide();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		idQuitarProducto = [];
		$("#precioTotalVenta").val('');
		$("#listaProductos").html('');
		$("#inputPago").val('');
		$("#inputCambio").val('');
		$("#inputCodigoTransaccion").val('');
		$("#cliente_id").val('');
		$("#metodoPago").val('Efectivo');
		$("#colMetodoPago").addClass('col-md-4').removeClass('col-md-6');
		$("#pagoCambio").show();
		$("#codigoTransaccion").hide();
		$.ajax({
			url: 'ajax/ventas.ajax.php?action=agregar',
			type: 'POST',
			dataType: 'json',
			data: {data: data},
		})
		.done(function(r) {
			console.log('data', data);
			console.log("r", r);
			$("#dtAgregarProductos").DataTable().ajax.reload();
			if(r.respuesta == 1){
				Swal({
					title: r.mensaje,
					type: 'success',
					showConfirmButton: false,
					timer: 2000,
				});				
			} else {
				Swal({
					title: r.mensaje,
					type: 'error',
				});
			}
		})
		.fail(function(r) {
			console.log("error", r.responseText);
		});
	}
});


/*=====  End of LISTAR LOS PRODUCTOS EN JSON  ======*/

/*===================================
=            AJAX LOADER            =
===================================*/

$(document).ajaxStart(function(){
  $(".div-spinner").css("display", "flex");
});

$(document).ajaxComplete(function(){
  $(".div-spinner").css("display", "none");
});


/*=====  End of AJAX LOADER  ======*/

/*============================================
=            EVITAR FOCO EN INPUT            =
============================================*/
//evita el foco en los input de la lista de productos
$("#listaProductos").on('focus', '.no-focus', function(){
	console.log('focus');
	if($(this).hasClass('no-focus-next') && false){
		$(this).closest('.lista-productos-item').next().find('.input-cantidad').focus();
	} else {
		$(this).closest('.row').find('.input-cantidad').focus();
	}
});

/*=====  End of EVITAR FOCO EN INPUT  ======*/
