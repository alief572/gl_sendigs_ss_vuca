<?php 
	function tampil_menu($pn_jabatan){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$CI->load->model('all_model');
		$menu_utama = $CI->menu_model->m_get_menu_utama($pn_jabatan);
		if($menu_utama > 0){
			foreach ($menu_utama as $row){
				$url 		= $row->url;
				$id_menu 	= $row->id_menu;
				$nama_menu 	= $row->nm_menu;
				$urutan 	= $row->urutan;
				$img 		= $row->img;

				$sub_menu = $CI->menu_model->m_get_submenu($pn_jabatan,$id_menu);
				$active_submenu = $CI->menu_model->check_active_submenu($id_menu);
				if($active_submenu) {
					$akt = "class='active'";
				} else {
					if (current_url() == site_url('/').$url) {
						$akt = "class='active'";
					} else {
						$akt = "";
					}
				}

				if($sub_menu >0){
					$url = "#";
				}else{
					$url = base_url().'index.php/'.$url;
				}

				echo "<li $akt>
					<a href='$url'>
					<i class='fa fa-$img'></i><span>".$nama_menu."</span>
					<span class='pull-right-container'>";
					if($sub_menu >0){
						echo "<i class='fa fa-angle-left pull-right'></i>";
					}
					echo "</span>
					</a>";
					if($sub_menu >0){
						echo "<ul class='treeview-menu'>";
							foreach($sub_menu as $row_sub){
								$url_sub	= $row_sub->url;
								if(current_url() == site_url('/').$url_sub){
									$act_sub = "class='active'";
								}else{
									$act_sub = "";
								}
								$nama_sub	= $row_sub->nm_menu;
								echo "<li $act_sub><a href='".site_url('/').$url_sub."'><i class='fa fa-circle-o'></i>".$nama_sub."</a></li>";
							}
						echo "</ul>";
					}
				echo "</li>";
			}
		}
	}
	
	function cek_read($read){
		if($read == 'N'){
			echo "<script>
					alert('Maaf Anda tidak berhak mengakses halaman ini');
					window.location.href='".base_url()."';
					</script>";
		}
	}
	
	function Terbilang($x)
	{
	  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	  if ($x < 12)
		return " " . $abil[$x];
	  elseif ($x < 20)
		return Terbilang($x - 10) . "belas";
	  elseif ($x < 100)
		return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
	  elseif ($x < 200)
		return " seratus" . Terbilang($x - 100);
	  elseif ($x < 1000)
		return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
	  elseif ($x < 2000)
		return " seribu" . Terbilang($x - 1000);
	  elseif ($x < 1000000)
		return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
	  elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
	  elseif ($x < 1000000000000)
		return Terbilang($x / 1000000000) . " Milyar" . Terbilang($x % 1000000000);
	}
	
	function Terbilang_kapital($x)
	{
	  $abil = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
	  if ($x < 12)
		return " " . $abil[$x];
	  elseif ($x < 20)
		return Terbilang($x - 10) . "BELAS";
	  elseif ($x < 100)
		return Terbilang($x / 10) . " PULUH" . Terbilang($x % 10);
	  elseif ($x < 200)
		return " seratus" . Terbilang($x - 100);
	  elseif ($x < 1000)
		return Terbilang($x / 100) . " RATUS" . Terbilang($x % 100);
	  elseif ($x < 2000)
		return " seribu" . Terbilang($x - 1000);
	  elseif ($x < 1000000)
		return Terbilang($x / 1000) . " RIBU" . Terbilang($x % 1000);
	  elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " JUTA" . Terbilang($x % 1000000);
	  elseif ($x < 1000000000000)
		return Terbilang($x / 1000000000) . " MILYAR" . Terbilang($x % 1000000000);
	}
	
	function Terbilang_inggris($n) {
  if ($n < 0) return 'minus ' . terbilang(-$n);
  else if ($n < 10) {
    switch ($n) {
      case 0: return 'Zero';
      case 1: return 'One';
      case 2: return 'Two';
      case 3: return 'Three';
      case 4: return 'Four';
      case 5: return 'Five';
      case 6: return 'Six';
      case 7: return 'Seven';
      case 8: return 'Eight';
      case 9: return 'Nine';
    }
  }
  else if ($n < 100) {
    $kepala = floor($n/10);
    $sisa = $n % 10;
    if ($kepala == 1) {
      if ($sisa == 0) return 'Ten';
      else if ($sisa == 1) return 'Eleven';
      else if ($sisa == 2) return 'Twelve';
      else if ($sisa == 3) return 'Thirteen';
      else if ($sisa == 5) return 'Fifteen';
      else if ($sisa == 8) return 'Eighteen';
      else return Terbilang_inggris($sisa) . 'teen';
    }
    else if ($kepala == 2) $hasil = 'Twenty';
    else if ($kepala == 3) $hasil = 'Thirty';
    else if ($kepala == 5) $hasil = 'Fifty';
    else if ($kepala == 8) $hasil = 'Eighty';
    else $hasil = Terbilang_inggris($kepala) . 'ty';
  }
  else if ($n < 1000) {
    $kepala = floor($n/100);
    $sisa = $n % 100;
    $hasil = Terbilang_inggris($kepala) . ' Hundred';
  }
  else if ($n < 1000000) {
    $kepala = floor($n/1000);
    $sisa = $n % 1000;
    $hasil = Terbilang_inggris($kepala) . ' Thousand';
  }
  else if ($n < 1000000000) {
    $kepala = floor($n/1000000);
    $sisa = $n % 1000000;
    $hasil = Terbilang_inggris($kepala) . ' Million';
  }
  else if ($n < 1000000000000) {
    $kepala = floor($n/1000000000);
    $sisa = $n % 1000000000;
    $hasil = Terbilang_inggris($kepala) . ' Billion';
  }
  else return false;

  if ($sisa > 0) $hasil .= ' ' . Terbilang_inggris($sisa);
  return $hasil;
}
	function nm_bulan($bln){
		$bulan = array('','Januari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$nm_bulan = $bulan[$bln];
		return $nm_bulan;
	}
	
?>
