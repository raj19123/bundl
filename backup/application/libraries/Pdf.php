<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// use Dompdf\Adapter\CPDF;
// use Dompdf\Dompdf;
// use Dompdf\Exception;

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
        $dompdf = new Dompdf\Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        // setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        $dompdf->render();

        $output = $dompdf->output();
        file_put_contents('uploads/'.$filename, $output);

        // move_uploaded_file($output, "uploads/");
        // if($download)
        //     $dompdf->stream($filename, array('Attachment' => 1));
        // else
        //     $dompdf->stream($filename, array('Attachment' => 0));
    }
}