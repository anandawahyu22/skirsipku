<!DOCTYPE html>
<html>
<head>
	<title>Aksi Kriteria</title>
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
    <h1>Ubah Kriteria</h1>
</div>
<div class="row">
<div class="col-sm-6">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>"><div class="form-group">
    <label>Nama Kriteria <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_kriteria" value="<?php echo $nama_kriteria[0]['nama_kriteria'];?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut_kriteria">
        <option></option>
        <option value='benefit' selected>Benefit</option><option value='cost'>Cost</option>    </select>
</div>
<div class="form-group">
    <label>Bobot <span class="text-danger">*</span></label>
    <input class="form-control" type="text" placeholder="30%" name="bobot_kriteria" value=""/>
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