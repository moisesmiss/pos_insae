$(document).on('click', '[data-toggle="lightbox"]', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();
});

function limpiarForm(){
	$("#modalAgregarProducto").on('hidden.bs.modal', function(){
		$(this).find('form')[0].reset();
		$("#modalAgregarProducto .modal-title").text('Agregar Producto');
		$("#modalAgregarProducto .prev-img").attr('src', 'views/img/productos/default/anonymous.png');
		$("#formAgregarProducto textarea[name=descripcion]").text('');
		$("#categoria_id").text('Seleccionar Categoria');
		$("#categoria_id").val('');
		$("#formAgregarProducto input[name=id]").val('');
		var ias = $(".prev-img").imgAreaSelect({instance: true});
		ias.cancelSelection();
	});
}

var tablaProductos = $("#dtProductos");

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
	{"data" : "descripcion"},
	{"data" : "categoria"},
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
	{
		"data" : "precio_compra",

	},
	{"data" : "precio_venta"},
	{"data" : "creado_en"},
	{
		"data" : null,
		"defaultContent" : "<td><div class='btn-group'><button class='btn btn-warning btn-editar-producto' data-toggle='modal' data-target='#modalAgregarProducto'><i class='fa fa-pencil'></i></button><button data-toggle='modal' data-target='#modalEliminarProducto' class='btn btn-danger btn-eliminar-producto'><i class='fa fa-times'></i></button></div></td>"
	}
	]
}


/*===============================================
=            OBTENER DATOS PRODUCTOS            =
===============================================*/

function getDataProducto(tbody, table){
	$(tbody).on('click', ".btn-editar-producto", function(){
		var tr = $(this).closest('tr');
		if(tr.hasClass('child')){
			tr = tr.prev();
		}

		var data = table.row(tr).data();

		//rellenar el formulario
		$("#modalAgregarProducto .modal-title").text('Editar Producto');
		$("#formAgregarProducto input[name=codigo]").val(data.codigo);
		$("#formAgregarProducto input[name=nombre]").val(data.nombre);
		$("#formAgregarProducto textarea[name=descripcion]").text(data.descripcion);
		$("#formAgregarProducto input[name=stock]").val(data.stock);
		$("#formAgregarProducto input[name=precio_compra]").val(data.precio_compra);
		$("#formAgregarProducto input[name=precio_venta]").val(data.precio_venta);
		$("#porcentajeUtilidad").val(data.precio_venta / data.precio_compra * 100 - 100);
		$("#categoria_id").text(data.categoria);
		$("#categoria_id").val(data.categoria_id);
		$("#formAgregarProducto input[name=id]").val(data.id);
		if(data.imagen == ''){
			$(".prev-img").attr('src', 'views/img/productos/default/anonymous.png');
		} else {
			$(".prev-img").attr('src', 'views/img/productos/'+data.imagen);
		}
	});
}

/*=====  End of OBTENER DATOS PRODUCTOS  ======*/



/*==============================================
=            LISTAR TABLA PRODUCTOS            =
==============================================*/

function listarDataTableProductos(){
	var table = tablaProductos.DataTable(options);
	getDataProducto(tablaProductos, table);
	limpiarForm();
}
listarDataTableProductos();

/*=====  End of LISTAR TABLA PRODUCTOS  ======*/

/*========================================
=            AGREGAR PRODUCTO            =
========================================*/

$("#formAgregarProducto").on("submit", function(event){
	event.preventDefault();
	var form = $(this);
	var data = new FormData(this);
	console.log("data", data);

	$.ajax({
		url: 'ajax/productos.ajax.php?action=agregar',
		type: 'POST',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
	})
	.done(function(respuesta) {
		console.log("respuesta", respuesta);
		tablaProductos.DataTable().ajax.reload();
		
		if(respuesta.respuesta == true){
			$("#modalAgregarProducto").modal('hide');
			// form[0].reset();
			Swal({
				type: 'success',
				toast: true,
				timer: 3000,
				title: respuesta.mensaje,
				showConfirmButton: false,
				position: 'bottom-end',
			});
		} else {
			Swal({
				type: 'error',
				title: respuesta.mensaje,
				confirmButtonText: 'Aceptar',
			});
		}
	})
	.fail(function(r){
		console.log("error", r.responseText);
	});	
	
});

/*=====  End of AGREGAR PRODUCTO  ======*/

/*=========================================
=            ELIMINAR PRODUCTO            =
=========================================*/

$("#dtProductos tbody").on('click', '.btn-eliminar-producto', function(){
	var tr = $(this).closest('tr');
	if(tr.hasClass('child')){
		tr = tr.prev();
	}
	var data = $("#dtProductos").DataTable().row(tr).data();

	Swal({
		type: 'warning',
		title: '¿Seguro que desea eliminar el producto '+data.nombre+'?',
		text: 'Los registros como ventas relacionados a este producto se eliminarán',
		confirmButtonText: 'SI',
		cancelButtonText: 'NO',
		cancelButtonColor: '#3085d6',
		confirmButtonColor: '#d33',
		showCancelButton: true,
		focusCancel: true,
	}).then(function(result){
		if(result.value){
			$.ajax({
				url: 'ajax/productos.ajax.php?action=eliminar',
				type: 'POST',
				data: data,
			})
			.done(function(resultado) {
				if(resultado == 1){
					tablaProductos.DataTable().ajax.reload();
					Swal({
						type: 'success',
						title: 'Producto eliminado correctamente',
						toast: true,
						showConfirmButton: false,
						timer: 3000,
						position: 'bottom-end',
					});					
				} else {
					Swal({
						type: 'error',
						title: 'Error al eliminar producto',
					});
				}
			})
			.fail(function(resultado) {
				console.log("error", resultado);
			});
			
		}

	});
});

