$('#formCliente input[name=telefono]').inputmask({"mask": "(999) 999-9999"});

$("#modalCliente").on('hidden.bs.modal', function(){
	var form = $("#formCliente");
	$("#modalCliente .modal-title").text('Agregar cliente');
		$("#formCliente input[name=id]").val();

	form[0].reset();
});


/*=======================================
=            LISTAR CLIENTES            =
=======================================*/

var tablaClientes = $("#dtClientes");

var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/clientes.ajax.php?action=listar",
	}, 
	"columns" : [
	{"data" : "nombre"},
	{"data" : "correo"},
	{"data" : "telefono"},
	{"data" : "direccion"},
	{"data": "ultima_compra"},
	{"data" : "fecha_nacimiento"},
	{"data" : "creado_en"},
	{
		"data" : null,
		"defaultContent" : "<td><div class='btn-group'><button class='btn btn-warning btn-editar-cliente' data-toggle='modal' data-target='#modalCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn-eliminar-cliente'><i class='fa fa-times'></i></button></div></td>"
	}
	]
}
tablaClientes.DataTable(options);

/*=====  End of LISTAR CLIENTES  ======*/


/*=======================================
=            AGREGAR CLIENTE            =
=======================================*/

$("#formCliente").on('submit', function(event){
	event.preventDefault();

	var data = new FormData(this);
	
	$.ajax({
		url: 'ajax/clientes.ajax.php?action=agregar_editar',
		type: 'POST',
		dataType: 'json',
		data: data,
		cache: false,
		processData: false,
		contentType: false,
	})
	.done(function(respuesta) {
		tablaClientes.DataTable().ajax.reload();
		if(respuesta.respuesta){
			$('#modalCliente').modal('hide');
			Swal({
				type: 'success',
				title: respuesta.mensaje,
				showConfirmButton: false,
				timer: 3000,
				toast: true,
				position: 'bottom-right',
			});
		} else {
			Swal({
				type: 'error',
				title: respuesta.mensaje,
			});
		}
	})
	.fail(function(respuesta) {
		console.log("error", respuesta.responseText);
	});

});

/*=====  End of AGREGAR CLIENTE  ======*/

/*======================================
=            EDITAR CLIENTE            =
======================================*/

$("#dtClientes tbody").on('click', '.btn-editar-cliente', function(){
	var tr = $(this).closest('tr');
	if(tr.hasClass('child')){
		tr = tr.prev();
	}
	var data = tablaClientes.DataTable().row(tr).data();

	$("#modalCliente .modal-title").text('Editar cliente');
	$('#formCliente input[name=nombre]').val(data.nombre);
	$('#formCliente input[name=correo]').val(data.correo);
	$('#formCliente input[name=fecha_nacimiento]').val(data.fecha_nacimiento);
	$('#formCliente input[name=fecha_nacimiento]').val(data.fecha_nacimiento);
	$('#formCliente input[name=telefono]').val(data.telefono);
	$('#formCliente input[name=direccion]').val(data.direccion);
	$("#formCliente input[name=id]").val(data.id);

});

/*=====  End of EDITAR CLIENTE  ======*/


/*========================================
=            ELIMINAR CLIENTE            =
========================================*/

$('#dtClientes tbody').on('click', '.btn-eliminar-cliente', function(){
	var tr = $(this).closest('tr');
	if(tr.hasClass('child')){
		tr = tr.prev();
	}
	var data = tablaClientes.DataTable().row(tr).data();
	Swal({
		type: 'warning',
		title: '¿Seguro que desea eliminar el cliente '+data.nombre+'?',
		text: 'Los registros como ventas relacionados a este cliente se eliminarán',
		confirmButtonText: 'SI',
		cancelButtonText: 'NO',
		cancelButtonColor: '#3085d6',
		confirmButtonColor: '#d33',
		showCancelButton: true,
		focusCancel: true,
	}).then(function(r){
		if(r.value){
			$.ajax({
				url: 'ajax/clientes.ajax.php?action=eliminar',
				type: 'POST',
				dataType: 'json',
				data: data,
			})
			.done(function(respuesta) {
				tablaClientes.DataTable().ajax.reload();
				if(respuesta.respuesta){
					Swal({
						type: 'success',
						title: respuesta.mensaje,
						showConfirmButton: false,
						timer: 3000,
						toast: true,
						position: 'bottom-right',
					});
				} else {
					Swal({
						type: 'error',
						title: respuesta.mensaje,
					});
				}
			})
			.fail(function(respuesta) {
				console.log("error", respuesta.responseText);
			});
			
		}
	});
});

/*=====  End of ELIMINAR CLIENTE  ======*/
