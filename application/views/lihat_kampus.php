<!DOCTYPE html>
<html lang="en">
<head>
<title>Kriteria kampus</title>
<?php
error_reporting(0);
if(!isset($this->session->username)){
  $button = "btn btn-warning disabled";
  $update_url = "";
  $hehe = 'hidden';
}
else{

  $button = "btn btn-warning active";
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
 <div <?php echo $hehe;?> class="form-group">
  
                <a class="<?php echo $button;?>" href="<?php echo base_url($update_url);?>"><span class="glyphicon glyphicon-refresh"></span> Update Nilai</a>
                <a class="<?php echo $button;?>" href="<?php echo base_url($update_nama);?>"><span class="glyphicon glyphicon-refresh"></span> Update Nama Kampus</a>
                
              
            </div>
<!-- <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="" />
 --></div>
</form>
</div>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th rowspan="2"><center>Nama Kampus</center></th>

<center><th colspan="<?php echo $jumlah_kriteria; ?>"><center>Kriteria</center></th></center>
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
 <td>
          <!--   <a class="btn btn-xs btn-info" href="<?php echo base_url('index.php/welcome/alternatif/');?>"><span class="glyphicon glyphicon-eye-open"></span> View</a>
         --></td>
</tr>
<?php
}
?>

</tbody>
</table>
<center><h2><?php echo $update_nilai;?></h2></center>
</div>
</div>
<?php
require_once('footer.php');
?>
</body>
</html>