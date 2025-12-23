<?php

$server_db='dutastudy.com';
$user='dqyrdkle_tesbakat';
$password='tamankebaleng1no2';

$conn=mysql_connect($server_db,$user,$password);
mysql_select_db("dqyrdkle_tesbakat");


$sql1="SELECT
tbabsen_engine.id,
tbabsen_engine.idabsen,
tbabsen_engine.id_in_mesin,
tbabsen_engine.tanggal,
tbabsen_engine.idcabang,
tbabsen_engine.masuk,
tbabsen_engine.keluar,
tbabsen_engine.keterangan,
tbabsen_engine.dateupdate,
tbabsen_engine.nohp,
tbabsen_engine.`status`,
tbabsen_engine.feedback_wa
FROM
tbabsen_engine where status='BELUM' ";


$result = mysql_query($sql1,$conn);
while($row = mysql_fetch_array($result))
{
	$pesan  	= $row['keterangan'];
	$phone_no	= $row['nohp'];
	$idwa	    = $row['id'];

$send_whatsapp = file_get_contents("http://rental.agungrent.co.id/whatsapp/kirim.php?salt=4gungr3ntzxcvbnm&no_hp=".$phone_no."&pesan=".urlencode($pesan));							

$sql2="update tbabsen_engine set feedback_wa='$send_whatsapp',status='kirim' where id='$idwa' ";
$ex=mysql_query($sql2);

	
}



?>