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
		url : "ajax/ventas.ajax.php?action=listar",
	}, 
	"columns" : [
	{"data" : "id"},
	{"data": "vendedor"},
	{
		"data": "cliente",
		render: function(data){
			if(data == ' '){
				return "Anónimo";
			} else {
				return data;
			}
		}
	},
	{"data": "metodo_pago"},
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
			'<button class="btn btn-info btn-imprimir-factura" data-id-venta='+data.id+'><i class="fa fa-print"></i></button>' +
				// '<button class="btn btn-warning"><i class="fa fa-edit"></i></button>' +
				// '<button class="btn btn-danger"><i class="fa fa-times"></i></button>' +
				'</div>';
			}
		}

		]
	};

	$("#dtVentas").DataTable(options);

/*==============================================
=            BOTON IMPRIMIR FACTURA            =
==============================================*/

$("#dtVentas tbody").on('click', '.btn-imprimir-factura', function(){
	var idVenta = $(this).data('id-venta');
	window.open("pdf/factura.php?id=" + idVenta, "_blank");
});

/*=====  End of BOTON IMPRIMIR FACTURA  ======*/

/*=========================================
=            FILTRO POR FECHAS            =
=========================================*/

//Date range as a button
moment.locale('es');
$('#btn-daterange').daterangepicker(
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
	$("#dtVentas").DataTable().ajax.url('ajax/ventas.ajax.php?action=listarPorFecha&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin).load();		
	
}
);
//cancelar filtro por fecha
// $('.daterangepicker .range_inputs .cancelBtn').on('click', function(){
// 	$("#btn-daterange span").html('<span><i class="fa fa-calendar"></i> Rango de fecha </span>');
// 	$("#dtVentas").DataTable().ajax.url('ajax/ventas.ajax.php?action=listar').load();
// });


/*=====  End of FILTRO POR FECHAS  ======*/
