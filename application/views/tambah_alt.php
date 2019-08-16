<!DOCTYPE html>
<html>
<head>
	<title>Tambah Alternatif</title>
	<?php
	require_once('header.php');
    
	?>
</head>
<body>
    <script>
function goBack() {
  window.history.back();
}
    </script>
<?php
error_reporting(0);
require_once('body.php');
?>
 <div class="container">    
    <div class="page-header">
    <h1>Tambah Alternatif</h1>
</div>
<div class="row">
<div class="col-sm-6">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<div class="form-group">
    <label>Nama Kampus <span class="text-danger">*</span></label>
    <input class="form-control" placeholder="Masukan Nama Kampus" type="text" name="nama_kampus" value=""/>
    <label>Situs Kampus <span class="text-danger">*</span></label>
    <input class="form-control" placeholder="Masukan Nama Domain ex: ub.ac.id" type="text" name="situs_kampus" value=""/>
</div><!-- <div class="form-group">
    <label>Keterangan</label>
    <textarea class="form-control" name="keterangan"></textarea>
</div> -->
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
<?php echo $insert;?>
</div>
</div>    
</div>
<?php
require_once('footer.php');
?>
</body>
</html>
