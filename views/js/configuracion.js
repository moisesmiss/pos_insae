//input mask
$("#telefonoEmpresa").inputmask({"mask": "(999) 999-9999"});

/*================================================
=            GUARDAR LA CONFIGUARCIÓN            =
================================================*/

$("#formConfiguracionInformacionEmpresa").on('submit', function(e){
	e.preventDefault();
	var data = new FormData(this);
	
	$.ajax({
		url: 'ajax/configuracion.ajax.php?action=guardar-informacion-empresa',
		type: 'post',
		dataType: '',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
	})
	.done(function(r) {
		console.log("r", r);
		var nombre_corto_empresa = $('input[name=nombre_corto_empresa]').val();
		if(r == 1){
			$('.logo-lg span').text(nombre_corto_empresa);
			toast({
				type: 'success',
				title: 'Configuración guardada correctamente',
			});
		}

	})
	.fail(function(r) {
		console.log("error", r);
	});
});

$('#formConfiguracionImpuesto').on('submit', function(e){
	e.preventDefault();
	var data = $(this).serialize();

	$.ajax({
		url: 'ajax/configuracion.ajax.php?action=guardar-informacion-impuesto',
		type: 'post',
		dataType: '',
		data: data,
	})
	.done(function(r) {
		if(r == 1){
			toast({
				type: 'success',
				title: 'Datos guardados correctamente',
			});
		}
	})
	.fail(function(r) {
		console.log("error", r);
	});
	
});
/*=====  End of GUARDAR LA CONFIGUARCIÓN  ======*/



/*============================================
=            RELLENAR FORMULARIOS            =
============================================*/

$(document).ready(function(){
	var form = $("#formConfiguracionInformacionEmpresa");
	var form2 = $('#formConfiguracionImpuesto');

	$.ajax({
		url: 'ajax/configuracion.ajax.php?action=obtener',
		dataType: 'json',
	})
	.done(function(r) {
		form.find('input[name=nombre_corto_empresa]').val(r.nombre_corto_empresa);
		form.find('input[name=nombre_largo_empresa]').val(r.nombre_largo_empresa);
		form.find('input[name=rfc]').val(r.rfc);
		form.find('input[name=telefono]').val(r.telefono);
		form.find('input[name=correo]').val(r.correo);
		form.find('input[name=sitio_web]').val(r.sitio_web);
		form.find('input[name=direccion]').val(r.direccion);
		form2.find('input[name=iva]').val(r.iva);
		//cagar imagen
		if(r.logo != ''){
			$('#logoPreview').attr('src', 'views/img/plantilla/'+r.logo);
		}
	});
});

/*=====  End of RELLENAR FORMULARIOS  ======*/

/*==========================================
=            PREVISUALIZAR LOGO            =
==========================================*/

$('#inputLogo').on('change', function(){
	// Creamos el objeto de la clase FileReader
	input = $(this);
	var imagen = this.files[0];

	if(imagen.size > 2000000){
		input.val('');
		Swal({
			type: 'error',
			title: 'La imagen es muy pesada',
		});
	} else {
		// Leemos el archivo subido y se lo pasamos a nuestro fileReader
		var datosImagen = new FileReader();
		datosImagen.readAsDataURL(imagen);
		// Le decimos que cuando este listo ejecute el código interno
		$(datosImagen).on('load', function(e){
			var rutaImagen = e.target.result;
			img = $("#logoPreview");
			img.attr('src', rutaImagen);
		});
	}
});

/*=====  End of PREVISUALIZAR LOGO  ======*/

/*=====================================
=            ELIMINAR LOGO            =
=====================================*/

$('#btnEliminarLogo').hide();
$('#logoPreview').on('load',function(){
	if($('#logoPreview').attr('src') !== ""){
		$('#btnEliminarLogo').show();
	}
});

$('#btnEliminarLogo').on('click', function(e){
	e.preventDefault();
	$('#logoPreview').attr('src', '');
	$('#btnEliminarLogo').hide();
	$.ajax({
		url: 'ajax/configuracion.ajax.php?action=eliminar-logo',
		type: 'post',
		dataType: '',
	})
	.done(function(r) {
		if(r == 1){
			toast({
				type: 'success',
				title: 'Logo eliminado correctamente',
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
	
});

/*=====  End of ELIMINAR LOGO  ======*/
