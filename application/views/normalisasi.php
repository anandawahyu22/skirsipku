<!DOCTYPE html>
<html lang="en">
  <title>Ranking</title>
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
</div>
<div class="panel panel-default">
<div class="panel-heading">
<form class="form inline">
      <input type="hidden" name="m" value="kriteria"/>
      <div class="form-group">
       <!--          <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="" />
        -->     </div>
        </form>
    </div>
    <!-- <center><h2>NORMALISASI</h2><center><br>
<table class="table table-bordered table-striped table-hover">
<tr>
<th rowspan="2"><center>Nama Kampus</center></th>
<center><th colspan="<?php //echo $jumlah_kriteria;?>"><center>Kriteria</center></th></center>
<tr>
 -->    <?php
    $hasil_ranks=array(); 
    $hasil_normalisasi = 0;
    foreach ($pembobotan as $data_bobot) {
  ?>
      <!-- <th><?php //echo $data_bobot['nama_kriteria']; ?></th>
 -->
  <?php } ?>
  <!-- </tr>
   -->  <?php
    foreach ($kampus as $data_kampus) {
    ?>
  <!--     <tr>
        <td><center><?php //echo $data_kampus['nama_kampus']; ?></center></td>
   -->      <?php
        $nilai = $model->getValuesById($data_kampus['id_kampus']);
        foreach ($nilai as $data_nilai) {
          $kriteria = $model->getKriteriaId($data_nilai['id_kriteria']);
          foreach ($kriteria as $data_kriteria) {
            if ($data_kriteria['jenis']=="cost") {
              $min = $model->MinValueById($data_nilai['id_kriteria']);
              foreach ($min as $data_min) {
                ?>
                <!-- <td>
                  <center>
                 -->    <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                        $hasil_kali = $hasil*$data_kriteria['bobot'];
                        $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                     ?>
                <!--    </center>
                </td> -->
              <?php } ?>

            <?php }elseif ($data_kriteria['jenis']=="benefit") {
              $max = $model->MaxValueById($data_nilai['id_kriteria']);
              foreach ($max as $data_max){
                ?>
                <!-- <td>
                  <center>
                 -->    <?php
                     $hasil = $data_nilai['nilai']/$data_max['max'];
                      $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                    ?>
                  <!-- </center>
                </td> -->
              <?php } ?>
            <?php }
          ?>

          <?php } } ?>

  <!--     </tr>
   -->  <?php } ?>
<!-- </table>
<h2><center>PEMBOBOTAN</center></h2>
<table class="table table-bordered table-striped table-hover">

  <tr>
    <th rowspan="2"><center>Nama Kampus</center></th>
    <th colspan="<?php //echo $jumlah_kriteria; ?>"><center>Kriteria</center></th>
    <th rowspan="2"><center>Hasil</center></th>
  </tr>

  </tr>

  <tr>
 -->  <?php
  foreach ($pembobotan as $data_bobot) {
  ?><!-- 
      <th><?php //echo $data_bobot['nama_kriteria']; ?></th>
 -->
  <?php } ?>
  <!-- </tr> -->
  <?php
  $hasil_ranks=array();
  foreach($kampus as $data_kampus){
    ?>
    <!-- <tr>
      <td><center><?php //echo $data_kampus['nama_kampus']; ?></center></td>
     -->  <?php
      $hasil_normalisasi=0;
      $nilai = $model->getValuesById($data_kampus['id_kampus']);
        foreach ($nilai as $data_nilai) {
        $kriteria = $model->getKriteriaId($data_nilai['id_kriteria']);
       foreach ($kriteria as $data_kriteria) {
          if ($data_kriteria['jenis']=="cost") {
            $min = $model->MinValueById($data_nilai['id_kriteria']);
            foreach ($min as $data_min) { ?>
              <!-- <td>
                <center>
               -->    <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                       $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                   ?>
                 <!-- </center>
              </td> -->
            <?php } ?>

          <?php }elseif ($data_kriteria['jenis']=="benefit") {
            $max = $model->MaxValueById($data_nilai['id_kriteria']);
            foreach ($max as $data_max) {
            ?>
              <!-- <td>
                <center>
               -->    <?php
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                     $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                  ?>
              <!--   </center>
              </td> -->
            <?php } ?>
          <?php }
        ?>
        <?php } } ?>
      <!-- <td><center>
       -->  <?php
        
        $hasil_rank['nilai'] = $hasil_normalisasi;
        $hasil_rank['situs_kampus'] = $data_kampus['link'];
        $hasil_rank['kampus'] = $data_kampus['nama_kampus'];
        $hasil_rank['id_kampus'] = $data_kampus ['id_kampus'];
        array_push($hasil_ranks,$hasil_rank);
          rsort($hasil_ranks);
         //$hasil_normalisasi; ?>

      <!-- </<center>
      </td>
    </tr> -->
  <?php } ?>
</table>
<center>
<h2>RANK</h2>
</center>
<table class="table table-bordered table-striped table-hover" id="table-wrapper">
  <tr>
    <th><center> Ranking</center></th>
    <th><center>Nama Kampus</center></th>
    <th><center>Situs Kampus</center></th>
    <?php
    foreach ($pembobotan as $data_bobot) {
  ?>
      <th><?php echo $data_bobot['nama_kriteria']; ?></th>

  <?php } ?>
  
    <!-- <th><center>Nilai Akhir</center></th> -->
  </tr>

  <?php
  //print_r($hasil_ranks);
   $no=1;

   foreach ($hasil_ranks as $rank) { ?>
  <tr>
    <td><center><?php echo $no++ ?></center></td>
    <td><center><?php echo $rank['kampus'];?></center></td>
    <td><center><a href><?php echo $rank['situs_kampus']; ?></a></center></td>
    <?php

      $nilai = $model->getValuesById($rank['id_kampus']);
      foreach ($nilai as $data_nilai) {
       ?>
<td>
<center><?php echo $data_nilai['nilai']; ?></center>
</td>

<?php

}
?>
    <!-- <td><center><?php //echo $rank['nilai']; ?></center></td> -->
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