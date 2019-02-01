<?php 
require_once '../models/conexion.php';
require_once '../models/Model.php';

class AjaxConfiguracion extends Model{
	public function guardarInformacionEmpresa(){
		//subir imagen 
		if($_FILES['logo']['size'] > 0){
			$ruta = "../views/img/plantilla/";
			$tmpName = $_FILES['logo']['tmp_name'];
			$rutaFinal = $ruta.$_FILES['logo']['name'];
			if(is_uploaded_file($tmpName)){
				move_uploaded_file($tmpName, $rutaFinal);
			}
		}
		//comprobar si hay configuracion
		$datos = [
			'nombre_corto_empresa' => $_POST['nombre_corto_empresa'],
			'nombre_largo_empresa' => $_POST['nombre_largo_empresa'],
			'rfc' => $_POST['rfc'],
			'telefono' => $_POST['telefono'],
			'correo' => $_POST['correo'],
			'sitio_web' => $_POST['sitio_web'],
			'direccion' => $_POST['direccion'],
			'logo' => $_FILES['logo']['name'],
		];

		$configuracion = self::getAll('configuracion');
		if(count($configuracion) == 0){
			$resultado = self::insert('configuracion', $datos);
		} else {
			$id = $configuracion[0]['id'];
			//si ya hay un logo no dejarla vacia
			$logo = self::find('configuracion', 'id', $id)['logo'];
			if(!empty($logo)){
				$datos['logo'] = $logo;
			}
			$resultado = self::update('configuracion', $datos, ['id' => $id]);
		}
		return $resultado;
	}

	public function guardarInformacionImpuesto(){
		$configuracion = self::getAll('configuracion');
		$datos = [
			'iva' => $_POST['iva'],
		];
		if(count($configuracion) == 0){
			$resultado = self::insert('configuracion', $datos);
		} else {
			$id = self::getAll('configuracion')[0]['id'];
			$resultado = self::update('configuracion', $datos, ['id' => $id]);
		}
		return $resultado;
	}

	public function obtener(){
		$datos = self::getAll('configuracion')[0];
		return json_encode($datos);
	}

	public function eliminarLogo(){
		$id = self::getAll('configuracion')[0]['id'];
		//eliminar el logo del servidor
		$logoActual = self::find('configuracion', 'id', $id)['logo'];
		// var_dump($logoActual);
		$eliminarLogo = unlink("../views/img/plantilla/$logoActual");

		if($eliminarLogo){	
			$datos = ['logo' => ''];
			$resultado = self::update('configuracion', $datos, ['id' => $id]);
			return $resultado;
		}
	}
}

switch ($_GET['action']) {
	case 'guardar-informacion-empresa':
	echo AjaxConfiguracion::guardarInformacionEmpresa();
	break;
	case 'guardar-informacion-impuesto':
	echo AjaxConfiguracion::guardarInformacionImpuesto();
	break;
	case 'obtener':
	echo AjaxConfiguracion::obtener();
	break;
	case 'eliminar-logo':
	echo AjaxConfiguracion::eliminarLogo();
	break;
}