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
    <label>Nama Kriteria 1 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_kriteria1" value="<?php echo $nama_kriteria[0]['nama_kriteria'];?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut_kriteria1">
        <option></option>
        <option value='benefit' selected>Benefit</option><option value='cost'>Cost</option>    </select>
</div>
<div class="form-group">
    <label>Bobot <span class="text-danger">*</span></label>
    <input class="form-control" type="text" placeholder="30%" name="bobot_kriteria1" value=""/>
    <br><br>
<label>Nama Kriteria 2 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_kriteria2" value="<?php echo $nama_kriteria[1]['nama_kriteria'];?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut_kriteria2">
        <option></option>
        <option value='benefit' selected>Benefit</option><option value='cost'>Cost</option>    </select>
</div>
<div class="form-group">
    <label>Bobot <span class="text-danger">*</span></label>
    <input class="form-control" type="text" placeholder="30%" name="bobot_kriteria2" value=""/>
    <br><br>
<label>Nama Kriteria 3 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_kriteria3" value="<?php echo $nama_kriteria[2]['nama_kriteria'];?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut_kriteria3">
        <option></option>
        <option value='benefit' selected>Benefit</option><option value='cost'>Cost</option>    </select>
</div>
<div class="form-group">
    <label>Bobot <span class="text-danger">*</span></label>
    <input class="form-control" type="text" placeholder="30%" name="bobot_kriteria3" value=""/>
    <br><br>
<label>Nama Kriteria 4 <span class="text-danger">*</span></label>

    <input class="form-control" type="text" name="nama_kriteria4" value="<?php echo $nama_kriteria[3]['nama_kriteria'];?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut_kriteria4">
        <option></option>
        <option value='benefit' selected>Benefit</option><option value='cost'>Cost</option>    </select>
</div>
<div class="form-group">
    <label>Bobot <span class="text-danger">*</span></label>
    <input class="form-control" type="text" placeholder="30%" name="bobot_kriteria4" value=""/>
    <br><br>
<label>Nama Kriteria 5 <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama_kriteria5" value="<?php echo $nama_kriteria[4]['nama_kriteria'];?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut_kriteria5">
        <option></option>
        <option value='benefit' selected>Benefit</option><option value='cost'>Cost</option>    </select>
</div>
<div class="form-group">
    <label>Bobot <span class="text-danger">*</span></label>
    <input class="form-control" type="text" placeholder="30%" name="bobot_kriteria5" value=""/>
    <br><br>
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

</div>
</div>
</div>
</div>
</div>

</div>
</form>
<?php 
echo $update;
echo $total;
?>
</div>
</div>    
    </div>
    <?php
require_once('footer.php');
?>
</body>
</html>