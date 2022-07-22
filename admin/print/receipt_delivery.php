<?php

require_once('../../assets/fpdf17/fpdf.php');
session_start();
//db connection
include('../../includes/connection.php');
date_default_timezone_set('Asia/Jakarta');
//get invoices data
$query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,`C_PNUMBER` FROM `tbltransac` a INNER JOIN
`tblcustomer` b on a.customer_id=b.C_ID INNER JOIN
`tblalamat` c on b.C_ADRESSID=c.id_alamat WHERE a.transac_code ="' . $_GET['no_transaksi'] . '"';
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
        $this->Cell(0, 10, "Andakar (Aneka Daging Bakar)", 10, 0, 'C');
        $this->LN(7);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, "Jl. Warung Buncit Raya No.1, RT.12/RW.5, Kalibata", 10, 0, 'C');
        $this->LN(5);
        $this->Cell(0, 10, "Kec. Pancoran, Kota Jakarta Selatan", 10, 0, 'C');
        $this->LN(5);
        $this->Cell(0, 10, "Daerah Khusus Ibukota Jakarta", 10, 0, 'C');
        $this->LN(5);
        $this->Cell(0, 10, "Telp. 021-79198184", 10, 0, 'C');
        $this->LN();
    }
    function footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, "Terimakasih Sudah Memesan...", 10, 0, 'C');
    }
}
$pdf = new myPDF('P', 'mm', array(100,1000));

//add new page
$pdf->AddPage();

//set font to arial, bold, 14pt


//set font to arial, regular, 10pt
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 5, '================================================', 0, 1);
$pdf->Cell(0, 5, 'Nama : ' . $_SESSION['fname'].' '. $_SESSION['lname'], 0, 1);
$pdf->Cell(0, 5, 'Tanggal : ' . date("d/m/Y"), 0, 1);
$pdf->Cell(0, 5, 'Waktu : ' . date('h:i:s A'), 0, 1);
$pdf->Cell(0, 5, 'Jenis Transaksi : Delivery', 0, 1);
$pdf->LN(2);
//billing address
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(0, 5, "Alamat Pengiriman", 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 5, $invoice['alamat'], 0, 1); //end of line
$pdf->LN(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(0, 5, "Catatan", 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 5, $invoice['catatan'], 0, 1); //end of line
$pdf->LN(2);
//invoice contents
$border = 0;
$pdf->Cell(0, 5, '================================================', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(55, 10, 'Menu', $border, 0);
$pdf->Cell(5, 10, 'Qty', $border, 0, 'C');
$pdf->Cell(20, 10, 'Harga', $border, 1, 'R');
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
    if($item['nama_saus'] == "Tanpa Saus"){
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(55, 5, $item['product_name'], $border, 1);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(55, 5, '   @ '.number_format($item['price']), $border, 0);
    }else{
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(55, 5, $item['product_name'] . " + " . $item['nama_saus'], $border, 1);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(55, 5, '   @ '.number_format($item['price'])." + ".number_format($item['harga_saus']), $border,
        0);
    } 
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(5, 5, number_format($item['qty']), $border, 0,'C');
    $pdf->Cell(20, 5, number_format($item['harga']), $border, 1, 'R');
    //accumulate tax and amount
    $tax += $item['price'];
    $amount += $item['price'];
}
$pdf->Cell(0, 10, '================================================', 0, 1);
$pdf->Cell(40, 5, '', $border, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, 'Sub Total :', $border, 0, 'R');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, number_format($invoice["subtotal"]), $border, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$pajak = $invoice["tax_sepuluh"];
$pdf->Cell(40, 5, '', $border, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, 'Pajak 10% :', $border, 0, 'R');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, number_format($pajak), $border, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$biaya_kirim = $invoice["biaya_kirim"];
$pdf->Cell(40, 5, '', $border, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, 'Biaya Kirim :', $border, 0, 'R');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, number_format($biaya_kirim), $border, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$gt = $invoice["total_price"];
$pdf->Cell(0, 2, '-----------------------------------------', 0, 1, 'R');
$pdf->Cell(40, 5, '', $border, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, 'Grand Total :', $border, 0, 'R');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, number_format($gt), $border, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$filename = "invoice_" . $invoice['transac_code'] . ".pdf";

$pdf->Output($filename, 'I');