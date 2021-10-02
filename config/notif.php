<?php
error_reporting(0);
include "koneksi.php";
$tgldata= date('d-m-y');


//menampilkan jumlah keseluruhan buku
$query_a=mysql_query("SELECT * FROM fakta_alumni ORDER BY id_fakta_alumni");
$jumlah_responden=mysql_num_rows($query_a);
// menampilkan jumlah buku yang baru di inputkan
$queri_a=mysql_query("SELECT * FROM fakta_alumni where tgl_input='$tgldata' ORDER BY id_fakta_alumni");
$inputan_baru=mysql_num_rows($queri_a);




//menampilkan jumlah keseluruhan buku
$query_b=mysql_query("SELECT * FROM alumni where idusers != '37' ORDER BY id_alumni");
$jumlah_alumni=mysql_num_rows($query_b);
// menampilkan jumlah buku yang baru di inputkan
$queri_b=mysql_query("SELECT * FROM alumni where tgl_input='$tgldata' ORDER BY id_alumni");
$alumni_baru=mysql_num_rows($queri_b);


?>