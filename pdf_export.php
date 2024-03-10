<?php
require_once('dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = file_get_contents('Report_pdf.html');

$dompdf->loadhtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream();


header("Location: https://cop-it-up.com/Tool/Report.php");

?>