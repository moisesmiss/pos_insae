<?php
class ControllerClientes{
	public $tabla = 'cliente';

	public function getAll(){
		return ModelClientes::getAll($this->tabla);
	}
}