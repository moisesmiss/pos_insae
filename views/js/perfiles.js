var tablaPerfiles = $("#dtPerfiles");
var btnEstadoPerfil = "";
btnEstadoPerfil = "<button class='btn btn-success btn-xs'>Activado</button>";

var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/perfiles.ajax.php?action=listar",
	}, 
	"columns": [
	{"data": "nombre"},
	{
		"data" : null,
		"defaultContent" : "<td><div class='btn-group'><button class='btn btn-warning btn-editar-perfil' data-toggle='modal' data-target='#modalEditarPerfil' data-id-perfil=''><i class='fa fa-pencil'></i></button><button data-toggle='modal' data-target='#modalEliminarPerfil' class='btn btn-danger btn-eliminar-perfil'><i class='fa fa-times'></i></button></div></td>"
	}
	]
}

function getDataPerfil(tbody, table){
	$(tbody).on("click", ".btn-editar-perfil", function(){
		var tr = $(this).closest('tr');
		//si la tabla esta en su modo responsive
		if (tr.hasClass('child')) {
			tr = tr.prev();
		}
    	//obtener los datos de la fila en la tabla
    	var data = table.row(tr).data();

		//rellenar los datos del formulario
		$("#nombre").val(data.nombre);
		$("#idEditarPerfil").val(data.id);
	});
}

function getIdPerfil(tbody, table){
	$(tbody).on("click", ".btn-eliminar-perfil", function(){
		var tr = $(this).closest('tr');
		//si la tabla esta en su modo responsive
		if (tr.hasClass('child')) {
			tr = tr.prev();
		}
    	//obtener los datos de la fila en la tabla
    	var data = table.row(tr).data();
    	$("#idEliminarPerfil").val(data.id);
    });
}

/*=======================================
=            LISTAR PERFILES            =
=======================================*/

function listarDataTablePerfiles(){
	var table = tablaPerfiles.DataTable(options);
	getDataPerfil($("#dtPerfiles tbody"), table);
	getIdPerfil($("#dtPerfiles tbody"), table);
}
listarDataTablePerfiles();

/*=====  End of LISTAR PERFILES  ======*/

/*=======================================
=            AGREGAR PERFIL            =
=======================================*/

$('#formAgregarPerfil').on('submit', function(event){
	event.preventDefault();
	var form = $(this);
	var datos = form.serialize();

	$.ajax({
		url: 'ajax/perfiles.ajax.php?action=agregar',
		type: 'post',
		data: datos,
	})
	.done(function(respuesta) {
		tablaPerfiles.DataTable().ajax.reload();
		$("#modalAgregarPerfil").modal('hide');
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

/*=====  End of AGREGAR PERFIL  ======*/

/*======================================
=            EDITAR PERFIL            =
======================================*/

$("#formEditarPerfil").on("submit", function(event){
	event.preventDefault();
	var data = $(this).serialize();

	$.ajax({
		type : "post",
		url : "ajax/perfiles.ajax.php?action=editar",
		data : data,
		success: function(respuesta){
			tablaPerfiles.DataTable().ajax.reload();
			if(respuesta == 1){
				$("#modalEditarPerfil").modal('hide');
				swal({
					toast : true,
					type: 'success', 
					position: 'bottom-end',
					title: 'Datos editados correctamente',
					timer: 3000,
					showConfirmButton: false,
				});
			} else {
				alert("Error al editar");
			}
		}
	});
});

/*=====  End of EDITAR PERFIL  ======*/

/*========================================
=            ELIMINAR PERFIL            =
========================================*/

$("#formEliminarPerfil").on("submit", function(event){
	event.preventDefault();
	var data = $(this).serialize();

	$.ajax({
		url: 'ajax/perfiles.ajax.php?action=eliminar',
		type: 'post',
		data: data,
	})
	.done(function(respuesta) {
		$("#modalEliminarPerfil").modal('hide');
		if(respuesta == 1){

			tablaPerfiles.DataTable().ajax.reload();
			swal({
				toast: true,
				position: 'bottom-end',
				type: 'success',
				title: 'Perfil eliminado correctamente',
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

/*=====  End of ELIMINAR PERFIL  ======*/