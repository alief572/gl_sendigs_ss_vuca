<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Multi_bum extends CI_Controller
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
            // $Datefr			= $this->input->post('datefr');
            // $Datetl			= $this->input->post('datetl');
            $Datefr            = date("Y-m-d", strtotime($this->input->post('datefr')));
            $Datetl            = date("Y-m-d", strtotime($this->input->post('datetl')));
        }
        $rows_Cabang        = create_Cabang();
        $records            = $this->m_list->databum($Cabang_Pilih, $Datefr, $Datetl);

        $data                = array(
            'action'         => 'index',
            'cabang_pilih'   => $Cabang_Pilih,
            'tgl_awal'       => $Datefr,
            'tgl_akhir'      => $Datetl,
            'rows_cabang'    => $rows_Cabang,
            'rows_data'      => $records
        );

        $this->load->view('Multi_bum/multi_bum_view', $data);
    }

    public function detail_bum($no_bum)
    {
		
				
        $sql = "
            SELECT 
               jurnal.*, jurnal.no_perkiraan, coa_master.nama 
            FROM 
                jurnal 
			INNER JOIN coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan 
            WHERE 
                (jurnal.tipe = 'BUM' OR jurnal.tipe LIKE'J%')
                AND jurnal.nomor = '" . $no_bum . "'
                AND SUBSTR(jurnal.no_perkiraan,1,4) NOT IN ('1102','1101') 
            ORDER BY 
                jurnal.debet DESC
        ";
        $data['detail']         = $this->db->query($sql);
        $data['rows_header']     = $this->db->get_where('jarh', array('nomor' => $no_bum))->result();
        //$data['nobum']          = $no_bum;

        $this->load->view("Multi_bum/multi_bum_detail", $data);
    }

    public function print_bum()
    {
        $this->load->library("m_pdf");
        //$this->load->helper("currency");
        $pdf            = $this->m_pdf->load_c(); // load_c()
        $get_bum = $this->input->get('no_bum');
        $data["nomor_bum"] = $get_bum;
        $html = $this->load->view("Multi_bum/multi_bum_print", $data, true);

        $pdfFilePath = "BUM_" . date('d-m-Y') . ".pdf";
        $pdf = new mPDF("c", "A4", "", "", "5", "5", "8", "0", "0", "0", "L");
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }
    public function print_jbum()
    {
        $this->load->library("m_pdf");
        //$this->load->helper("currency");
        $pdf            = $this->m_pdf->load_c(); // load_c()
        // $get_bum = $this->input->get('no_bum');
        $get_bum = $this->uri->segment(3);
        $data["nomor_bum"] = $get_bum;
        $html = $this->load->view("Multi_bum/multi_bum_print", $data, true);

        $pdfFilePath = "BUM_" . date('d-m-Y') . ".pdf";
        $pdf = new mPDF("c", "A4", "", "", "5", "5", "8", "0", "0", "0", "L");
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }
    public function print_jv()
    {
        $this->load->library("m_pdf");
        //$this->load->helper("currency");
        $pdf            = $this->m_pdf->load_c(); // load_c()
        // $get_bum = $this->input->get('no_bum');
        $get_jv = $this->uri->segment(3);
		
		
        $data["nomor_jv"] = $get_jv;
        $html = $this->load->view("Multi_bum/print_jv", $data, true);

        $pdfFilePath = "JV_" . date('d-m-Y') . ".pdf";
        $pdf = new mPDF("c", "A4", "", "", "5", "5", "8", "0", "0", "0", "L");
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }
}
