<?php
class Posting_new_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_cabang()
	{
		$rows_Cabang	= array();
		$Login_ID		= $this->session->userdata('pn_id');
		$Login_Cab		= $this->session->userdata('singkat_cbg');
		$det_User		= $this->db->get_where('dk_user',array('pn_id'=>$Login_ID))->result();
		if($det_User[0]->pn_jabatan !=='0'){
			$det_Cabang	= $this->db->get_where('pastibisa_tb_cabang',array('kdcab'=>$Login_Cab))->result();
		}else{
			$det_Cabang	= $this->db->get('pastibisa_tb_cabang')->result();
		}
		if($det_Cabang){
			$rows_Cabang	= array(''=>'Select An Option');
			foreach($det_Cabang as $keyC=>$valC){
				$Nama_Cab				= $valC->cabang;
				$Kode_Cab				= $valC->kdcab;
				
				$rows_Cabang[$Kode_Cab]	= $Nama_Cab;
				
			}
		}
		return $rows_Cabang;
	}
	
}
