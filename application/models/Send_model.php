<?php
class Send_model extends Model{

    function Send_model(){
        parent::Model();
    }
    
    function get_email(){
        $this->db->select('users.email');
        $this->db->from('users');
        $this->db->where('units.owner = users.id');
		$this->db->where('speed_limit.unit_id = units.id');
		
        $query = $this->db->get();
		if($query->num_rows() > 0)
		return $query->result();

		return FALSE;
	}
    
    function get_name(){
        $this->db->select('users.username');
        $this->db->from('users');
        $this->db->where('units.owner = users.id');
        $this->db->where('speed_limit.unit_id = units.id');
        
        $query = $this->db->get();
		if($query->num_rows() > 0)
		return $query->result();

		return FALSE;
    }
    
    function get_speed(){
        $this->db->select('tracks.speed');
        $this->db->from('tracks');
        
        $query = $this->db->get();
		if($query->num_rows() > 0)
		return $query->result();

		return FALSE;
    }
    
    function get_speedlimit(){
        $this->db->select('speed_limit.batas');
        $this->db->from('speed_limit');
        
        $query = $this->db->get();
		if($query->num_rows() > 0)
		return $query->result();

		return FALSE;
    }
}