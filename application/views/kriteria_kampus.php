<!DOCTYPE html>
<html lang="en">
<head>
<title>Kriteria kampus</title>	
<?php
error_reporting(0);
if(!isset($this->session->username)){
  $button = "btn btn-primary disabled";
  $update_url = "";
  $hehe = 'hidden';
  $tambah_table = '';
}
else{

  $tambah_table = '<th>Aksi</th>';
	$button = "btn btn-primary active";
  $update_url = "index.php/welcome/updatedataperpage?halaman=$halaman";
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
</div>  
<div class="panel panel-default">
<div class="panel-heading">
<form class="form inline">
<!-- <input type="hidden" name="m" value="kriteria"/> -->
<div class="form-group">
<input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="" />
</div>
</form>
</div>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th rowspan="2"><center>Nama Kampus</center></th>

<center><th colspan="<?php echo $jumlah_kriteria; ?>"><center>Kriteria</center></th></center>
<?php echo $tambah_table;?>
<tr>
<?php
foreach ($nama_kriteria as $data_kriteria) {
?>
<th>
<?php echo $data_kriteria['nama_kriteria']; ?></th>
<?php
} 
?>

</tr>
</thead>
<tbody>

<?php
foreach ($kampus as $data_kampus) {
?>
<tr>
<td>
<center><?php echo $data_kampus['nama_kampus']; ?></center>
</td>
<?php

      $nilai = $model->getValuesById($data_kampus['id_kampus']);
      foreach ($nilai as $data_nilai) {
       ?>
<td>
<center><?php echo $data_nilai['nilai']; ?></center>
</td>

<?php

}
?>
 <td <?php echo $hehe;?>>
    <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/welcome/lihat_kampus/'.$data_kampus['id_kampus']);?>"><span class="glyphicon glyphicon-edit"></span> Update</a>
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
<?php
require_once('footer.php');
?>
</body>
</html>