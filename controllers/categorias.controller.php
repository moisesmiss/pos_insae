<?php
class ControllerCategorias{
	public $tabla = 'categoria';

	public function getAll(){
		return ModelCategorias::getAll($this->tabla);
	}
}