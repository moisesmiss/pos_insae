<?php 
require __DIR__.'/../vendor/autoload.php';
require_once '../models/conexion.php';
require_once '../models/model.php';

use Spipu\Html2Pdf\Html2Pdf;

if(!empty($_GET['id'])){
$configuracion = Model::getAll('configuracion')[0];

$compra = Model::find('view_compra', 'id', $_GET['id']);
$productos = Model::query("select * from view_detalle_compra where compra_id = {$_GET['id']}");

ob_start();
include 'view-compra.php';
$html = ob_get_clean();

$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output("compra{$_GET['id']}.pdf");
}