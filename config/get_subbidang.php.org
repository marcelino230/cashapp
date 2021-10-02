<?php
include "../config/koneksi.php";

$id_bidang= $_GET['id_bidang'];
$hasil = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT s.id_sub_bidang, s.nama_sub_bidang
from bidang_pekerjaan as b, sub_bidang_pekerjaan as s
  where b.id_bidang=s.id_bidang
  and b.id_bidang='$id_bidang'");
  
echo "<option>---- Pilih Sub Bidang----</option>";
 
while($k = mysqli_fetch_array($hasil)){
   	echo "<option value='$k[0],$k[1]'> " . ucwords($k[1]) ."</option>";
}
?>


