<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN transmasuk //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan transaksi kas masuk</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lapmasuk&act=view"><i class="fa fa-dashboard"></i> Laporan transaksi kas masuk</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
  
  <form action="?pg=lapmasuk&act=cek" method="POST">
  <div class="col-md-3">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal transaksi kas masuk Awal</label>
      <input class="form-control" id="date" name="tgltransmasukaw" placeholder="MM/DD/YYY" type="text"/>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal transaksi kas masuk Akhir</label>
      <input class="form-control" id="date" name="tgltransmasukak" placeholder="MM/DD/YYY" type="text"/>
      </div>
  </div>
  
  <div class="col-md-3">
      <div class="form-group">
      <label for="exampleInputEmail1">Mulai Pencarian</label><br>
      <input type="submit" value="Pencarian" class="btn btn-primary">
      </div>
  </div>
  </form>


  </div>

  <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Kas Masuk</th>
                        <th>Keterangan</th>
                        <th>Nominal/Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php
                 //   $tampil=mysql_query("SELECT * FROM transmasuk r  join tblkasmasuk s 
                   // on (s.id_kasmasuk=r.id_kasmasuk) order by kd_transmasuk asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$r[kd_transmasuk]"?></td>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[detil]"?></td>
                        <td><?php echo "Rp.". number_format("$r[nominal]",'0','.','.')?></td>
                        <td><a href="?pg=transmasuk&act=edit&id=<?php echo $r['kd_transmasuk']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=transmasuk&act=delete&id=<?php echo $r['kd_transmasuk']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>

                    <tr>
                    <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                    <?php
                    /*
                    $liatHarga=mysql_fetch_array(mysql_query("SELECT sum(harga) as harga, 
                    sum(isv_sales) as isv_sales,sum(isv_mgr) as isv_mgr,
                    sum(isv_spv) as isv_spv,sum(isv_ptgs) as isv_ptgs
                    FROM tblrealisasi r join tblproduk p on (r.id_produk=p.id_produk) 
                    order by notransmasuk asc"));
                    */
                    ?>

                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[harga],-"?></td>
                    </tr>
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
  $sqlp = "SELECT * FROM transmasuk r  join tblkasmasuk s on (s.id_kasmasuk=r.id_kasmasuk) 
           WHERE r.tgl BETWEEN  '$_POST[tgltransmasukaw]' AND  '$_POST[tgltransmasukak]'
          
           ORDER BY kd_transmasuk ASC";

  $rs=mysqli_query($GLOBALS["___mysqli_ston"], $sqlp);
  $data=mysqli_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan transaksi kas masuk</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lapmasuk&act=view"><i class="fa fa-dashboard"></i> Laporan transaksi kas masuk</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
     
      <form action="?pg=lapmasuk&act=cek" method="POST">
       <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal transaksi kas masuk Awal</label>
          <input class="form-control" id="date" name="tgltransmasukaw" placeholder="MM/DD/YYY" type="text"/>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal transaksi kas masuk Akhir</label>
          <input class="form-control" id="date" name="tgltransmasukak" placeholder="MM/DD/YYY" type="text"/>
          </div>
      </div>
      
      <div class="col-md-3">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn bg-orange">
          </div>
      </div>
      </form>
      <div class="col-md-5">
      <form role="form" action="cetak_kasmasuk.php" method="POST" target="_blank">
              <div class="box-body">
              
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                  <i class="fa fa-file-pdf-o">   Cetak Laporan transaksi kas masuk </i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="tgltransmasukaw" name="tgltransmasukaw" placeholder="Tanggal Transaksi Awal" value= "<?php echo $_POST['tgltransmasukaw']?>">
                  <input type="hidden" class="form-control" id="tgltransmasukak" name="tgltransmasukak" placeholder="Tanggal Transaksi Akhir" value= "<?php echo $_POST['tgltransmasukak']?>">
                  </div>
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
                            <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Kas Masuk</th>
                        <th>Keterangan</th>
                        <th>Nominal/Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transmasuk r  join tblkasmasuk s 
                    on (s.id_kasmasuk=r.id_kasmasuk)
                        WHERE r.tgl BETWEEN  '$_POST[tgltransmasukaw]' AND  '$_POST[tgltransmasukak]'
                        ORDER BY kd_transmasuk ASC");
                        $no = 1;
                          while ($r=mysqli_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                          <?php  $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$r[kd_transmasuk]"?></td>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[detil]"?></td>
                        <td><?php echo "Rp.". number_format("$r[nominal]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(nominal) as total_transmasuk FROM transmasuk
                       
                        where  tgl BETWEEN '$_POST[tgltransmasukaw]' AND  '$_POST[tgltransmasukak]'
                       
                        ORDER BY kd_transmasuk ASC"));
                        ?>

                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_transmasuk]",'0','.','.')?></td>
                        
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
                  <input type="hidden" class="form-control" id="tgltransmasukaw" name="tgltransmasukaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tgltransmasukaw']?>">
                  <input type="hidden" class="form-control" id="tgltransmasukak" name="tgltransmasukak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tgltransmasukak']?>">
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
              <li><a href="?pg=lapmasuk&act=view"><i class="fa fa-dashboard"></i> laporan transaksi kas masuk</a></li>
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