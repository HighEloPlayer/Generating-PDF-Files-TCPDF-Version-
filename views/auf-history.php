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
$pdf->SetMargins(20, 100, 20, true);

$pdf->setPrintFooter(true);
$pdf->setPrintHeader(true);

$pdf->SetFont('dejavusans', '', 14, '', true);

$pdf->AddPage();

$pdf->setJPEGQuality(75);

$pdf->Image('../resources/images/auf-logo.jpg', 78, 15, 55, 80, 'JPG', 'http://auf.edu.ph', '', true, 130, '', false, false, 0, false, false, false);


$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$html = <<<EOD
<h1 style="text-align:center;font-size:32px"><a href="#" style="text-decoration:none;background-color:#007AFF;color:blue;">&nbsp;<span style="color:white;">AUF </span><span style="color:white;">History</span>&nbsp;</a></h1>
<p style="text-align:justify;text-indent:50px">Angeles University Foundation, a non-stock, non-profit educational institution, was established on May 25, 1962 by Mr. Agustin P. Angeles, Dr. Barbara Y. Angeles, and family. In less than nine years, the Institution was granted University status on April 16, 1971 by the Department of Education, Culture and Sports.</p>
<br>
<p style="text-align:justify;text-indent:50px">On December 4, 1975, the University was converted to a non-stock, non-profit educational foundation -- the Angeles couple and their children executed a Deed of Donation relinquishing their ownership. AUF was incorporated under Republic Act No. 6055, otherwise known as the Foundation Law, and became a tax-exempt institution approved by the Philippine government. All donations and bequests given to the AUF are tax deductible.</p>
<br>
<p style="text-align:justify;text-indent:50px">On February 14, 1978, AUF was converted to a Catholic University. As the first Catholic university in Central Luzon, AUF ensures not only professional success but total development which is anchored on Christian education that is holistic, integrated and formative. On February 20, 1990, the five-storey, 125-bed AUF Medical Center was inaugurated which now serves as a private teaching, training and research hospital, the first ever in Central Luzon.</p>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Output('display-info.pdf', 'I');
