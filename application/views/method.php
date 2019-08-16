<!DOCTYPE html>
<html lang="en">
  <title>NORMALISASI</title>
<?php
/*

if(!isset($this->session->username)){
  header("Location: login");
  exit;
}

*/
require_once('header.php');
?>
<body>
  <?php
require_once('body.php');
?>
<div class="container">
<div class="page-header">

<center><h1 class="entry-title">METODOLOGI</h1></center>      
</div>
<div class="entry-body">

<h3>Metode Simple Additive Weighting</h3>
<p>Fishburn (1967) dan MacCrimmon (1968). Metode Simple Additive Weighting (SAW) sering juga dikenal istilah metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada
semua atribut.</p>

<p>Metode SAW membutuhkan proses normalisasi matriks keputusan (X) ke suatu skala yang dapat diperbandingkan dengan semua rating alternatif yang ada.</p>

<p>Menurut Fachmi Basyaib (2006) Metode Simple Additive Weighting (SAW) merupakan metode paling dikenal dan paling banyak digunakan orang dalam menghadapi situasi Multi Attribute Decision Making (MADM). metode ini mengharuskan pembuat keputusan menentukan bobot bagi setiap attribut. skor total untuk sebuah alternatif diperoleh dengan menjumlahkan seluruh hasil perkalian antar rating (yang dapat dibandingkan lintas attribut) dan bobot tiap attribut. rating tiap atribut haruslah  bebas dimensi dalam arti telah melewati proses normalisasi sebelumnya.</p>

<p>Metode SAW sering juga dikenal istilah metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua atribut. Metode SAW membutuhkan proses normalisasi matriks keputusan (X) ke suatu skala yang dapat diperbandingkan dengan semua rating alternatif yang ada.</p>
<br>
<br>
<br>

</div>
<div class="panel panel-default">
<div class="panel-heading">
<form class="form inline">
      <input type="hidden" name="m" value="kriteria"/>
        </form>
    </div>
    
      <center>
<table class="table table-bordered table-striped table-hover">
 <thead align="center">
    <tr>
  <!-- <th>No</th>
   -->  <th>Nama Kriteria</th>
    <!-- <th>Reference URL</th>
     --><th>Jenis</th>
    <th>Bobot</th>

  </tr>
  </thead>

<tbody>
<?php
foreach ($criteria as $crit) {
  $id = $crit['id_kriteria'];
?>
      <!-- <td>C<?php //echo $crit['id_kriteria'];?></td>
       --><td><?php echo $crit['nama_kriteria'];?></td>
      <!-- <td><a href><?php //echo $row['reference_link'];?> </a></td> -->
      <td><?php echo $crit['jenis'];?></td>
      <td><?php echo $crit['bobot']*100;?>%</td>
     </tr>
<?php
}
?>
</tbody>  
</table>
    <center><h2>NORMALISASI</h2><center><br>
      <center>
<table class="table table-bordered table-striped table-hover">
<tr>
<th rowspan="2"><center>Nama Kampus</center></th>
<center><th colspan="<?php echo $jumlah_kriteria;?>"><center>Kriteria</center></th></center>
<tr>
    <?php
    $hasil_ranks=array(); 
    $hasil_normalisasi = 0;
    foreach ($pembobotan as $data_bobot) {
  ?>
      <th><?php echo $data_bobot['nama_kriteria']; ?></th>

  <?php } ?>
  </tr>
    <?php
    foreach ($kampus as $data_kampus) {
    ?>
      <tr>
        <td><center><?php echo $data_kampus['nama_kampus']; ?></center></td>
        <?php
        $nilai = $model->getValuesById($data_kampus['id_kampus']);
        foreach ($nilai as $data_nilai) {
          $kriteria = $model->getKriteriaId($data_nilai['id_kriteria']);
          foreach ($kriteria as $data_kriteria) {
            if ($data_kriteria['jenis']=="cost") {
              $min = $model->MinValueById($data_nilai['id_kriteria']);
              foreach ($min as $data_min) {
                ?>
                <td>
                  <center>
                    <?php
                     echo number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                        $hasil_kali = $hasil*$data_kriteria['bobot'];
                        $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                     ?>
                   </center>
                </td>
              <?php } ?>

            <?php }elseif ($data_kriteria['jenis']=="benefit") {
              $max = $model->MaxValueById($data_nilai['id_kriteria']);
              foreach ($max as $data_max){
                ?>
                <td>
                  <center>
                    <?php
                    echo $hasil = $data_nilai['nilai']/$data_max['max'];
                      $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                    ?>
                  </center>
                </td>
              <?php } ?>
            <?php }
          ?>

          <?php } } ?>

      </tr>
    <?php } ?>
</table>
<h2><center>PEMBOBOTAN</center></h2>
<table class="table table-bordered table-striped table-hover">

  <tr>
    <th rowspan="2"><center>Nama Kampus</center></th>
    <th colspan="<?php echo $jumlah_kriteria; ?>"><center>Kriteria</center></th>
    <th rowspan="2"><center>Hasil</center></th>
  </tr>

  </tr>

  <tr>
  <?php
  foreach ($pembobotan as $data_bobot) {
  ?>
      <th><?php echo $data_bobot['nama_kriteria']; ?></th>

  <?php } ?>
  </tr>
  <?php
  $hasil_ranks=array();
  foreach($kampus as $data_kampus){
    ?>
    <tr>
      <td><center><?php echo $data_kampus['nama_kampus']; ?></center></td>
      <?php
      $hasil_normalisasi=0;
      $nilai = $model->getValuesById($data_kampus['id_kampus']);
        foreach ($nilai as $data_nilai) {
        $kriteria = $model->getKriteriaId($data_nilai['id_kriteria']);
       foreach ($kriteria as $data_kriteria) {
          if ($data_kriteria['jenis']=="cost") {
            $min = $model->MinValueById($data_nilai['id_kriteria']);
            foreach ($min as $data_min) { ?>
              <td>
                <center>
                  <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      echo  $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                   ?>
                 </center>
              </td>
            <?php } ?>

          <?php }elseif ($data_kriteria['jenis']=="benefit") {
            $max = $model->MaxValueById($data_nilai['id_kriteria']);
            foreach ($max as $data_max) {
            ?>
              <td>
                <center>
                  <?php
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                    echo $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                  ?>
                </center>
              </td>
            <?php } ?>
          <?php }
        ?>
        <?php } } ?>
      <td><center>
        <?php

        $hasil_rank['nilai'] = $hasil_normalisasi;
        $hasil_rank['kampus'] = $data_kampus['nama_kampus'];
        array_push($hasil_ranks,$hasil_rank);
        echo $hasil_normalisasi; ?>
      </<center>
      </td>
    </tr>
  <?php } ?>
</table>
<h2>PERANGKINGAN</h2>
<table class="table table-bordered table-striped table-hover">
  <tr>
    <th><center>  Ranking</center></th>
    <th><center>Nama kampus</center></th>
    <th><center>Nilai Akhir</center></th>
  </tr>

  <?php
   $no=1;
   rsort($hasil_ranks);
   foreach ($hasil_ranks as $rank) { ?>
  <tr>
    <td><center><?php echo $no++ ?></center></td>
    <td><center><?php echo $rank['kampus']; ?></center></td>
    <td><center><?php echo $rank['nilai']; ?></center></td>
  </tr>
  <?php } ?>
</table>

</center>
</center>
</td>
</tr>
</table>
</tr>
</table>
</center>
</center>
</div>
</div>
<?php
require_once('footer.php');
?>
</body>
</html>