<html>
<head>
<title>Stiki SAW.id</title>    
<?php
require_once('header.php');
?>
</head>
<body>
<?php
require_once('body.php');
?>
<div class="container">
	<center>
	<h1> Sistem Informasi Penilaian Pegawai Terbaik di Instansi </h1>
	</center>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="index.php" class="search-form" method="post">
                <div class="form-group has-feedback">
            		<label for="search" class="sr-only">Search</label>
            		<input type="text" class="form-control" name="search" id="search" placeholder="search">
              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
            	</div>
                <!-- //kode disini// -->
            </form>
        </div>
    </div>
</div>
<?php
require_once('footer.php');
?>
</body>
</html>
