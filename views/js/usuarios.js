/*======================================
=            EDITAR USUARIO            =
======================================*/

$(".btn-editar-usuario").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var idUsuario = $(this).data("id-usuario");
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({
		url: "ajax/usuarios.ajax.php?action=find",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$('#nombre').val(respuesta['nombre']);
			$('#usuario').val(respuesta['usuario']);
		}
	});
});



/*=====  End of EDITAR USUARIO  ======*/
