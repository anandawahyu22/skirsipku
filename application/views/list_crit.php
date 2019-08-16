<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar Kriteria</title>
<?php

if(!isset($this->session->username)){
  /*header("Location: login");
  exit;*/
  $tambah_table = '';
  $tambah_button = '';
  $hehe = 'hidden';
}else{
  $tambah_button = "<div class=\"form-group\">
                <a class=\"btn btn-primary\" href=".base_url('index.php/welcome/tambah_kriteria')."><span class=\"glyphicon glyphicon-plus\"></span> Tambah</a>
            </div>";
  $tambah_table =  '<th>Aksi</th>';           
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
            <input type="hidden" name="m" value="kriteria" />
            <!-- <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="" />
            </div>
             --><div class="form-group">
                <!-- <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
             --></div>
         <!--    <?php echo $tambah_button;?>
          -->   <div class="form-group">
          <!--       <a class="btn btn-default" target="_blank" href=""><span class="glyphicon glyphicon-print"></span> Cetak</a>
           -->  </div>
        </form>
    </div>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
		<th>No</th>
		<th>Nama Kriteria</th>
    <th>Reference URL</th>
		<th>Jenis</th>
		<th>Bobot</th>
    <?php echo $tambah_table;?>
	</tr>
  </thead>
	<tbody>
<?php
foreach ($rows as $row) {
  $id = $row['id_kriteria'];
?>
      <td>C<?php echo $row['id_kriteria'];?></td>
      <td><?php echo $row['nama_kriteria'];?></td>
      <td><a href><?php echo $row['reference_link'];?> </a></td>
      <td><?php echo $row['jenis'];?></td>
      <td><?php echo $row['bobot']*100;?>%</td>
     <td <?php echo $hehe;?>>
            <a class="btn btn-xs btn-warning" href="<?php echo base_url("index.php/welcome/update_kriteria_v1");?>"><span class="glyphicon glyphicon-edit"></span></a>
            <!-- <a class="btn btn-xs btn-danger" href="<?php echo base_url("index.php/welcome/delete_kriteria/".$row['id_kriteria']);?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a> -->
        </td> </tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>
<?php
require_once('footer.php');
?>
</body>
</html>