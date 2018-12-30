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

$('#dtAgregarProductos tbody').on('click', '.btn-agregar-producto', function(){
	$("#dtAgregarProductos").dataTable().fnFilter('');

	var boton = $(this);
	var tr = $(this).closest('tr');
	if(tr.hasClass('child')){
		tr = tr.prev();
	}
	var data = $('#dtAgregarProductos').DataTable().row(tr).data();

	// quitar el id de la lista de localstorage
	var listaIdProductos = JSON.parse(localStorage.getItem('quitarProducto'));
	if(listaIdProductos != null){

		var index = listaIdProductos.indexOf(parseInt(data.id));
		if (index > -1) {
		  listaIdProductos.splice(index, 1);
		  idQuitarProducto.splice(index, 1);
		}
		localStorage.setItem('quitarProducto', JSON.stringify(listaIdProductos));
	}

	boton.removeClass('btn-primary btn-agregar-producto');
	boton.addClass('btn-default disabled');

	$("#listaProductos").append(
		'<div class="form-group">'+
			'<div class="row">'+
				'<div class="col-xs-6 pr-0">'+
					'<div class="input-group">'+
						'<a class="input-group-addon btn btn-danger btn-xs btn-quitar-producto" data-id-producto="'+data.id+'"><i class="fa fa-times"></i></a>'+
						'<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="'+data.nombre+'" readonly required>'+
					'</div>'+
				'</div>'+
				'<div class="col-xs-2 px-0">'+
					'<input type="number" name="cantidad" class="form-control input-cantidad" min="1" max="'+data.stock+'" data-stock="'+data.stock+'" value="1" required>'+
				'</div>'+
				'<div class="col-xs-4 pl-0">'+
					'<div class="input-group">'+												
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						'<input type="text" name="precio" class="form-control input-precio" value="'+data.precio_venta+'" data-precio="'+data.precio_venta+'" readonly required>'+
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
});

/*=====  End of AGREGAR PRODUCTOS  ======*/

/*==============================================
=            NAVEGACION EN LA TABLA            =
==============================================*/

$("#dtAgregarProductos").on('draw.dt', function(){
	if(localStorage.getItem('quitarProducto') != null){
		var listaIdProductos = JSON.parse(localStorage.getItem('quitarProducto'));
		for(var i = 0; i < listaIdProductos.length; i++){
			$(".recuperar-btn[data-id-producto="+listaIdProductos[i]+"]").removeClass('disabled btn-default');
			$(".recuperar-btn[data-id-producto="+listaIdProductos[i]+"]").addClass('btn-primary btn-agregar-producto');
		}
	}
});

/*=====  End of NAVEGACION EN LA TABLA  ======*/


/*====================================================
=            QUITAR PRODUCTOS DE LA LISTA            =
====================================================*/

localStorage.removeItem('quitarProducto');
var idQuitarProducto = [];
$("#listaProductos").on('click', '.btn-quitar-producto', function(){
	$(this).closest('.form-group').remove();

	var idProducto = $(this).data('id-producto');


	// if(localStorage.getItem('quitarProducto') != null){
	// 	idQuitarProducto.concat(localStorage.getItem('quitarProducto'));
	// } 

	idQuitarProducto.push(idProducto);
	localStorage.setItem('quitarProducto', JSON.stringify(idQuitarProducto));

	$(".recuperar-btn[data-id-producto="+idProducto+"]").removeClass('disabled btn-default');
	$(".recuperar-btn[data-id-producto="+idProducto+"]").addClass('btn-primary btn-agregar-producto');
	sumarPrecios();
	calcularImpuesto();
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

$("#inputPago").number(true, 2);
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

/*=======================================
=            FINALIZAR VENTA            =
=======================================*/

$("#btnFinalizarVenta").on('click', function(event){
	event.preventDefault();
	cambio = $("#inputPago").val() - $("#precioTotalVenta").val();
	if(cambio < 0){
		Swal({
			title: 'Pago incompleto',
			type: 'warning',
		});
	}
});

/*=====  End of FINALIZAR VENTA  ======*/


