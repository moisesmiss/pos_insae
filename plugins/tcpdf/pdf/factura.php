<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->startPageGroup();
$pdf->AddPage();

$bloque1 = <<<EOF
<table>
	<th>Hola mundo me llamo moisés</th>
</table>
EOF;
// ob_start();
// include 'view-factura.php';
// $html = ob_get_clean();

$pdf->writeHTMl($bloque1, false, false, false, false, '');