<?php

class Report_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
	}
	
	function report_pendapatan_today() {
		$sql	= "SELECT
								*
							FROM
								travel_tiket tiket
							INNER JOIN travel_passenger passenger ON tiket.passenger_id = passenger.passenger_id
							INNER JOIN travel_order ord ON passenger.book_id = ord.book_id
							WHERE
								ord.stsbayar = 'Y'
							AND ord.jadwal_berangkat = CURDATE()";
		$query= $this->db->query($sql);
		return $query->result();
	}
	
	function report_pendapatan_by_date($daterange) {
		$date = explode(' - ', $daterange);
		$from_date	= date('Y-m-d', strtotime($date[0]));
		$to_date		= date('Y-m-d', strtotime($date[1]));
		
		$sql	= "SELECT
								*
							FROM
								travel_tiket tiket
							INNER JOIN travel_passenger passenger ON tiket.passenger_id = passenger.passenger_id
							INNER JOIN travel_order ord ON passenger.book_id = ord.book_id
							WHERE
								ord.stsbayar = 'Y'
							AND ord.jadwal_berangkat>='$from_date'
							AND ord.jadwal_berangkat<='$to_date'";
		$query= $this->db->query($sql);
		return $query->result();
	}
	
}