<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN trans //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Rekapitulasi Pengeluaran dan Pemasukan Kas</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=laprekap&act=view"><i class="fa fa-dashboard"></i> Laporan Rekapitulasi Pengeluaran dan Pemasukan Kas</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
  <div class="col-md-3">
  <form action="?pg=laprekap&act=cek" method="POST">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal transaksi Awal</label>
      <input class="form-control" id="date" name="tgltransaw" placeholder="MM/DD/YYY" type="text"/>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal transaksi  Akhir</label>
      <input class="form-control" id="date" name="tgltransak" placeholder="MM/DD/YYY" type="text"/>
      </div>
  </div>
  
  <div class="col-md-3">
      <div class="form-group">
      <label for="exampleInputEmail1">Mulai Pencarian</label><br>
      <input type="submit" value="Pencarian" class="btn btn-primary">
      </div>
  </div>
  </form>

  <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th><center> NO </center></th>
                        <th><center>TANGGAL</center></th>
                        <th><center>KODE VOUCHER</center></th>
                        <th><center>URAIAN</center></th>
                        <th><center>PENGELUARAN</center></th>
                        <th><center>PEMASUKAN</center></th>
                        <th><center>SALDO</center></th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php
                 //   $tampil=mysql_query("SELECT tbltransaksi.*,tblkasmasuk.*,tblkasmasuk.nama as namamasuk, tblkaskeluar.*,
                  //  tblkaskeluar.nama as namakeluar, tbljeniskas.* FROM tbltransaksi LEFT  join tblkasmasuk  on tbltransaksi.id_kasmasuk=tblkasmasuk.id_kasmasuk LEFT join tblkaskeluar ON tblkaskeluar.id_kaskeluar=tbltransaksi.id_kaskeluar INNER JOIN
                  //  tbljeniskas ON tbltransaksi.id_jeniskas=tbljeniskas.id_jeniskas GROUP BY tbltransaksi.kd_transaksi");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){

                         if($r[namamasuk]=='0'){
                          $kasmasuk= " - ";
                        } else{
                          $kasmasuk=$r[namamasuk];
                        }
                        if($r[namakeluar]=='0'){
                          $kaskeluar=" - ";  
                        } else{
                         $kaskeluar=$r[namakeluar];
                         }  

                         if($r[id_jeniskas]=='1'){
                          $nominalmasuk=$r[nominal];
                         } else {
                          $nominalmasuk="-";
                         }
                         if($r[id_jeniskas]=='2') {
                          $nominalkeluar=$r[nominal];
                         } else {
                          $nominalkeluar="-";
                         }
                         //$saldo=$nominalmasuk-$nominalkeluar;
                         if($no==1){
                         $saldo=$nominalmasuk-$nominalkeluar;
                         } else {
                          $saldo=$saldo+($nominalmasuk-$nominalkeluar);
                        }
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[kd_transaksi]"?></td>
                         <td><?php echo "$r[ket]"?></td>
                         <td><?php echo "Rp. " . number_format("$nominalkeluar",'0','.','.')?></td>
                        <td><?php echo "Rp. " . number_format("$nominalmasuk",'0','.','.')?></td>
                        <td><?php echo "Rp. " . number_format("$saldo",'0','.','.')?></td>
                       <!-- <td><a href="?pg=trans&act=edit&id=<?php echo $r['kd_trans']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=trans&act=delete&id=<?php echo $r['kd_trans']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        -->
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    <!--
                    <tr>
                    <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                    <?php
                    
                 //   $liatkeluar=mysql_fetch_array(mysql_query("SELECT sum(nominal) as nominal
                //    FROM tbltransaksi t join tblkaskeluar k on (t.id_kaskeluar=k.id_kaskeluar) 
                 //   order by kd_transaksi asc"));

                 //   $liatmasuk=mysql_fetch_array(mysql_query("SELECT sum(nominal) as nominal
                 //   FROM tbltransaksi t join tblkasmasuk m on (t.id_kasmasuk=m.id_kasmasuk) 
                 //   order by kd_transaksi asc"));
                    
               //     $saldoakhir=$liatmasuk[nominal]-$liatkeluar[nominal];

                    ?>
                     <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$liatkeluar[nominal]",'0','.','.')?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$liatmasuk[nominal]",'0','.','.')?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$saldoakhir",'0','.','.')?></td>
                    </tr> -->
                    </tbody>
                  </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<?php
