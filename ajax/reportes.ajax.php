<?php 
require_once "../models/reportes.model.php";

class AjaxReportes{
	public function filtroVentas(){
		$month = !empty($_POST['month']) ? $_POST['month'] : intval(date('m'));
		$year = !empty($_POST['year']) ? $_POST['year'] : intval(date('Y'));

		$dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for ($i= 1; $i <= $dias; $i++) { 
			$arrayDias[] = $i;
		}

		$declaracion = Conexion::conectar()->prepare("
			select 
			day(fecha) as dia,
			date_format(fecha, '%d/%c/%Y') as fecha,
			count(*) as total_ventas
			from venta 
			where month(fecha) = '$month' and year(fecha) = '$year' 
			group by day(fecha);"
		);
		$declaracion->execute();
		$filas = $declaracion->fetchAll();

		$datos = [];
		for ($i=0; $i < count($arrayDias); $i++) { 
			foreach ($filas as $key => $fila) {
				if($fila['dia'] == $arrayDias[$i]){
					$datos['data'][$i] = $fila['total_ventas'];
				} else if(empty($datos['data'][$i])) {
					$datos['data'][$i] = 0;
				}
			}
		}

		$datos['labels'] = $arrayDias;
		return json_encode($datos);	
	}
}

$reportes = new AjaxReportes;
switch ($_GET['action']) {
	case 'filtro-ventas':
	echo $reportes->filtroVentas();
	break;
}