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
                $this->Cell(0, 10, "LAPORAN PENJUALAN", 10, 0,
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
            $pdf->Cell(0, 5, 'Report Penjualan', 0, 1, 'C'); //end of line
            $pdf->LN(10);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 5, 'No.', 1, 0);
            $pdf->Cell(50, 5, 'Kode Transaksi', 1, 0, 'C');
            $pdf->Cell(30, 5, 'Type Transaksi', 1, 0, 'C');
            $pdf->Cell(25, 5, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(25, 5, 'Sub total', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Pajak 10%', 1, 0, 'C');
            $pdf->Cell(30, 5, 'Total', 1, 1, 'C'); //end of line

            $pdf->SetFont('Arial', '', 10);

            //Numbers are right-aligned so we give 'R' after new line parameter

            //items
           $monthyear = explode('-', $monthyear);
           $month=$monthyear[1];
           $year= $monthyear[0];
           $query = 'SELECT *, date, status FROM tbltransac  WHERE MONTH(`date`) = '.$month.' AND
           YEAR(`date`)= '.$year.' AND NOT transac_type ="Catering"';
           $result = mysqli_query($db, $query) or die (mysqli_error($db));
           $no = 1;
           $grandtotal = 0;

            //display the items
            while ($row = mysqli_fetch_assoc($result)) {
                $pdf->Cell(10, 5, $no++, 1, 0,);
                $pdf->Cell(50, 5, $row['transac_code'], 1, 0,);
                $pdf->Cell(30, 5, $row['transac_type'], 1, 0, 'C');
                $pdf->Cell(25, 5, $row['date'], 1, 0, 'C');
                $pdf->Cell(25, 5, number_format($row['total_price']), 1, 0, 'R');
                $pdf->Cell(20, 5, number_format($row['total_price']*0.10), 1, 0, 'R');
                $pdf->Cell(30, 5, number_format(($row['total_price']*0.10)+$row['total_price']), 1, 1, 'R');

                $grandtotal += ($row['total_price']*0.10)+$row['total_price'];
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
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(160, 5, 'Grand Total', 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($grandtotal), 1, 1, 'R');

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


            $pdf->AddPage();

            //invoice contents
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(0, 5, 'Detail Penjualan', 0, 1, 'C'); //end of line
            $pdf->LN(10);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 5, 'No.', 1, 0);
            $pdf->Cell(50, 5, 'Kode Transaksi', 1, 0, 'C');
            $pdf->Cell(70, 5, 'Menu', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Jumlah', 1, 0, 'C');
            $pdf->Cell(40, 5, 'Harga (Rp)', 1, 1, 'C'); //end of line

            $pdf->SetFont('Arial', '', 10);

            //Numbers are right-aligned so we give 'R' after new line parameter

            //items
           $query1 = 'SELECT *, a.date FROM tbltransac a INNER JOIN tbltransacdetail b ON
           a.`transac_code`=b.`transac_code` INNER JOIN tblproducts c ON
           b.`product_code`=c.`product_id` INNER JOIN tblsaus d ON
           b.`kd_saus`=d.`id_saus` WHERE MONTH(`date`) = '.$month.' AND
           YEAR(`date`)= '.$year.' AND NOT transac_type ="Catering"';
           $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
           $totalqty = 0;
           $totalprofit = 0;
           $no = 1;

            //display the items
            while ($item = mysqli_fetch_assoc($result1)) {
                $pdf->Cell(10, 5, $no++, 1, 0,);
                $pdf->Cell(50, 5, $item['transac_code'], 1, 0,);
                if($item['nama_saus'] == "Tanpa Saus"){
                    $pdf->Cell(70, 5, $item['product_name'], 1, 0,);
                }else{
                    $pdf->Cell(70, 5, $item['product_name'] . " + " . $item['nama_saus'], 1, 0,);
                }
                //add thousand separator using number_format function
                $pdf->Cell(20, 5, number_format($item['qty']), 1, 0, 'C');
                if($item['nama_saus'] == "Tanpa Saus"){
                $pdf->Cell(40, 5, number_format($item['price']), 1, 1, 'R');
                //end of line
                }else{
                $pdf->Cell(40, 5, number_format($item['price']). ' + '. number_format($item['harga_saus']), 1, 1, 'R');
                //end of line
                }
                
                //accumulate tax and amount
                // $tax += $item['price'];
                // $amount += $item['price'];
            }

           


            $filename = "Report_Penjualan.pdf";

            $pdf->Output($filename, 'I');
    }

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//ubah header