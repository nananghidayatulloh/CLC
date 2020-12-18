<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("dompdf/dompdf_config.inc.php");

function pdf_create($html, $filename='', $stream) 
{
    $dompdf = new DOMPDF();
    $dompdf->load_html($html, 'UTF-8');
    $dompdf->set_paper('A5', 'potrait');
    $dompdf->render();
    if ($stream) {
        $canvas = $dompdf->get_canvas();
        $canvas->page_script('
        if ($PAGE_NUM >= 1) {
            $font = Font_Metrics::get_font("helvetica", "bold");
            $current_page = $PAGE_NUM;
            $total_pages = $PAGE_COUNT;
            $pdf->text(355, 575, "Page: $current_page of $total_pages", $font, 10, array(0,0,0));
        }
        ');
        $dompdf->stream($filename.".pdf", array("Attachment"=> false, 'isRemoteEnabled' => TRUE));
    } else {
        return $dompdf->output();
    }
}
?>