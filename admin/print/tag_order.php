<?php

require_once('../../assets/fpdf17/fpdf.php');
session_start();
//db connection
include('../../includes/connection.php');
date_default_timezone_set('Asia/Jakarta');
//get invoices data
$query = 'SELECT * FROM `tbltransac` WHERE transac_code ="' . $_GET['no_transaksi'] . '"';
$result_invoice = mysqli_query($db, $query) or die(mysqli_error($db));
$invoice = mysqli_fetch_array($result_invoice);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//ubah header
class myPDF extends FPDF
{
    function header()
    {
         $this->SetY(10);
         $this->SetFont('Arial', 'B', 10);
         $this->Cell(0, 10, "TAG ORDER", 10, 0, 'C');
         $this->LN(7);
    }
    function footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, "", 10, 0, 'C');
    }
}
$pdf = new myPDF('P', 'mm', array(100,1000));

//add new page
$pdf->AddPage();

//set font to arial, bold, 14pt


//set font to arial, regular, 10pt
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, '======================================', 0, 1);
$pdf->Cell(0, 5, 'No. Transaksi : '.$_GET['no_transaksi'], 0, 1);
$pdf->LN(2);
//invoice contents
$border = 0;
$pdf->Cell(0, 5, '======================================', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 10, 'Menu', $border, 0);
$pdf->Cell(5, 10, 'Qty', $border, 1, 'C');
$pdf->SetFont('Arial', '', 8);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$query2 = 'SELECT * FROM `tbltransac` a INNER JOIN `tbltransacdetail` b on a.transac_code=b.transac_code JOIN `tblproducts` c on
    b.product_code=c.product_id JOIN `tblsaus` d on b.kd_saus=d.id_saus WHERE a.transac_code ="' . $_GET['no_transaksi'] . '"';
$result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
$tax = 0; //total tax
$amount = 0; //total amount

//display the items
while ($item = mysqli_fetch_assoc($result2)) {
    if (!empty($item['kematangan'])) {
        if ($item['nama_saus'] == 'Tanpa Saus') {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(75, 5, $item['product_name'], $border, 0);
        } else {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(75, 5, $item['product_name'] . " + " . $item['nama_saus']. "(". $item['kematangan'].")", $border, 0);
        }
    }
    else {
        if($item['nama_saus'] == "Tanpa Saus"){
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(75, 5, $item['product_name'], $border, 0);
        }else{
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(75, 5, $item['product_name'] . " + " . $item['nama_saus'], $border, 0);
        }
    }
     
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(5, 5, number_format($item['qty']), $border, 1,'C');
    //accumulate tax and amount
    $tax += $item['price'];
    $amount += $item['price'];
}

$filename = "TAG-ORDER_" . $invoice['transac_code'] . ".pdf";

$pdf->Output($filename, 'I');