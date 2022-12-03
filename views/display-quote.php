<?php

require "../vendor/autoload.php";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ryan Matthew C. Masanque');
$pdf->SetTitle('Display Information PDF');
$pdf->SetSubject('PDC10 TCPDF Activity');
$pdf->SetKeywords('TCPDF, PDF, activity');

$pdf->SetHeaderData("", "0", "Created by", "Ryan Matthew C. Masanque", array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set margins
$pdf->SetMargins(20, 20, 20, true);

$pdf->setPrintFooter(true);
$pdf->setPrintHeader(true);

$pdf->AddPage();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetFont('courier','',20);
$pdf->Write(10,'"Only by death is a true warrior defeated."','',false,'J');
$pdf->Ln(15);
$pdf->Write(10,'- Yujiro Hanma','',false,'R');
$pdf->Ln(30);

$pdf->SetFont('cid0jp','',20);
$pdf->Write(10,'"Dont be sorry be better."');
$pdf->Ln(15);
$pdf->Write(10,' - Kratos','',false,'R');
$pdf->Ln(30);

$pdf->SetFont('ZapfDingbats','',20);
$pdf->Write(10,'"You face the God of War."');
$pdf->Ln(15);
$pdf->Write(10,' - Ares','',false,'R');
$pdf->Ln(30);

$pdf->SetFont('cid0kr','',20);
$pdf->Write(10,'"The unseen blade is the deadliest."');
$pdf->Ln(15);
$pdf->Write(10,' - Zed','',false,'R');
$pdf->Ln(30);

$pdf->SetFont('Times','',20);
$pdf->Write(10,'"If one is born as a male, at least once in life, he’ll dream of becoming the strongest man alive."');
$pdf->Ln(15);
$pdf->Write(10,' - Hanma Baki','',false,'R');
$pdf->Ln(30);

$pdf->Output('display-info.pdf', 'I');
