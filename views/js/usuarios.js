/*=======================================
=            LISTAR USUARIOS            =
=======================================*/

var tablaUsuarios = $("#dtUsuarios");

var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/usuarios.ajax.php?action=listar",
	},
	dom: '<"row"<"col-md-6"B><"col-md-6"f>>'+
	"<'row'<'col-sm-12'tr>>"+
	"<'row'<'col-sm-6'i><'col-sm-6'p>>",
	buttons: {
		dom : {
			button : {
				tag: 'button',
				className: 'btn',
			},
			container: {
				className: 'btn-group',
			}
		},
		buttons:[
		{
			extend: 'excelHtml5',
			text: '<i class="fa fa-file-excel-o"></i>',
			className: 'btn-success',
			titleAttr: 'Exportar datos en Excel',
			filename: 'usuarios',
			exportOptions : {
				columns : ':visible :not(:last-child)',
			},
		},
		{
			extend: 'pdfHtml5',
			text: '<i class="fa fa-file-pdf-o"></i>',
			className: 'btn-danger',
			titleAttr: 'Exportar datos en PDF',
			filename: 'usuarios',
			exportOptions : {
				columns : ':visible :not(:last-child)',
			},
		},
		{
			extend: 'csvHtml5',
			text: '<i class="fa fa-file-text-o"></i>',
			className: 'btn-primary',
			titleAttr: 'Exportar datos en CSV',
			filename: 'usuarios',
			exportOptions : {
				columns : ':visible :not(:last-child)',
			},
		},
		{
			extend: 'colvis',
			text: '<i class="fa fa-eye"></i>',
			titleAttr: 'Columnas visibles',
			className: 'btn-default',
			columns: [':not(:last-child)'],
		},
		]
	},
	"columns" : [
	{"data": "nombre"},
	{"data": "email"},
	{"data": "perfil"},
	{
		"data" : null,
		"render" : function(data){
			if(data.estado == 'Y'){
				return "<button class='btn btn-success btn-xs btn-estado-usuario' data-value='"+data.estado+"'>Activado</button>";
			} else {
				return "<button class='btn btn-danger btn-xs btn-estado-usuario' data-value='"+data.estado+"'>Desactivado</button>";
			}
		}
	},
	{"data": "ultimo_login"},
	{
		"data" : null,
		"defaultContent" : "<td>"+
		"<div class='btn-group'>"+
		"<button class='btn btn-warning btn-editar-usuario' data-id-usuario=''><i class='fa fa-pencil'></i></button>"+
		"<button class='btn btn-danger btn-eliminar-usuario'><i class='fa fa-times'></i></button>"+
		"</div>"+
		"</td>"
	}
	]
};
tablaUsuarios.DataTable(options);

/*=====  End of LISTAR USUARIOS  ======*/

/*====================================================
=            ACTIVAR O DESACTIVAR USUARIO            =
====================================================*/

$("#dtUsuarios tbody").on('click', '.btn-estado-usuario', function(){
	var data = getDataRow($(this));
	data = {
		"persona_id" : data.persona_id,
		"estado" : data.estado,
	};

	$.ajax({
		url: 'ajax/usuarios.ajax.php?action=cambiar-estado',
		type: 'post',
		data: data,
	})
	.done(function(respuesta) {
		tablaUsuarios.DataTable().ajax.reload();
		if(respuesta == 1){
		} else {
			swal({
				type: 'error',
				title: respuesta,
				confirmButtonText: 'Aceptar',
			});
		}
	});
});

/*=====  End of ACTIVAR O DESACTIVAR USUARIO  ======*/

/*=======================================
=            AGREGAR USUARIO            =
=======================================*/

$('#formAgregarUsuario').on('submit', function(event){
	event.preventDefault();
	var form = $(this);
	var datos = form.serialize();

	$.ajax({
		url: 'ajax/usuarios.ajax.php?action=agregar',
		type: 'post',
		dataType: 'json',
		data: datos,
	})
	.done(function(r) {
		console.log("r", r);
		tablaUsuarios.DataTable().ajax.reload();
		$("#modalAgregarUsuario").modal('hide');
		form[0].reset();

		if(r.respuesta == 1){
			toast({
				type: 'success',
				title: r.mensaje,
			});
		} else {
			Swal({
				type: 'error',
				title: r.mensaje,
				confirmButtonText: 'Aceptar',
			});
		}
	});

});

/*=====  End of AGREGAR USUARIO  ======*/

