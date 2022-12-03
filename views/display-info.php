<?php

require "../vendor/autoload.php";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ryan Matthew C. Masanque');
$pdf->SetTitle('Display Information PDF');
$pdf->SetSubject('PDC10 TCPDF Activity');
$pdf->SetKeywords('TCPDF, PDF, activity');

// set margins
$pdf->SetMargins(35, 10, 10, true);

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);

$pdf->SetFont('dejavusans', '', 18, '', true);

$pdf->AddPage();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = '../resources/images/madara.jpg';
$pdf->Image($img_file, 65, 120, 100, 200, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$html = <<<EOD
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:none;background-color:#2378BA;color:black;">&nbsp;<span style="color:white;">Student </span><span style="color:white;">Information</span>&nbsp;</a></h1>
<p><b>Name: </b>Ryan Matthew C. Masanque</p>
<p><b>Program: </b>Bachelor of Science in Information Technology</p>
<p><b>Email: </b>Masanque.ryanmatthew@auf.edu.ph</p>
<p><b>Address: </b>Del Rosario</p>
<p><b>Student Number:</b> 20-0902-773</p>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Output('display-info.pdf', 'I');
