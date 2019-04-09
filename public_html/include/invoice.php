<?php

include_once("../fpdf/fpdf.php");

    if($_GET["orderDate"] && $_GET["invoiveNo"]){
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,10,"Inventory Management Systemm",0,1,'C');
    $pdf->SetFont('Arial',null,12);
    $pdf->Cell(50,10,"Order Date :",0,0);
    $pdf->Cell(50,10,$_GET["orderDate"],0,1);
    $pdf->Cell(50,10,"Customer Name :",0,0);
    $pdf->Cell(50,10,$_GET["orderCustomer"],0,1);

    $pdf->Cell(50,10,"",0,1);

    $pdf->Cell(10,10,"#",1,0,'C');
    $pdf->Cell(70,10,"Product Name",1,0,'C');
    $pdf->Cell(30,10,"Quantity",1,0,'C');
    $pdf->Cell(40,10,"Price",1,0,'C');
    $pdf->Cell(40,10,"Total (Rs)",1,1,'C');

    for($i=0;$i< count($_GET["pid"]); $i++){

        $pdf->Cell(10,10,($i+1),1,0,'C');
        $pdf->Cell(70,10,$_GET["pro_name"][$i],1,0,'C');
        $pdf->Cell(30,10,$_GET["qty"][$i],1,0,'C');
        $pdf->Cell(40,10,$_GET["price"][$i],1,0,'C');
        $pdf->Cell(40,10,($_GET["qty"][$i]) * $_GET["price"][$i],1,1,'C');

    }

    $pdf->Cell(50,10,"",0,1);

    $pdf->Cell(50,10,"Sub Total",0,0);
    $pdf->Cell(50,10,": ".$_GET["subTotal"],0,1);

    $pdf->Cell(50,10,"Discount",0,0);
    $pdf->Cell(50,10,": ".$_GET["discount"],0,1);

    $pdf->Cell(50,10,"Total",0,0);
    $pdf->Cell(50,10,": ".$_GET["netTotal"],0,1);

    $pdf->Cell(50,10,"Paid",0,0);
    $pdf->Cell(50,10,": ".$_GET["paid"],0,1);

    $pdf->Cell(50,10,"Due Amount",0,0);
    $pdf->Cell(50,10,": ".$_GET["due"],0,1);

    $pdf->Cell(50,10,"Payment Type",0,0);
    $pdf->Cell(50,10,": ".$_GET["paymentType"],0,1);

    $pdf->Cell(180,10,"Signature : ..................",0,0,"R");
    

    $pdf->output("../InvoiceSave/INVOICE_".$_GET["invoiveNo"].".pdf" , "F");

    $pdf->Output();
    
    }
?>