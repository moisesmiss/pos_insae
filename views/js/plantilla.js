/*=============================================
=            sidevar menu            =
=============================================*/

//arregla el problema de los submenus en dispositivos pequeños
var smallBreakpoint = window.matchMedia('(max-width: 786px)');
var mediumBreakpoint = window.matchMedia('(max-width: 992px)');
var changeSizeSmall = mediaQuery => {
	if(mediaQuery.matches){
		$("body").removeClass('sidebar-collapse');
	} else {
		$("body").addClass('sidebar-collapse');
	}
}

var changeSizeMedium = mediaQuery => {
	if(mediaQuery.matches){
		$("body").addClass('sidebar-collapse');
	} else {
		$("body").removeClass('sidebar-collapse');
	}
}
mediumBreakpoint.addListener(changeSizeMedium);
changeSizeMedium(mediumBreakpoint);

smallBreakpoint.addListener(changeSizeSmall);
changeSizeSmall(smallBreakpoint);
// ----------------------------------------



$(document).ready(function () {
	$('.sidebar-menu').tree()
});

/*=====  End of sidevar menu  ======*/
var language = {
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	}
}