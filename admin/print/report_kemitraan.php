<?php

require_once('../../assets/fpdf17/fpdf.php');

//db connection
include('../../includes/connection.php');

//get invoices data
// $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,`C_PNUMBER` FROM `tbltransac` a INNER JOIN
// `tblcustomer` b on a.customer_id=b.C_ID INNER JOIN
// `tblalamat` c on b.C_ADRESSID=c.id_alamat WHERE a.transac_code ="' . $_GET['no_transaksi'] . '"';
// $result_invoice = mysqli_query($db, $query) or die(mysqli_error($db));
// $invoice = mysqli_fetch_array($result_invoice);
$monthyear = $_POST['month'];
    if(strcmp($monthyear,"")==0){
        echo "<script>
            alert('Silahkan masukan bulan dan tahun terlebih dahulu');
            window.location.href = '../reportpage.php?'
        </script>";
        }
    else{       

        class myPDF extends FPDF
        {
            function header()
            {
                $this->Image('../../assets/images/logo.png', 50, -25, 100);
                $this->LN(20);
                $this->SetFont('Arial', 'B', 18);
                $this->Cell(0, 10, "LAPORAN KEMITRAAN", 10, 0,
                'C');
                $this->LN(15);
                $this->SetFont('Arial', '', 12);
                $this->Cell(0, 5, "RESTORANT ANDAKAR STEAK", 10, 0,
                'C');
                $this->LN();
                $this->SetFont('Arial', 'I', 10);
                $this->Cell(0, 10, "Jl. Warung Buncit Raya No.1, RT.12/RW.5, Kalibata, Kec. Pancoran, Jakarta Selatan", 10, 0, 'C');
                $this->LN(30);
            }
            function footer()
            {
                $this->SetY(-25);
                $this->SetFont('Arial', 'B', 14);
                $this->Cell(0, 10, "Andakar (Aneka Daging Bakar)", 10, 0, 'C');
                $this->LN(10);
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

            //invoice contents
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(0, 5, 'Report Kemitraan', 0, 1, 'C'); //end of line
            $pdf->LN(10);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 5, 'No.', 1, 0);
            $pdf->Cell(50, 5, 'Owner Mitra', 1, 0, 'C');
            $pdf->Cell(55, 5, 'Email', 1, 0, 'C');
            $pdf->Cell(40, 5, 'No. Telp', 1, 0, 'C');
            $pdf->Cell(35, 5, 'Status Kemitraan', 1, 1, 'C'); //end of line

            $pdf->SetFont('Arial', '', 10);

            //Numbers are right-aligned so we give 'R' after new line parameter

            //items
           $monthyear = explode('-', $monthyear);
           $month=$monthyear[1];
           $year= $monthyear[0];
           $query = 'SELECT * FROM tblrequestmitra a INNER JOIN tblcustomer b ON a.C_ID=b.C_ID WHERE MONTH(`date_req`) = '.$month.' AND
           YEAR(`date_req`)= '.$year.'';
           $result = mysqli_query($db, $query) or die (mysqli_error($db));
           $no = 1;
           $grandtotal = 0;

            //display the items
            while ($row = mysqli_fetch_assoc($result)) {
                $pdf->Cell(10, 5, $no++, 1, 0,);
                $pdf->Cell(50, 5, $row['C_FNAME'], 1, 0,);
                $pdf->Cell(55, 5, $row['C_EMAILADD'], 1, 0, 'C');
                $pdf->Cell(40, 5, $row['C_PNUMBER'], 1, 0, 'C');
                $pdf->Cell(35, 5, $row['status'], 1, 1, 'C');
            }
             //summary
            // $service = $invoice["total_price"] * 0.05;
            // $pajak = $invoice["total_price"] * 0.10;
            // $pdf->Cell(130, 5, '', 0, 0);
            // $pdf->Cell(25, 5, 'Sub Total', 0, 0, 'R');
            // $pdf->Cell(34, 5, number_format($invoice['total_price']), 1, 1, 'C'); //end of line

            // $pdf->Cell(130, 5, '', 0, 0);
            // $pdf->Cell(25, 5, 'Service (5%)', 0, 0, 'R');
            // $pdf->Cell(34, 5, number_format($service), 1, 1, 'C'); //end of line

            // $pdf->Cell(130, 5, '', 0, 0);
            // $pdf->Cell(25, 5, 'Pajak (10%)', 0, 0, 'R');
            // $pdf->Cell(34, 5, number_format($pajak), 1, 1, 'C'); //end of line
            // $pdf->SetFont('Arial', 'B', 10);
            // $pdf->Cell(160, 5, 'Grand Total', 1, 0, 'R');
            // $pdf->Cell(30, 5, number_format($grandtotal), 1, 1, 'R');

            // $pdf->Cell(50, 5, '', 0, 0);
            // $pdf->SetFont('Arial', 'B', 10);
            // $pdf->Cell(105, 5, 'Pembayaran ' . $status . ' (50%)', 0, 0, 'R');
            // $pdf->Cell(34, 5, number_format(($invoice['total_price'] + $service + $pajak) / 2), 1, 1, 'C'); //end of line

            // $pdf->SetFont('Arial', '', 10);
            // $pdf->Cell(50, 5, '', 0, 0);
            // $pdf->Cell(105, 5, 'Sisa Pembayaran', 0, 0, 'R');
            // $pdf->Cell(34, 5, "-", 1, 1, 'C'); //end of line
            // $total_terbilang = terbilang(($invoice['total_price'] + $service + $pajak) / 2);
            // $pdf->SetFont('Arial', 'BI', 12);
            // $pdf->LN();
            // $pdf->Cell(200, 5, "Terbilang : ## " . ucwords($total_terbilang) . " Rupiah ##", 0, 0);


           


            $filename = "Report_Kemitraan.pdf";

            $pdf->Output($filename, 'I');
    }

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//ubah header