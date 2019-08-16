<!DOCTYPE html>
<html>
<head>
	<title>Tambah Nilai</title>
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
    <h1>Tambah Nilai</h1>
</div>
<div class="row">
<div class="col-sm-6">
<form method="post" action="<?php echo base_url('index.php/welcome/tambah_nilai');?>">
<div class="form-group">
    <label>ID Karyawan <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_karyawan" value=""/>
    
</div>
<div class="form-group">


    <label>C1 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_kriteria[0]" value=""/>
</div>
<div class="form-group">
    <label>C2 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_kriteria[1]" value=""/>
</div>
<div class="form-group">
    <label>C3 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_kriteria[2]" value=""/>
</div>
<div class="form-group">
    <label>C4 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_kriteria[3]" value=""/>
</div>
<div class="form-group">
    <label>C5 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_kriteria[4]" value=""/>
</div>
<div class="form-group">
    <label>C6 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="id_kriteria[5]" value=""/>
</div>
<button class="btn btn-primary" name="simpan"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" onclick="goBack()" =""><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
<?php echo $insert;
var_dump($_POST);
?>
</div>
</div>    
</div>
<?php
require_once('footer.php');
?>
</body>
</html>
