var tablaCategorias = $("#dtCategorias");

var options = {
	"destroy" : true,
	"language" : language,
	"responsive" : true,
	"ajax" : {
		url : "ajax/categorias.ajax.php?action=listar",
	}, 
	"columns" : [
	{"data": "nombre"},
	{
		"data" : null,
		"defaultContent" : "<td><div class='btn-group'><button class='btn btn-warning btn-editar-categoria' data-toggle='modal' data-target='#modalEditarCategoria' data-id-categoria=''><i class='fa fa-pencil'></i></button><button data-toggle='modal' data-target='#modalEliminarCategoria' class='btn btn-danger btn-eliminar-categoria'><i class='fa fa-times'></i></button></div></td>"
	}
	]
}

/*===========================================
=            GET DATA CATEGORIA             =
===========================================*/

function getDataCategoria(tbody, table){
	$(tbody).on("click", ".btn-editar-categoria", function(){
		var tr = $(this).closest('tr');
		//si la tabla esta en su modo responsive
		if (tr.hasClass('child')) {
			tr = tr.prev();
		}
    	//obtener los datos de la fila en la tabla
    	var data = table.row(tr).data();

		//rellenar los datos del formulario
		$("#formEditarCategoria input[name=nombre]").val(data.nombre);
		$("#formEditarCategoria input[name=id]").val(data.id);
	});
}

/*=====  End of GET DATA CATEGORIA   ======*/


/*===============================================
=            LISTAR TABLA CATEGORIAS            =
===============================================*/

function listarDataTableCategorias(){
	var table = tablaCategorias.DataTable(options);
	getDataCategoria($("#dtCategorias tbody"), table);
	eliminarCategoria($("#dtCategorias tbody"), table);
}
listarDataTableCategorias();

/*=====  End of LISTAR TABLA CATEGORIAS  ======*/


/*=========================================
=            AGREGAR CATEGORIA            =
=========================================*/

$('#formAgregarCategoria').on('submit', function(event){
	event.preventDefault();
	var form = $(this);
	var datos = form.serialize();

	$.ajax({
		url: 'ajax/categorias.ajax.php?action=agregar',
		type: 'post',
		data: datos,
	})
	.done(function(respuesta) {
		tablaCategorias.DataTable().ajax.reload();
		$("#modalAgregarCategoria").modal('hide');
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


/*=====  End of AGREGAR CATEGORIA  ======*/

/*========================================
=            EDITAR CATEGORIA            =
========================================*/

$("#formEditarCategoria").on('submit', function(event){
	event.preventDefault();
	var form = $(this);
	var data = form.serialize();

	$.ajax({
		url: 'ajax/categorias.ajax.php?action=editar',
		type: 'POST',
		data: data,
	})
	.done(function(respuesta) {
		if(respuesta){
			tablaCategorias.DataTable().ajax.reload();
			$("#modalEditarCategoria").modal('hide');

			swal({
				type: "success",
				title: "Datos editados correctamente",
				position: "bottom-end",
				showConfirmButton: false,
				toast: true,
				timer: 3000,
			});
		} else {
			alert('Error al editar datos');
		}
		
	});	
});

/*=====  End of EDITAR CATEGORIA  ======*/

function eliminarCategoria(tbody, table){
	$(tbody).on("click", ".btn-eliminar-categoria", function(){
		var tr = $(this).closest('tr');
		//cuando la tabla esta en su modo responsive
		if(tr.hasClass('child')){
			tr = tr.prev();
		}
		//obtenter los datos de la fila
		var data = $('#dtCategorias').DataTable().row(tr).data();
		// console.log("data", data);


		Swal({
			title: "¿Seguro que desea eliminar la categoria "+data.nombre+" ?",
			text: "todos los productos ligados a esta categoria también se eliminarán",
			type: 'warning',
			confirmButtonText: "SI",
			cancelButtonText: "NO",
			showCancelButton: true,
			cancelButtonColor: '#3085d6',
			confirmButtonColor: '#d33',
			focusCancel: true,

		}).then((result) => {
			if(result.value){
				$.ajax({
					url: 'ajax/categorias.ajax.php?action=eliminar',
					type: 'POST',
					data: data,
				})
				.done(function(respuesta) {
					if(respuesta){
						tablaCategorias.DataTable().ajax.reload();
						Swal({
							toast: true,
							showConfirmButton: false,
							type: "success",
							title: "Categoria eliminada",
							position: "bottom-end",
							timer: 3000,
						});
					} else {
						Swal({
							type: 'error',
							title: 'Error al eliminar categoria',
							confirmButtonText: "Aceptar",
						});
					}
				});
			}
		})
	});
}
