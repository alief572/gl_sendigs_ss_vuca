<?php

  $host="36.66.111.65";
  $user="Admin1";
  $password="Password1"; 

  $link = mysql_connect('$host', '$user', '$pass');

  $sql_pilih="select po_date frim hutang_ktb";
  $ex=mysql_query($sql_pilih,$link);
  while($row=mysql_fetch_array($ex))
  {
    echo $row[po_date]."<br>";

  }


 
     $sql =" Insert into hutang_ktb(po_id,po_number,po_date,total_unit,grand_total,hutang_ktb,cab,bulan,tahun)  ";
     $sql .=" SELECT po_id,po_number,po_date,total_unit,grand_total,hutang_ktb,cab,'$bulan','$tahun' FROM dealer.po where hutang_ktb > 0 ";
 
    $sql2 .=" INSERT INTO `hutang_bbn` (`kode_pesanan`, `no_so`, `nama_stnk`, `cab`, `tgl_jual`, `faktur`, `model_mobil`, `no_rangka`, `bbn`, `hutang_bbn`, `bln`, `thn`) ';
    $sql2 .=" SELECT kode_pesanan,no_so,nama_stnk,cab,tgl_jual,faktur,model_mobil,no_rangka,bbn,hutang_bbn ');
    $sql2 .=" ,'$bulan','$tahun'  FROM dealer.so_kendaraan where hutang_bbn > 0 ');
  







?>