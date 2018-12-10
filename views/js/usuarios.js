var tablaUsuarios = $("#dtUsuarios");

var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/usuarios.ajax.php?action=listar",
	}, 
	"columns" : [
	{"data": "nombre"},
	{"data": "email"},
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
		"defaultContent" : "<td><div class='btn-group'><button class='btn btn-warning btn-editar-usuario' data-toggle='modal' data-target='#modalEditarUsuario' data-id-usuario=''><i class='fa fa-pencil'></i></button><button data-toggle='modal' data-target='#modalEliminarUsuario' class='btn btn-danger btn-eliminar-usuario'><i class='fa fa-times'></i></button></div></td>"
	}
	]
}

function getDataUsuario(tbody, table){
	$(tbody).on("click", ".btn-editar-usuario", function(){
		var tr = $(this).closest('tr');
		//si la tabla esta en su modo responsive
		if (tr.hasClass('child')) {
			tr = tr.prev();
		}
    	//obtener los datos de la fila en la tabla
    	var data = table.row(tr).data();

		//rellenar los datos del formulario
		$("#nombre").val(data.nombre);
		$("#email").val(data.email);
		$("#idEditarUsuario").val(data.persona_id);
		$("#formEditarUsuario").find("input[name=emailActual]").val(data.email);
	});
}

function cambiarEstadoUsuario(tbody, table){
	$(tbody).on("click", ".btn-estado-usuario", function(){
		var tr = $(this).closest('tr');
		//si la tabla esta en su modo responsive
		if (tr.hasClass('child')) {
			tr = tr.prev();
		}
    	//obtener los datos de la fila en la tabla
    	var data = table.row(tr).data();
    	data = {
    		"persona_id" : data.persona_id,
    		"estado" : data.estado,
    	}

    	$.ajax({
    		url: 'ajax/usuarios.ajax.php?action=cambiar-estado',
    		type: 'post',
    		data: data,
    	})
    	.done(function(respuesta) {
    		if(respuesta == 1){
    			tablaUsuarios.DataTable().ajax.reload();
    		} else {
    			swal({
    				type: 'error',
    				title: respuesta,
    				confirmButtonText: 'Aceptar',
    			});
    		}
    	});

    });
}

function getIdUsuario(tbody, table){
	$(tbody).on("click", ".btn-eliminar-usuario", function(){
		var tr = $(this).closest('tr');
		//si la tabla esta en su modo responsive
		if (tr.hasClass('child')) {
			tr = tr.prev();
		}
    	//obtener los datos de la fila en la tabla
    	var data = table.row(tr).data();
    	$("#idEliminarUsuario").val(data.persona_id);
    });
}

/*=======================================
=            LISTAR USUARIOS            =
=======================================*/

function listarDataTableUsuarios(){
	var table = tablaUsuarios.DataTable(options);
	getDataUsuario($("#dtUsuarios tbody"), table);
	getIdUsuario($("#dtUsuarios tbody"), table);
	cambiarEstadoUsuario($("#dtUsuarios tbody"), table);
}
listarDataTableUsuarios();

/*=====  End of LISTAR USUARIOS  ======*/

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
		data: datos,
	})
	.done(function(respuesta) {
		tablaUsuarios.DataTable().ajax.reload();
		$("#modalAgregarUsuario").modal('hide');
		form[0].reset();
		if(respuesta == 1){
			swal({
				toast: true,
				type: 'success',
				title: 'Datos agregados correctamente',
				position: 'bottom-end',
				timer: 3000,
				showConfirmButton: false,
			});
		} else {
			swal({
				type: 'error',
				title: respuesta,
				confirmButtonText: 'Aceptar',
			});
		}
	});
	
});

/*=====  End of AGREGAR USUARIO  ======*/

/*======================================
=            EDITAR USUARIO            =
======================================*/

$("#formEditarUsuario").on("submit", function(event){
	event.preventDefault();
	var data = $(this).serialize();

	$.ajax({
		type : "post",
		url : "ajax/usuarios.ajax.php?action=editar",
		data : data,
		success: function(respuesta){
			if(respuesta == 1){
				tablaUsuarios.DataTable().ajax.reload();
				$("#modalEditarUsuario").modal('hide');

				swal({
					toast : true,
					type: 'success', 
					position: 'bottom-end',
					title: 'Datos editados correctamente',
					timer: 3000,
					showConfirmButton: false,
					// confirmButtonText: 'Cerrar',
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

$("#formEliminarUsuario").on("submit", function(event){
	event.preventDefault();
	var data = $(this).serialize();

	$.ajax({
		url: 'ajax/usuarios.ajax.php?action=eliminar',
		type: 'post',
		data: data,
	})
	.done(function(respuesta) {
		$("#modalEliminarUsuario").modal('hide');
		if(respuesta == 1){

			tablaUsuarios.DataTable().ajax.reload();
			swal({
				toast: true,
				position: 'bottom-end',
				type: 'success',
				title: 'Usuario eliminado correctamente',
				showConfirmButton: false,
				timer: 3000,
			});
		} else {
			swal({
				type: 'error',
				title: respuesta,
				confirmButtonText: 'Aceptar',
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
	var data = new FormData();
	data.append('email', email);


	$.ajax({
		url: 'ajax/usuarios.ajax.php?action=comprobar-usuario',
		type: 'post',
		contentType:false,
		cache: false,
		processData: false,
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
			input.parents('form').find('button[type=submit]').removeAttr('disabled')
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
	}

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