break;

  case 'cek':
  // menampilkan pertanyaan pertama
  $sqlp = "SELECT tbltransaksi.*,tblkasmasuk.*,tblkasmasuk.nama as namamasuk, tblkaskeluar.*,
                    tblkaskeluar.nama as namakeluar, tbljeniskas.* FROM tbltransaksi LEFT  join tblkasmasuk  on tbltransaksi.id_kasmasuk=tblkasmasuk.id_kasmasuk LEFT join tblkaskeluar ON tblkaskeluar.id_kaskeluar=tbltransaksi.id_kaskeluar INNER JOIN
                    tbljeniskas ON tbltransaksi.id_jeniskas=tbljeniskas.id_jeniskas WHERE tbltransaksi.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' GROUP BY tbltransaksi.kd_transaksi  ";

  $rs=mysqli_query($GLOBALS["___mysqli_ston"], $sqlp);
  $data=mysqli_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan transaksi kas keluar</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=laprekap&act=view"><i class="fa fa-dashboard"></i> Laporan transaksi kas keluar</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
     
      <form action="?pg=laprekap&act=cek" method="POST">
       <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal transaksi kas keluar Awal</label>
          <input class="form-control" id="date" name="tgltransaw" placeholder="MM/DD/YYY" type="text"/>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal transaksi kas keluar Akhir</label>
          <input class="form-control" id="date" name="tgltransak" placeholder="MM/DD/YYY" type="text"/>
          </div>
      </div>
      
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn bg-orange">
          </div>
      </div>
      </form>
       </div>
      <div class="row">
              <div class="col-md-5">
              <form role="form" action="cetak_kas.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                  <i class="fa fa-file-pdf-o">   Cetak Laporan transaksi kas keluar </i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="tgltransaw" name="tgltransaw" placeholder="Tanggal Transaksi Awal" value= "<?php echo $_POST['tgltransaw']?>">
                  <input type="hidden" class="form-control" id="tgltransak" name="tgltransak" placeholder="Tanggal Transaksi Akhir" value= "<?php echo $_POST['tgltransak']?>">
                  
                  </div>
              </form>

              

          </div>

          </div>
         

      <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                      <div class="box-body">
                      <div class="table-responsive">
                      <table class="table table-hover responsive">
                        <thead>
                        <tr>
                        <th><center> NO </center></th>
                        <th><center>TANGGAL</center></th>
                        <th><center>KODE VOUCHER</center></th>
                        <th><center>URAIAN</center></th>
                        <th><center>PENGELUARAN</center></th>
                        <th><center>PEMASUKAN</center></th>
                        <th><center>SALDO</center></th>
                      </tr>
                        </thead>
                        <tbody>
                     <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT tbltransaksi.*,tblkasmasuk.*,tblkasmasuk.nama as namamasuk, tblkaskeluar.*,
                    tblkaskeluar.nama as namakeluar, tbljeniskas.* FROM tbltransaksi LEFT  join tblkasmasuk  on tbltransaksi.id_kasmasuk=tblkasmasuk.id_kasmasuk LEFT join tblkaskeluar ON tblkaskeluar.id_kaskeluar=tbltransaksi.id_kaskeluar INNER JOIN
                    tbljeniskas ON tbltransaksi.id_jeniskas=tbljeniskas.id_jeniskas WHERE tbltransaksi.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' GROUP BY tbltransaksi.kd_transaksi  ");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){

                         if($r[namamasuk]=='0'){
                          $kasmasuk= " - ";
                        } else{
                          $kasmasuk=$r[namamasuk];
                        }
                        if($r[namakeluar]=='0'){
                          $kaskeluar=" - ";  
                        } else{
                         $kaskeluar=$r[namakeluar];
                         }  

                         if($r[id_jeniskas]=='1'){
                          $nominalmasuk=$r[nominal];
                         } else {
                          $nominalmasuk="-";
                         }
                         if($r[id_jeniskas]=='2') {
                          $nominalkeluar=$r[nominal];
                         } else {
                          $nominalkeluar="-";
                         }
                         //$saldo=$nominalmasuk-$nominalkeluar;
                         if($no==1){
                         $saldo=$nominalmasuk-$nominalkeluar;
                         } else {
                          $saldo=$saldo+($nominalmasuk-$nominalkeluar);
                        }
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[kd_transaksi]"?></td>
                         <td><?php echo "$r[ket]"?></td>
                         <td><?php echo "Rp. " . number_format("$nominalkeluar",'0','.','.')?></td>
                        <td><?php echo "Rp. " . number_format("$nominalmasuk",'0','.','.')?></td>
                        <td><?php echo "Rp. " . number_format("$saldo",'0','.','.')?></td>
                       <!-- <td><a href="?pg=trans&act=edit&id=<?php echo $r['kd_trans']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=trans&act=delete&id=<?php echo $r['kd_trans']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        -->
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>

                    <tr>
                    <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                    <?php
                    
                    $liatkeluar=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(nominal) as nominal
                    FROM tbltransaksi t join tblkaskeluar k on (t.id_kaskeluar=k.id_kaskeluar) 
                    WHERE t.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' 
                    "));

                    $liatmasuk=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(nominal) as nominal
                    FROM tbltransaksi t join tblkasmasuk m on (t.id_kasmasuk=m.id_kasmasuk) 
                    WHERE t.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' 
                   "));
                    
                    $saldoakhir=$liatmasuk[nominal]-$liatkeluar[nominal];

                    ?>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$liatkeluar[nominal]",'0','.','.')?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$liatmasuk[nominal]",'0','.','.')?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$saldoakhir",'0','.','.')?></td>
                    </tr>
                    </tbody>
                      </table>
                      </div><!-- /.box-body -->
                  </div>
                  </div><!-- /.box -->
                  </div> <!-- /.col -->
      </div>
        <!-- /.row (main row) -->

      
        <!--   <div class="col-md-2 col-md-offset-2">
              <form role="form" action="cetak_jurnal.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                  <i class="fa fa-file-pdf-o">   Cetak Jurnal Buku Besar</i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="tgltransaw" name="tgltransaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tgltransaw']?>">
                  <input type="hidden" class="form-control" id="tgltransak" name="tgltransak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tgltransak']?>">
                  </div>
              </form>
          </div> -->
          </div>

    </section> <!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->

<?php
} else { 
  ?>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1> Silahkan pilih</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="?pg=laprekap&act=view"><i class="fa fa-dashboard"></i> laporan transaksi Pemasukan dan Pengeluaran Kas</a></li>
             </ol>
      </section>

      <section class="content">
          <div class="box box-success">
              <div class="box-body">
                  <div class="form-group">
                  <?php
                  echo " <p> Maaf untuk pencarian yang anda cari tidak tersedia. <br>
                  Silahkan coba lakukan pencarian ulang. Terima Kasih </p>";
                  
                  ?>
                  </div>
              </div>
          </div>
      </section> <!-- /.content -->
    </div> <!-- /.container -->
  </div> <!-- /.content-wrapper -->

  <?php
  }
  ?>

<?php
break;
}
?>