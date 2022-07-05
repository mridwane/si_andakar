<?php

require_once('../../assets/fpdf17/fpdf.php');

//db connection
include('../../includes/connection.php');

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
        $this->Image('../../assets/images/logo.png', 50, -25, 100);
        $this->LN(30);
    }
    function footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, "Andakar (Ayam Iga Bakar)", 10, 0, 'C');
        $this->LN(7);
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, "Jl Duren 3 No. 11, Jakarta.", 10, 0, 'C');
        $this->LN(5);
        $this->Cell(0, 10, "Telp. 021-79198184", 10, 0, 'C');
    }
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
$pdf = new myPDF('P', 'mm', 'A4');

//add new page
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(100, 5, 'Kepada', 0, 0);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(59, 5, 'INVOICE', 0, 1); //end of line
$pdf->LN();

//set font to arial, regular, 10pt
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(100, 5, 'Nama    : ' . $invoice['name'], 0, 0);
$pdf->Cell(25, 5, 'Tanggal', 0, 0);
$pdf->Cell(34, 5, date("Y/m/d"), 0, 1); //end of line

$pdf->Cell(100, 5, 'Alamat  : ' . $invoice['alamat'], 0, 0);
$pdf->Cell(25, 5, 'No   ', 0, 0);
$pdf->Cell(34, 5, $invoice['transac_code'], 0, 1); //end of line

$pdf->Cell(100, 5, 'Telp       : ' . $invoice['C_PNUMBER'], 0, 0);
$pdf->Cell(25, 5, 'Perihal ', 0, 0);
$status = "";
if ($invoice['status'] == "dp") {
    $status = "Down Payment";
} else {
    $status = "Pelunasan";
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(34, 5, "Pemabayaran " . $status . " 50%", 0, 1); //end of line
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 5, 'Fax        : -', 0, 0);
$pdf->Cell(25, 5, '', 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(34, 5, 'atas Pemesanan Catering Tgl ' . $invoice['date'], 0, 1); //end of line
$pdf->SetFont('Arial', '', 10);
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 10, '', 0, 1); //end of line

//billing address
$pdf->Cell(100, 5, 'Detail Pesanan', 0, 1); //end of line

$pdf->LN();

//invoice contents
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(85, 5, 'Makanan/Minuman', 1, 0);
$pdf->Cell(25, 5, 'Qty', 1, 0, 'C');
$pdf->Cell(45, 5, 'Harga Makanan + Saus', 1, 0, 'C');
$pdf->Cell(34, 5, 'Total', 1, 1, 'C'); //end of line

$pdf->SetFont('Arial', '', 10);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$query2 = 'SELECT * FROM `tbltransac` a INNER JOIN `tbltransacdetail` b on a.transac_code=b.transac_code JOIN `tblproducts` c on
    b.product_code=c.product_id JOIN `tblsaus` d on b.kd_saus=d.id_saus WHERE a.transac_code ="' . $_GET['no_transaksi'] . '"';
$result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
$tax = 0; //total tax
$amount = 0; //total amount

//display the items
while ($item = mysqli_fetch_assoc($result2)) {
    $pdf->Cell(85, 5, $item['product_name'] . " + " . $item['nama_saus'], 1, 0,);
    //add thousand separator using number_format function
    $pdf->Cell(25, 5, number_format($item['qty']), 1, 0, 'C');
    $pdf->Cell(45, 5, number_format($item['price'] + $item['harga_saus']), 1, 0, 'C'); //end of line
    $pdf->Cell(34, 5, number_format(($item['price'] + $item['harga_saus']) * $item['qty']), 1, 1, 'C');
    //accumulate tax and amount
    $tax += $item['price'];
    $amount += $item['price'];
}

//summary
$service = $invoice["total_price"] * 0.05;
$pajak = $invoice["total_price"] * 0.10;
$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Sub Total', 0, 0, 'R');
$pdf->Cell(34, 5, number_format($invoice['total_price']), 1, 1, 'C'); //end of line

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Service (15%)', 0, 0, 'R');
$pdf->Cell(34, 5, number_format($service), 1, 1, 'C'); //end of line

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Pajak (10%)', 0, 0, 'R');
$pdf->Cell(34, 5, number_format($pajak), 1, 1, 'C'); //end of line

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Grand Total', 0, 0, 'R');
$pdf->Cell(34, 5, number_format($invoice['total_price'] + $service + $pajak), 1, 1, 'C');

$pdf->Cell(50, 5, '', 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(105, 5, 'Pembayaran ' . $status  . ' (50%)', 0, 0, 'R');
$pdf->Cell(34, 5, number_format(($invoice['total_price'] + $service + $pajak) / 2), 1, 1, 'C'); //end of line

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Sisa Pembayaran', 0, 0, 'R');
$pdf->Cell(34, 5, "-", 1, 1, 'C'); //end of line
$total_terbilang = terbilang(($invoice['total_price'] + $service + $pajak) / 2);
$pdf->SetFont('Arial', 'BI', 12);
$pdf->LN();
$pdf->Cell(200, 5, "Terbilang : ## " . ucwords($total_terbilang) . " Rupiah ##", 0, 0);


$filename = "invoice" . $item['transac_code'] . ".pdf";

$pdf->Output('invoice.pdf', 'I');
