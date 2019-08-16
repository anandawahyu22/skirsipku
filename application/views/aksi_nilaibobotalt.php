<!DOCTYPE html>
<html>
<head>
	<title>Aksi Nilai Bobot</title>
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
$pecah = explode("/", $_SERVER['REQUEST_URI']);
?>
<div class="container">    
    <div class="page-header">
    <h1>Ubah nilai bobot &raquo; <small>Pendaftar <?php echo $pecah[5];?></small></h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                        <div class="form-group">
                <label>Character</label>    
                <select class="form-control" name="ID-1"><option value='505'>Sangat Buruk</option><option value='506'>Buruk</option><option value='507' selected>Cukup</option><option value='508'>Baik</option><option value='509'>Sangat Baik</option></select>
            </div>
                        <div class="form-group">
                <label>Capacity</label>    
                <select class="form-control" name="ID-4"><option value='533'>Sangat Tidak Mampu</option><option value='534'>Tidak Mampu</option><option value='535'>Cukup</option><option value='536' selected>Mampu</option><option value='537'>Sangat Mampu</option></select>
            </div>
                        <div class="form-group">
                <label>Capital</label>    
                <select class="form-control" name="ID-7"><option value='528'>Sangat Tidak Mampu</option><option value='529'>Tidak mampu</option><option value='530' selected>Cukup</option><option value='531'>Mampu</option><option value='532'>Sangat Mampu</option></select>
            </div>
                        <div class="form-group">
                <label>Collateral</label>    
                <select class="form-control" name="ID-10"><option value='523'>10%</option><option value='524'>>=10%</option><option value='525' selected>>=20%</option><option value='526'>>=30%</option><option value='527'>>=40%</option></select>
            </div>
                        <div class="form-group">
                <label>Condition</label>    
                <select class="form-control" name="ID-13"><option value='518'>Sangat Mundur</option><option value='519' selected>Mundur</option><option value='520'>Statis</option><option value='521'>Maju</option><option value='522'>Sangat Maju</option></select>
            </div>
                        <div class="form-group">
                <label>Cashflow</label>    
                <select class="form-control" name="ID-16"><option value='513'>10 juta</option><option value='514' selected>20 juta</option><option value='515'>30 juta</option><option value='516'>40 juta</option><option value='517'>50 juta</option></select>
            </div>
                        <div class="form-group">
                <label>Culture</label>    
                <select class="form-control" name="ID-19"><option value='510'>Blacklist</option><option value='511' selected>Netral</option><option value='512'>Whitelist</option></select>
            </div>
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>    
    </div><?php
require_once('footer.php');
?>
</body>
</html>
