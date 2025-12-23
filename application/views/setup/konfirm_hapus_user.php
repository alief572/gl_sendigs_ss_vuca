<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$usr2 = $this->uri->segment(3);
?>
	
<br><br>
<center>
<h1>Yakin Mau Menghapus User <?=$usr2?></h1>
<a href="<?=base_url()?>index.php/setup/user_login" class="btn btn-primary" width="20%" ><h2>Tidak</h2></a>&nbsp;&nbsp;
<a href="<?=base_url()?>index.php/setup/proses_hapus_user/<?=$usr2?>" class="btn btn-primary" width="20%" ><h2>Ya, Hapus</h2></a>