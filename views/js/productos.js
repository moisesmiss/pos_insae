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
