<?php

include_once("../fpdf/fpdf.php");

if($_GET["orderDate"]){
    ob_start();
    $pdf = new FPDF();
    $pdf->Cell(40,10,"ok",0,0);
    $pdf->Output();
    ob_end_flush();
}
?>