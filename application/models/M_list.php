<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class M_list extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->rental = $this->load->database("accounting", TRUE);
	}

	function getAll($table)
	{
		return $this->rental->get($table);
	}

	function getWhere($table, $where)
	{
		$this->rental->where($where);
		return $this->rental->get($table);
	}

	function getSomeWhere($field, $table, $where)
	{
		$this->rental->select($field);
		$this->rental->where($where);
		return $this->rental->get($table);
	}

	function getSomeWhereLike($field, $table, $where, $like)
	{
		$this->rental->select($field);
		$this->rental->where($where);
		$this->rental->like($like);
		return $this->rental->get($table);
	}

	function getSomeWhereNotLike($field, $table, $where, $like)
	{
		$this->rental->select($field);
		$this->rental->where($where);
		$this->rental->not_like($like);
		return $this->rental->get($table);
	}

	function getSQL($query)
	{
		return $this->rental->query($query);
	}

	function insertData($table, $data)
	{
		$this->rental->trans_start();
		$this->rental->insert($table, $data);
		$this->rental->trans_complete();

		if ($this->rental->trans_status() === FALSE) {
			echo "Tambah gagal";
		}
	}

	function updateData($table, $id, $data)
	{
		$this->rental->trans_start();
		$this->rental->set($data);
		$this->rental->where($id);
		$this->rental->update($table);
		$this->rental->trans_complete();

		if ($this->rental->trans_status() === FALSE) {
			echo "Ubah gagal";
		}
	}

	function deleteData($table, $id)
	{
		$this->rental->trans_start();
		$this->rental->where($id);
		$this->rental->delete($table);
		$this->rental->trans_complete();

		if ($this->rental->trans_status() === FALSE) {
			echo "Hapus gagal";
		}
	}

	public function get_datatables($table, $where, $search, $column_search, $column_order, $order)
	{
		$this->_get_datatables_query($table, $where, $search, $column_search, $column_order, $order);

		if ($_POST["length"] != -1)
			$this->rental->limit($_POST["length"], $_POST["start"]);

		$query = $this->rental->get();

		return $query->result();
	}

	public function count_filtered($table, $where, $search, $column_search, $column_order, $order)
	{
		$this->_get_datatables_query($table, $where, $search, $column_search, $column_order, $order);
		$query = $this->rental->get();

		return $query->num_rows();
	}

	private function _get_datatables_query($table, $where, $search, $column_search, $column_order, $order)
	{
		if (!empty($where)) {
			$this->rental->where($where);
		}

		foreach ($search as $row) {
			$this->rental->like($row["field"], $row["value"]);
		}

		$this->rental->from($table);

		$i = 0;
		foreach ($column_search as $item) {
			if ($_POST["search"]["value"]) {
				if ($i === 0) {
					$this->rental->group_start();
					$this->rental->like($item, $_POST["search"]["value"]);
				} else {
					$this->rental->or_like($item, $_POST["search"]["value"]);
				}

				if (count($column_search) - 1 == $i)
					$this->rental->group_end();
			}

			$i++;
		}

		if (isset($_POST["order"])) {
			$this->rental->order_by($column_order[$_POST["order"]["0"]["column"]], $_POST["order"]["0"]["dir"]);
		} else if (isset($order)) {
			$order = $this->order;
			$this->rental->order_by(key($order), $order[key($order)]);
		}
	}

	public function count_all($table)
	{
		$this->rental->from($table);

		return $this->rental->count_all_results();
	}

	function databuk($cab, $tgl_awal, $tgl_akhir)
	{
		$a = $this->db->query("SELECT a.nomor,
                a.tgl,
                a.jml,
                a.bayar_kepada,
                a.no_reff,
                a.user_id,
                a.* from japh as a WHERE 1=1
                AND a.kdcab = '$cab'
				AND a.jml!=0
                AND (a.tgl between '$tgl_awal' and '$tgl_akhir') order by a.nomor desc");
		return $a->result();
	}
	function databum($cab, $tgl_awal, $tgl_akhir)
	{
		$a = $this->db->query("SELECT a.nomor,
                a.tgl,
                a.jml,
                a.terima_dari,
                a.no_reff,
                a.user_id,
                a.* from jarh as a WHERE 1=1
                AND a.kdcab = '$cab'
				AND a.jml!=0
                AND (a.tgl between '$tgl_awal' and '$tgl_akhir') order by a.nomor desc");
		return $a->result();
	}

	function dataCn($cab, $tgl_awal, $tgl_akhir)
	{
		$a = $this->db->query("SELECT a.nomor,
                a.tgl,
                a.no_reff,
                a.nobukti,
                a.nontpn,
                a.user_id,
                a.* from jarh_cn as a WHERE 1=1
                AND a.kdcab = '$cab'
                AND a.tgl between '$tgl_awal' and '$tgl_akhir' order by a.nomor desc");
		return $a->result();
	}


	function getCab()
	{
		$this->db->select('cab_own');
		$this->db->from('pastibisa_tb_cabang');
		$this->db->where('cab_own !=', '-');
		$this->db->group_by('cab_own');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$result[$row->cab_own] = $row->cab_own;
		}
		return $result;
	}


	function getLokasi()
	{
		$this->db->select('*');
		$this->db->from('pastibisa_tb_cabang');
		$this->db->where('lokasi !=', '-');
		$this->db->group_by('lokasi');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$result[$row->lokasi] = $row->lokasi;
		}
		return $result;
	}
}
