<!DOCTYPE html>
<html>
<head>
	<title>Edit Nama Kampus</title>
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
    <h1>Ubah Nama Kampus</h1>
</div>
<div class="row">
<div class="col-sm-6">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>"><div class="form-group">
    <label>Nama Kampus <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_kampus" value="<?php echo $nama_kampus[0]['nama_kampus'];?>"/>
</div>
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
<?php 
echo $update;?>
</div>
</div>    
    </div>
    <?php
require_once('footer.php');
?>
</body>
</html>
}