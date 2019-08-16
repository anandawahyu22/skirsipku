<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar kampus</title>
<?php
error_reporting(0);
if(!isset($this->session->username)){
  /*header("Location: login");
  exit;*/
  $tambah_table = '';
  $tambahdata = '';
  $hehe = 'hidden';
}else{
    $tambahdata = "<div class=\"form-group\">
                <a class=\"btn btn-primary\" href=".base_url('index.php/welcome/tambah_alt')."><span class=\"glyphicon glyphicon-plus\"></span> Tambah Kampus</a>
            </div>";
    $tambah_table = '<th>Aksi</th>';
    $hehe = '';
}

require_once('header.php');
?>
</head>
<body>
	<?php
require_once('body.php');
?>
<div class="container">
<div class="page-header">
  <div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <!-- <input type="hidden" name="m" value="kriteria" /> -->
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Cari Nama Kampus. . ." name="q" value="" />

            </div>
            <div class="form-group">
            <!--     <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
             --></div>
            <?php echo $tambahdata;?>
            <!-- <div class="form-group">
                <a class="btn btn-primary" href="<?php //echo base_url('index.php/welcome/tambah_alt');?> "><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div> -->
            <div class="form-group">
            <!--     <a class="btn btn-default" target="_blank" href="cetak.php?m=kriteria&q="><span class="glyphicon glyphicon-print"></span> Cetak</a>
             --></div>
        </form>
    </div>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
		<th>No</th>
		<th>Nama Kampus</th>
    <th>Situs Kampus</th>
		<?php echo $tambah_table;?>
		</tr>
</thead>
<tbody>
<?php
foreach ($rows as $data_kampus) {
?>
  <tr>
    <td>K<?php echo $data_kampus['id_kampus'];?></td>
    <td><?php echo $data_kampus['nama_kampus'];?></td>
    <td><a href><?php echo $data_kampus['link'];?><a></td>
    <td <?php echo $hehe;?>>
            <a class="btn btn-xs btn-info" href="<?php echo base_url('index.php/welcome/lihat_kampus/'.$data_kampus['id_kampus']);?>"><span class="glyphicon glyphicon-eye-open"></span> View Data</a>
<!-- <a class="btn btn-xs btn-info" href="<?php //echo base_url('index.php/welcome/aksi_alternatif/'.$data_kampus['id_kampus']);?>"><span class="glyphicon glyphicon-eye-open"></span> View Data</a>
            
 -->            
            <a class="btn btn-xs btn-danger" href="<?php echo base_url('index.php/welcome/delete_alternatif/'.$data_kampus['id_kampus']);?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
  </tr>
<?php
} 
?>
</tbody>
</table>
<center>
<ul class="pagination">

 <?php for ($i=1; $i<=$pages ; $i++){ ?>

 <li ><a href="?halaman=<?php echo $i; ?>"><?php echo $i;?></a></li>
  <?php } ?>
  </ul>
  </center>
</div>
</div>
</div>
<?php
require_once('footer.php');
?>
</body>
</html>