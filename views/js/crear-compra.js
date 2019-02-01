(function(){
	function obtenerProductos(data){
		
	}
	var tabla = $('#dtProductosCompra');
	options = {
		destroy: true,
		ajax: {
			url: 'ajax/compras.ajax.php?action=obtener-productos',
		},
		columns : [
		{data : 'nombre'},
		{
			data: null,
			render: function(data){
				if(data.stock > 0){				
					return '<td><button class="btn btn-primary btn-agregar-producto-compra recuperar-btn" data-id-producto="'+data.id+'"><i class="fa fa-plus"></i></button></td>';
				} else {
					return '<td><button class="btn btn-default disabled"><i class="fa fa-plus"></i></button></td>';
				}
			}
		},
		{
			data: "imagen",
			render: function(data){
				if(data == '' || data === null){
					return "<img src='views/img/productos/default/anonymous.png' class'img-responsive' width='50px'>";
				} else {
					return "<a href='views/img/productos/"+data+"' data-toggle='lightbox'><img src='views/img/productos/"+data+"' class'img-responsive' width='50px'></a>";
				}
			}
		},
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
		],
	};
	$('#dtProductosCompra').DataTable(options);


	/*========================================================
	=            AGREGAR LOS PRODUCTOS A LA TABLA            =
	========================================================*/
	
	$('#dtProductosCompra tbody').on('click', '.btn-agregar-producto-compra', function(){
		// $("#nuevaVenta").show();
		$("#dtAgregarProductos").dataTable().fnFilter('');

		var boton = $(this);
		var data = getDataRow(boton);
		boton.removeClass('btn-primary btn-agregar-producto');
		boton.addClass('btn-default disabled');


		$("#listaProductosCompra").append(
			'<div class="form-group lista-productos-item">'+
				'<div class="row">'+
					'<div class="col-xs-6 pr-0">'+
						'<div class="input-group">'+
							'<a class="input-group-addon btn btn-danger btn-xs btn-quitar-producto" data-id-producto="'+data.id+'"><i class="fa fa-times"></i></a>'+
							'<input type="text" class="form-control no-focus" id="agregarProducto" name="agregarProducto" value="'+data.nombre+'" readonly required>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-2 px-0">'+
						'<input type="number" name="cantidad" class="form-control input-cantidad" min="1" data-stock="'+data.stock+'" value="1" required>'+
					'</div>'+
					'<div class="col-xs-4 pl-0">'+
						'<div class="input-group">'+												
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
							'<input type="text" name="precio" class="form-control no-focus no-focus-next input-precio" value="'+data.precio_compra+'" data-precio="'+data.precio_compra+'" readonly required>'+
						'</div>'+
					'</div>'+
				'</div><!-- /.row -->'+
			'</div>'
		);

		//dar formato de numero a los input con jqueryNumberFormat
		$(".input-precio").number(true, 2);
		$("#precioTotalCompra").number(true, 2);
		sumarPrecios();
		calcularImpuesto();
		// calcularCambio();
	});
	
	/*=====  End of AGREGAR LOS PRODUCTOS A LA TABLA  ======*/


	/*====================================================
	=            QUITAR PRODUCTOS DE LA LISTA            =
	====================================================*/
	var idQuitarProducto = [];

	$("#listaProductosCompra").on('click', '.btn-quitar-producto', function(){
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
		// calcularCambio();
	});

	/*=====  End of QUITAR PRODUCTOS DE LA LISTA  ======*/


	/*==============================================
	=            NAVEGACION EN LA TABLA            =
	==============================================*/

	$("#dtProductosCompra").on('draw.dt', function(){
		if(idQuitarProducto != null){
			for(var i = 0; i < idQuitarProducto.length; i++){
				$(".recuperar-btn[data-id-producto="+idQuitarProducto[i]+"]").removeClass('disabled btn-default');
				$(".recuperar-btn[data-id-producto="+idQuitarProducto[i]+"]").addClass('btn-primary btn-agregar-producto');
			}
		}
	});

	/*=====  End of NAVEGACION EN LA TABLA  ======*/

	/*==========================================
	=            MODIFICAR CANTIDAD            =
	==========================================*/

	$("#formAgregarCompra").on('change keyup', '.input-cantidad', function(){
		var input = $(this).closest('.row').find('.input-precio');
		var precio = input.data('precio');
		var cantidad = $(this).val();
		var stock = $(this).data('stock');

		var precioFinal = precio * cantidad;
		input.val(precioFinal);

		sumarPrecios();
		// calcularImpuesto();

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
		$("#precioTotalCompra").val(precioTotalVenta);
		$("#precioTotalCompra").data('total', precioTotalVenta);

	}

	/*=====  End of SUMAR TODOS LOS PRECIOS  ======*/


	/*=====================================================
	=            CALCULAR INPUESTO DE LA VENTA            =
	=====================================================*/

	$("#impuestoCompra").on('change keyup', function(){
		calcularImpuesto();
		if($(this).val() > 100){
			$(this).val(100);
		}
	});

	function calcularImpuesto(){
		var impuesto = parseFloat($("#impuestoCompra").val());
		var precioTotalVenta = parseFloat($("#precioTotalCompra").data('total'));
		precioTotalVenta = precioTotalVenta + (precioTotalVenta / 100 * impuesto);
		$("#precioTotalCompra").val(precioTotalVenta);
	}

	/*=====  End of CALCULAR INPUESTO DE LA VENTA  ======*/


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

	/*===================================================================
	=            LISTAR LOS PRODUCTOS EN JSON Y ENVIAR DATOS POR AJAX  =
	====================================================================*/

	$("#formAgregarCompra").on('submit', function(event){
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
			"impuesto": $("#impuestoCompra").val(),
			"total": $("#precioTotalCompra").val(),
			"neto": parseFloat($("#precioTotalCompra").data("total")),
		}];
		data.push(listaProductos);

		
			// RESETEAR EL FORMULARIO PARA LA VENTA
			// $("#nuevaVenta").hide();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			idQuitarProducto = [];
			$("#precioTotalCompra").val('');
			$("#listaProductosCompra").html('');
			$.ajax({
				url: 'ajax/compras.ajax.php?action=agregar',
				type: 'POST',
				dataType: 'json',
				data: {data: data},
			})
			.done(function(r) {
				// console.log('data', data);
				console.log("r", r);
				$("#dtProductosCompra").DataTable().ajax.reload();
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
	});


	/*=====  End of LISTAR LOS PRODUCTOS EN JSON  ======*/
	
})();