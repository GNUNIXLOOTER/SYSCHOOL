<?php

use Dompdf\Dompdf;

include_once "dompdf/autoload.inc.php";
$pdf=new Dompdf();
$html=file_get_contents("http://localhost/sischool/vistas/productos.php?id=2");
$pdf->loadHtml($html);
$pdf->setPaper("A7","landingpage");
$pdf->render();
$pdf->stream();

?>