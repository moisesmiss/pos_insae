<?php
class ControllerClientes{
	public $tabla = 'clientes';

	public function getAll(){
		return ModelClientes::getAll($this->tabla);
	}
}