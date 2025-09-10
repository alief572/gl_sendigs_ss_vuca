<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_pdf
{

    function m_pdf()
    {
        $CI = &get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param = NULL)
    {
        include_once APPPATH . 'libraries/MPDF57/mpdf.php';

        if ($params == NULL) {
            $param = '"en-GB-x","A5","","",10,10,10,10,6,3';
        }

        return new mPDF($param);
    }
    function load_a4($param = NULL)
    {
        include_once APPPATH . 'libraries/MPDF57/mpdf.php';

        if ($params == NULL) {
            $param = '"en-GB-x","A5","","",10,10,10,10,6,3';
        }

        return new mPDF($param);
    }
    function load_c($param = NULL) //pake yang load_c
    {
        include_once APPPATH . 'libraries/MPDF57/mpdf.php';

        if ($params == NULL) {
            $param = '"A5"';
            // $param = '"en-GB-x","A5","","",0,0,0,0,0,0';
        }

        return new mPDF($param); //jadi pas didsini di ganti pas di print pprofiew di pdf jadinya landscape
    }
}
