<?php 
require_once "../models/reportes.model.php";

class AjaxReportes{
	public function filtroVentas(){
		$month = !empty($_POST['month']) ? $_POST['month'] : intval(date('m'));
		$year = !empty($_POST['year']) ? $_POST['year'] : intval(date('Y'));


		if($month != 'todos'){
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

			$month = ($month < 10) ? '0'.$month : $month;
			for ($i=0; $i < count($arrayDias); $i++) { 
				foreach ($filas as $key => $fila) {
					$day = (($i+1) < 10) ? '0'.($i+1) : ($i+1);
					$datos['labels'][$i] = "$day/$month/$year";
					if($fila['dia'] == $arrayDias[$i]){
						$datos['data'][$i] = $fila['total_ventas'];
					} else if(empty($datos['data'][$i])) {
						$datos['data'][$i] = 0;
					}
				}
			}	
		} else {
			$declaracion = Conexion::conectar()->prepare("
				select 
				month(fecha) as mes,
				date_format(fecha, '%m/%Y') as fecha,
				count(*) as total_ventas
				from venta 
				where year(fecha) = '$year' 
				group by month(fecha);"
			);
			$declaracion->execute();
			$filas = $declaracion->fetchAll();

			//construcción de datos para el chart.js
			$datos = [];
			for ($i=0; $i < 12; $i++) { 
				foreach ($filas as $key => $fila) {
					$month = (($i+1) < 10) ? '0'.($i+1) : ($i+1);
					$datos['labels'][$i] = "$month/$year";
					if($fila['mes'] == $i+1){
						$datos['data'][$i] = $fila['total_ventas'];
					} else if(empty($datos['data'][$i])) {
						$datos['data'][$i] = 0;
					}
				}
			}
		}

		return json_encode($datos);	
	}
}

$reportes = new AjaxReportes;
switch ($_GET['action']) {
	case 'filtro-ventas':
	echo $reportes->filtroVentas();
	break;
}