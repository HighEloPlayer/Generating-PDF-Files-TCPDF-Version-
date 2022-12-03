<?php

require "../vendor/autoload.php";

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

class MC_TCPDF extends TCPDF {

    /**
     * Print chapter
     * @param $num (int) chapter number
     * @param $title (string) chapter title
     * @param $file (string) name of the file containing the chapter body
     * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
     * @public
     */
    public function PrintChapter($num, $title, $file, $mode=false) {
        $this->AddPage();
        $this->resetColumns();
        $this->ChapterTitle($num, $title);
        $this->setEqualColumns(3, 57);
        $this->ChapterBody($file, $mode);
    }

    /**
     * Set chapter title
     * @param $num (int) chapter number
     * @param $title (string) chapter title
     * @public
     */
    public function ChapterTitle($num, $title) {
        $this->SetTextColor(220,50,50);
        $this->SetFont('helvetica', '', 14);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(180, 6, 'Chapter '.$num.' : '.$title, 0, 1, 'L', 1);
        $this->Ln(4);
    }

    /**
     * Print chapter body
     * @param $file (string) name of the file containing the chapter body
     * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
     * @public
     */
    public function ChapterBody($file, $mode=false) {
        $this->selectColumn();
        // get esternal file content
        $content = file_get_contents($file, false);
        // set font
        $this->SetFont('times', '', 9);
        $this->SetTextColor(50, 50, 50);
        // print content
        if ($mode) {
            // ------ HTML MODE ------
            $this->writeHTML($content, true, false, true, false, 'J');
        } else {
            // ------ TEXT MODE ------
            $this->Write(0, $content, '', 0, 'J', true, 0, false, true, 0);
        }
        $this->Ln();
    }
} 

$pdf = new MC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ryan Matthew C. Masanque');
$pdf->SetTitle('TCPDF Novels');
$pdf->SetSubject('PDC10 TCPDF');
$pdf->SetKeywords('TCPDF, PDF, starwars, novel');

$pdf->SetHeaderData("", "0", "For Academic Purposes Only", "by Ryan Matthew C. Masanque", array(0,64,255), array(0,64,128));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->PrintChapter(1, 'veldt chapter 1', '../resources/texts/theveldt-chapter1.txt', false);

$pdf->PrintChapter(2, 'veldt chapter 2', '../resources/texts/theveldt-chapter2.txt', true);

$pdf->PrintChapter(3, 'veldt chapter 3', '../resources/texts/theveldt-chapter3.txt', true);

$pdf->Output('theveldt.pdf', 'I');