/*======================================
=            EDITAR USUARIO            =
======================================*/
//rellenar formulario
$("#dtUsuarios tbody").on("click", '.btn-editar-usuario', function(event){
	$("#modalEditarUsuario").modal();	
	var data = getDataRow($(this));

	$("#formEditarUsuario input[name=nombre]").val(data.nombre);
	$("#formEditarUsuario input[name=email]").val(data.email);
	$("#formEditarUsaurio select").val(data.perfil_id);
	$("#idEditarUsuario").val(data.persona_id);
	$("#emailActual").val(data.email);
});

$("#btnEditarUsuario").on('click', function(event){
	event.preventDefault();
	
	var data = $("#formEditarUsuario").serialize();
	$.ajax({
		type : "post",
		url : "ajax/usuarios.ajax.php?action=editar",
		data : data,
		success: function(respuesta){
			if(respuesta == 1){
				tablaUsuarios.DataTable().ajax.reload();
				$("#modalEditarUsuario").modal('hide');

				toast({
					type: 'success',
					title: 'Usuario editado correctamente',
				});
			} else {
				alert("Error al editar");
			}
		}
	});
});

/*=====  End of EDITAR USUARIO  ======*/

/*========================================
=            ELIMINAR USUARIO            =
========================================*/

$('#dtUsuarios tbody').on('click', '.btn-eliminar-usuario', function(){
	var data = getDataRow($(this));
	Swal({
		type: 'warning',
		title: '¿Seguro que desea eliminar el usuario '+data.nombre+'?',
		confirmButtonText: 'SI',
		cancelButtonText: 'NO',
		cancelButtonColor: '#3085d6',
		confirmButtonColor: '#d33',
		showCancelButton: true,
		focusCancel: true,
	}).then(function(result){
		if(result.value){
			$.ajax({
				url: 'ajax/usuarios.ajax.php?action=eliminar',
				type: 'POST',
				data: data,
			})
			.done(function(resultado) {
				if(resultado == 1){
					tablaUsuarios.DataTable().ajax.reload();
					Swal({
						type: 'success',
						title: 'Usuario eliminado correctamente',
						toast: true,
						showConfirmButton: false,
						timer: 3000,
						position: 'bottom-end',
					});					
				} else {
					Swal({
						type: 'error',
						title: resultado,
					});
				}
			})
			.fail(function(resultado) {
				console.log("error", resultado);
			});	
		}
	});
});

/*=====  End of ELIMINAR USUARIO  ======*/

/*=======================================================
=            VALIDAR SI YA EXISTE EL USUARIO            =
=======================================================*/

$("#formAgregarUsuario input[name=email]").on('keyup' ,function(){
	var input = $(this);
	var email = input.val();
	var data = {
		"email" : email,
	};


	$.ajax({
		url: 'ajax/usuarios.ajax.php?action=comprobar-usuario',
		type: 'post',
		data: data,
	})
	.done(function(respuesta) {
		if(respuesta){
			input.parents('.form-group').addClass('has-error');
			input.parents('.form-group').children('.help-block').text('El usuario ya existe');
			input.parents('form').find('button[type=submit]').attr('disabled', 'true');

		} else {
			input.parents('.form-group').removeClass('has-error');
			input.parents('.form-group').children('.help-block').text('');
			input.parents('form').find('button[type=submit]').removeAttr('disabled');
		}
	});
});

/*=====  End of VALIDAR SI YA EXISTE EL USUARIO  ======*/

/*==========================================================
=            VALIDAR USUARIO REPETIDO EN EDITAR            =
==========================================================*/

$("#formEditarUsuario input[name=email]").on('keyup', function(){
	var input = $(this);
	var emailActual = $("#formEditarUsuario input[name=emailActual]").val();
	var email = input.val();

	var data = {
		email: email,
		emailActual: emailActual
	};

	$.ajax({
		url: 'ajax/usuarios.ajax.php?action=comprobar-usuario-editar',
		type: 'POST',
		data: data,
	})
	.done(function(respuesta) {
		if(respuesta){
			input.parents(".form-group").addClass('has-error');
			input.parents('.form-group').children('.help-block').text('El correo ya esta en uso');
			input.parents('form').find('button[type=submit]').attr('disabled', 'true');
		} else {
			input.parents(".form-group").removeClass('has-error');
			input.parents('.form-group').children('.help-block').text('');
			input.parents('form').find('button[type=submit]').removeAttr('disabled');
		}
	});

});

/*=====  End of VALIDAR USUARIO REPETIDO EN EDITAR  ======*/

