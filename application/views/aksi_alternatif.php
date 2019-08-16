<!DOCTYPE html>
<html>
<head>
	<title>Aksi Alternatif</title>
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
require_once('body.php');
?>
<div class="container"> 
<div class="page-header">
    <h1>Ubah Alternatif</h1>
</div>
<div class="row">
<div class="col-sm-6">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<div class="form-group">
    <label>Nama Alternatif <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_karyawan" value=""/>
</div>
<div class="form-group">
    <label>Keterangan</label>
    <textarea class="form-control" name="keterangan"></textarea>
</div>
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
</div>
</div>    
</div>
<?php
require_once('footer.php');
?>
</body>
</html>
