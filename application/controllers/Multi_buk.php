<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Multi_buk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model("m_list");
        $this->rental = $this->load->database("accounting", TRUE);
        $this->load->helper('menu');
    }

    public function index()
    {
        $controller = ucfirst(strtolower($this->uri->segment(1)));
        //echo "<pre>";print_r($this->session->userdata());exit;
        $records        = array();
        $Cabang_Pilih    = $this->session->userdata('nomor_cabang');
        if (empty($Cabang_Pilih)) $Cabang_Pilih    = $Cabang_Pilih;
        $Datefr            = date('Y-m-01');
        $Datetl            = date('Y-m-d');
        if ($this->input->post()) {
            $Cabang_Pilih    = $this->input->post('kode_cabang');
            // $Datefr            = date_format(new DateTime($this->input->post('datefr')), "Y-m-d");            
            // $Datetl            = date_format(new DateTime($this->input->post('datetl')), "Y-m-d");
            $Datefr            = date("Y-m-d", strtotime($this->input->post('datefr')));
            $Datetl            = date("Y-m-d", strtotime($this->input->post('datetl')));
        }
        $rows_Cabang        = create_Cabang();
        $records            = $this->m_list->databuk($Cabang_Pilih, $Datefr, $Datetl);

        $data                = array(
            'action'         => 'index',
            'cabang_pilih'   => $Cabang_Pilih,
            'tgl_awal'       => $Datefr,
            'tgl_akhir'      => $Datetl,
            'rows_cabang'    => $rows_Cabang,
            'rows_data'      => $records
        );

        $this->load->view('Multi_buk/multi_buk_view', $data);
    }

    public function detail_buk($no_buk)
    {
        $sql = "
            SELECT 
                * 
            FROM 
                jurnal 
            WHERE 
                tipe = 'BUK' 
                AND nomor = '" . $no_buk . "'
            ORDER BY 
                debet DESC
        ";
        $data['detail']         = $this->db->query($sql);
        $data['rows_header']     = $this->db->get_where('japh', array('nomor' => $no_buk))->result();
        // $data['nobum']          = $no_buk;

        $this->load->view("Multi_buk/multi_buk_detail", $data);
    }

    public function print_buk()
    {
        $this->load->library("m_pdf");
        //$this->load->helper("currency");
        $pdf            = $this->m_pdf->load_c();
        $get_buk = $this->input->get('no_buk');
        $data["nomor_buk"] = $get_buk;
        $html = $this->load->view("Multi_buk/multi_buk_print", $data, true);

        $pdfFilePath = "BUK_" . date('d-m-Y') . ".pdf";
        $pdf = new mPDF("c", "A4", "", "", "5", "5", "8", "0", "0", "0", "L");
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }
    public function print_jbuk()
    {
        $this->load->library("m_pdf");
        //$this->load->helper("currency");
        $pdf            = $this->m_pdf->load_c();
        // $get_bum = $this->input->get('no_buk');
        $get_buk = $this->uri->segment(3);
        $data["nomor_buk"] = $get_buk;
        $html = $this->load->view("Multi_buk/multi_buk_print", $data, true);

        $pdfFilePath = "BUK_" . date('d-m-Y') . ".pdf";
        $pdf = new mPDF("c", "A4", "", "", "5", "5", "8", "0", "0", "0", "L");
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }
}