/*=====  End of ELIMINAR PRODUCTO  ======*/


/*================================================================
=            AGREGAR PRECIO VENTA MEDIANTE PORCENTAJE            =
================================================================*/

$("#formAgregarProducto input[name='precio_compra'], #porcentajeUtilidad").on('change keyup', function(){
	var inputCheck = $("#checkPorcentaje");

	if(inputCheck.prop('checked')){
		var inputPrecioCompra = $("#formAgregarProducto input[name='precio_compra']");
		var inputPrecioVenta = $("#formAgregarProducto input[name='precio_venta']");
		var porcentaje = $("#porcentajeUtilidad").val();
		var precioCompra = inputPrecioCompra.val();
		var precioVenta = Number(precioCompra) + (Number(precioCompra) / 100 * Number(porcentaje));
		precioVenta = precioVenta.toFixed(2);

		inputPrecioVenta.val(precioVenta);		
	} 
});

// TODO: mejorar que al momento de hacer click al check se calcule otra vez el precio con el %
$("#labelPorcentaje, .iCheck-helper").on("click", function(){
	var inputPrecioVenta = $("#formAgregarProducto input[name='precio_venta']");
	var inputPorcentaje = $("#porcentajeUtilidad");

	if(inputPrecioVenta[0].readOnly){
		inputPrecioVenta.removeAttr('readOnly');
	} else {
		inputPrecioVenta.attr('readOnly', true);
	}

	if(inputPorcentaje[0].readOnly){
		inputPorcentaje.removeAttr('readOnly');
	} else {
		inputPorcentaje.attr('readOnly', true);
	}
});

/*=====  End of AGREGAR PRECIO VENTA MEDIANTE PORCENTAJE  ======*/


/*=============================================
=            	PREVISUALIZAR IMAGEN PRODUCTO =
=============================================*/

$('#imagenProducto').on('change', function(event) {
	inputImagen = $(this);
	event.preventDefault();
	/* Act on the event */
	var imagen = this.files[0];

	if(imagen.size > 2000000){
		inputImagen.val('');
		Swal({
			type: 'error',
			title: 'Imagen muy pesada, elija una imagen menor a 2MB',
		});
	} else {
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on('load', function(event){
			// $(".div-prev-img img").css('width', '100%');
			var rutaImagen = event.target.result;

			img = $(".prev-img");
			img.attr('src', rutaImagen);
			var imageBase64 = new Image();
			imageBase64.src = rutaImagen;

			img.imgAreaSelect({remove: true});
			setTimeout(function(){
				var relacionAspecto = imageBase64.width / img.width();
				if(imageBase64.width > imageBase64.height){
					var sizeReference = ((imageBase64.width - imageBase64.height) / 2);
					var x1 = imageBase64.width - imageBase64.height - sizeReference;
					var x2 = imageBase64.height + sizeReference;
					var y1 = 0;
					var y2 = imageBase64.height;
				} else {
					var sizeReference = ((imageBase64.height - imageBase64.width) / 2);
					var y1 = imageBase64.height - imageBase64.width - sizeReference;
					var y2 = imageBase64.width + sizeReference;
					var x1 = 0;
					var x2 = imageBase64.width;
				}

				

				$("input[name=x1]").val(x1);
				$("input[name=x2]").val(x2);
				$("input[name=y1]").val(y1);
				$("input[name=y2]").val(y2);
				console.log('x1', x1);
				console.log('x2', x2);
				console.log('y1', y1);
				console.log('y2', y2);
				
				img.imgAreaSelect({
					imageWidth: imageBase64.width,
					imageHeight: imageBase64.height,
					aspectRatio: '1:1',
					handles: true,
					x1: x1,
					y1: y1,
					x2: x2,
					y2: y2,
					parent: '.modal-content',
					persistent: true,
					onInit: function(img, selection){
						console.log('se inizializo ias');
						// $("input[name=x1]").val(selection.x1);
						// $("input[name=x2]").val(selection.x2);
						// $("input[name=y1]").val(selection.y1);
						// $("input[name=y2]").val(selection.y2);
					},
					onSelectEnd: function(img, selection){
						$("input[name=x1]").val(selection.x1);
						$("input[name=x2]").val(selection.x2);
						$("input[name=y1]").val(selection.y1);
						$("input[name=y2]").val(selection.y2);
					}
				});
			}, 500);


		});
	}

	

});

/*=====  End of 	PREVISUALIZAR IMAGEN PRODUCTO  ======*/
