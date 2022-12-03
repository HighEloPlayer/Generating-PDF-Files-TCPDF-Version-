<?php
require "../vendor/autoload.php";

$csv_file = '../files/population-2022.csv';
$handle = fopen($csv_file, 'r');
$row_index = 1; // initialize
$headers = [];
$data = [];
$barcode = [];

while (($row_data = fgetcsv($handle, 1000, ',')) !== FALSE)
{
	if ($row_index++ < 2)
	{
		foreach ($row_data as $col)
		{
			array_push($headers, $col);
		}
		continue;
	}
    
	$tmp = [];
    //var_dump($row_data[$index]);
	for ($index = 0; $index < count($headers); $index++)
	{
		$tmp[$headers[$index]] = $row_data[$index];
	}
	array_push($data, $tmp);

}
fclose($handle);

class PDF extends TCPDF {
	function BasicTable($header, $data)
	{
		// Header
		foreach($header as $col)
			$this->Cell(35,20,$col,1,0,'C');
			$this->Ln();																																	
		// Data
		foreach($data as $row)
		{
			$country_code = array_slice($row, 1, 1, true);

			foreach($row as $col) 
				$this->Cell(35,30,$col,1,0,'C');
				$x = $this->GetX();
				$y = $this->GetY();

			foreach($country_code as $code)
					$brstyle = array(
						'position' => '',
						'align' => 'C',
						'stretch' => false,
						'fitwidth' => true,
						'cellfitalign' => '',
						'border' => true,
						'hpadding' => 'auto',
						'vpadding' => 'auto',
						'fgcolor' => array(167,66,245),
						'bgcolor' => false, //array(255,255,255),
						'text' => true,
						'font' => 'helvetica',
						'fontsize' => 8,
						'stretchtext' => 4);

					$this->write1DBarcode($code, 'C93', '', '', 35, 30, 0.4, $brstyle, '');

                    $qrstyle = array(
                        'border' => 2,
                        'vpadding' => 'auto',
						'hpadding' => 'auto',
                        'fgcolor' => array(212,252,119),
                        'bgcolor' => false
                    );

					$this->write2DBarcode($code, 'QRCODE,L', $x+35, $y, 35, 30, $qrstyle, '',true);

					$this->Ln();
		}

		
	}
}


// create new PDF document
$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetFont('helvetica','',12);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ryan Matthew C. Masanque');
$pdf->SetTitle('Display Information PDF');
$pdf->SetSubject('PDC10 TCPDF Activity');
$pdf->SetKeywords('TCPDF, PDF, activity');

$pdf->SetHeaderData("", "0", "Created by", "Ryan Matthew C. Masanque", array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set margins
$pdf->SetMargins(10, 20, 0, false);

$pdf->setPrintFooter(true);
$pdf->setPrintHeader(true);

$header = array('#', 'Country', 'Population (2022)', 'Bar Code', 'QR Code');
$pdf->setCellPaddings(0,0,0,0);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output('display-population.pdf', 'I');