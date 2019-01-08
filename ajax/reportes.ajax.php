<?php 
require_once "../models/reportes.model.php";

class AjaxReportes{
	public function filtroVentas(){
		$month = $_POST['month'];
		$year = $_POST['year'];

		$dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for ($i= 1; $i <= $dias; $i++) { 
			$arrayDias[] = $i;
		}
		
		$data['labels'] = $arrayDias;


		return json_encode($data);
	}
}

$reportes = new AjaxReportes;
switch ($_GET['action']) {
	case 'filtro-ventas':
	echo $reportes->filtroVentas();
	break;
}