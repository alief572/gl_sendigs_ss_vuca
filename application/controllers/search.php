<?php
$dbHost = 'localhost';
		$dbUsername = 'root';
		$dbPassword = '';
		$dbName = 'db_master';
		$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
		//get search term
		$searchTerm = $_GET['term'];
		//get matched data from skills table
		$query = $db->query("SELECT * FROM dk_mster_kategori WHERE nm_keterangan LIKE '%".$searchTerm."%' ORDER BY id ASC");
		while ($row = $query->fetch_assoc()) {
			$data[] = $row['nm_keterangan'];
		}
		//return json data
		echo json_encode($data);
?>