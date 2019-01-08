<?php 
class Reportes{
	public function minYearVentas(){
		$year = Model::query('select min(year(fecha)) as min_year from venta limit 1;')[0]['min_year'];
		return $year;
	}

	public function maxYearVentas(){
		$year = Model::query('select max(year(fecha)) as max_year from venta limit 1;')[0]['max_year'];
		return $year;
	}
}