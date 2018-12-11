var tablaProductos = $("#dtProductos");

var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/productos.ajax.php?action=listar",
	}, 
	"columns" : [
	{
		"data" : "imagen",
		"render" : function(data){
			if(data == '' || !data){
				return "<img src='views/img/productos/default/anonymous.png' class'img-responsive' width='50px'>";
			} else {
				return "<img src='views/img/productos/"+data.imagen+"' class'img-responsive' width='50px'>";
			}
		}
	},
	{"data": "codigo"},
	{"data" : "nombre"},
	{
		"data" : "descripcion",
		"defaultContent": "Vacio"
	},
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
		"defaultContent" : "<td><div class='btn-group'><button class='btn btn-warning btn-editar-producto' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button data-toggle='modal' data-target='#modalEliminarProducto' class='btn btn-danger btn-eliminar-producto'><i class='fa fa-times'></i></button></div></td>"
	}
	]
}


/*==============================================
=            LISTAR TABLA PRODUCTOS            =
==============================================*/

function listarDataTableProductos(){
	var table = tablaProductos.DataTable(options);
}
listarDataTableProductos();

/*=====  End of LISTAR TABLA PRODUCTOS  ======*/

$("#formAgregarProducto").on("submit", function(event){
	event.preventDefault();
	var form = $(this);
	var data = form.serialize();

	$.ajax({
		url: 'ajax/productos.ajax.php?action=agregar',
		type: 'POST',
		data: data,
	})
	.done(function(respuesta) {
		console.log("respuesta", respuesta);
		
		if(respuesta == 1){
			$("#modalAgregarProducto").modal('hide');
			tablaProductos.DataTable().ajax.reload();
			form[0].reset();
			Swal({
				type: 'success',
				toast: true,
				timer: 3000,
				title: 'Producto agregado correctamente',
				showConfirmButton: false,
				position: 'bottom-end',
			});
		} else {
			Swal({
				type: 'error',
				title: 'Error al agregar producto',
				confirmButtonText: 'Aceptar',
			});
		}
	});
	
	
});

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
