<?php 
require __DIR__.'/../vendor/autoload.php';
require_once '../models/conexion.php';
require_once '../models/model.php';

use Spipu\Html2Pdf\Html2Pdf;

if(!empty($_GET['id'])){	
$venta = Model::find('view_venta', 'id', $_GET['id']);
$productos = Model::query("select * from view_detalle_venta where venta_id = {$_GET['id']}");

ob_start();
include 'view-factura.php';
$html = ob_get_clean();

$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output("factura{$_GET['id']}.pdf");
}