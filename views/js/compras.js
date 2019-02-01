(function(){
	var formatNumber = {
	 separador: ",", // separador para los miles
	 sepDecimal: '.', // separador para los decimales
	 formatear:function (num){
	 	num +='';
	 	var splitStr = num.split('.');
	 	var splitLeft = splitStr[0];
	 	var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
	 	var regx = /(\d+)(\d{3})/;
	 	while (regx.test(splitLeft)) {
	 		splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
	 	}
	 	return this.simbol + splitLeft +splitRight;
	 },
	 new:function(num, simbol){
	 	this.simbol = simbol ||'';
	 	return this.formatear(num);
	 }
	};
	var options = {
		"destroy" : true,
		"language" : language,
		"responsive" : true,
		"order": [[0, 'desc']],
		"ajax" : {
			url : "ajax/compras.ajax.php?action=listar",
		}, 
		pageLength: 50,
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
				filename: 'ventas',
				exportOptions : {
					columns : ':visible :not(:last-child)',
				},
			},
			{
				extend: 'pdfHtml5',
				text: '<i class="fa fa-file-pdf-o"></i>',
				className: 'btn-danger',
				titleAttr: 'Exportar datos en PDF',
				filename: 'ventas',
				exportOptions : {
					columns : ':visible :not(:last-child)',
				},
			},
			{
				extend: 'csvHtml5',
				text: '<i class="fa fa-file-text-o"></i>',
				className: 'btn-primary',
				titleAttr: 'Exportar datos en CSV',
				filename: 'ventas',
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
		{"data" : "id"},
		{
			"data": "neto",
			render: function(data){
				return formatNumber.new(data, '$ ');
			}
		},
		{
			"data": "total",
			render: function(data){
				return formatNumber.new(data, '$ ');
			}
		},
		{"data": "fecha"},
		{
			"data": null,
			render: function(data){
				return '<div class="btn-group">' +
				'<button class="btn btn-info btn-imprimir-compra" data-id-compra='+data.id+'><i class="fa fa-print"></i></button>' +
				// '<button class="btn btn-warning"><i class="fa fa-edit"></i></button>' +
				// '<button class="btn btn-danger"><i class="fa fa-times"></i></button>' +
				'</div>';
			}
		}

		]
	};

	$("#dtCompras").DataTable(options);
})();


/*=========================================
=            FILTRO POR FECHAS            =
=========================================*/

//Date range as a button
moment.locale('es');
$('#btn-daterange2').daterangepicker(
{
	ranges   : {
		'Hoy'       : [moment(), moment()],
		'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Últimos 7 dias' : [moment().subtract(6, 'days'), moment()],
		'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
		'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
		'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	},
	autoApply: true,
	startDate: moment().subtract(29, 'days'),
	endDate  : moment(),
},
function (start, end) {
	$('#btn-daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	$('#btn-daterange span').css('text-transform', 'capitalize');
	var fechaInicio = start.format('YYYY-MM-DD');
	var fechaFin = end.format('YYYY-MM-DD');
	$("#dtCompras").DataTable().ajax.url('ajax/compras.ajax.php?action=listarPorFecha&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin).load();		
	
}
);
//cancelar filtro por fecha
// $('.daterangepicker .range_inputs .cancelBtn').on('click', function(){
// 	$("#btn-daterange span").html('<span><i class="fa fa-calendar"></i> Rango de fecha </span>');
// 	$("#dtVentas").DataTable().ajax.url('ajax/ventas.ajax.php?action=listar').load();
// });


/*=====  End of FILTRO POR FECHAS  ======*/

/*==============================================
=            BOTON IMPRIMIR COMPRA            =
==============================================*/

$("#dtCompras tbody").on('click', '.btn-imprimir-compra', function(){
	var idCompra = $(this).data('id-compra');
	window.open("pdf/compra.php?id=" + idCompra, "_blank");
});

/*=====  End of BOTON IMPRIMIR COMPRA  ======*/