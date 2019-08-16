<?php
header('Content-Type: application/json');
  $hasil_ranks=array();
  foreach ($karyawan as $data_karyawan) {
      // tampilkan nilai dengan id_karyawan ...
      $hasil_normalisasi=0;
      $nilai = $model->getValuesById($data_karyawan['id_karyawan']);
     foreach ($nilai as $data_nilai) {
          $kriteria = $model->getKriteriaId($data_nilai['id_kriteria']);
          foreach ($kriteria as $data_kriteria) {
            if ($data_kriteria['jenis']=="cost") {
              $min = $model->MinValueById($data_nilai['id_kriteria']);
              foreach ($min as $data_min) {
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
        }
      }elseif ($data_kriteria['jenis']=="benefit") {
              $max = $model->MaxValueById($data_nilai['id_kriteria']);
              foreach ($max as $data_max){
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                    $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

              } 
          }
       }
     } 
   } 

  $hasil_ranks=array();
  foreach($karyawan as $data_karyawan){

      $hasil_normalisasi=0;
      $nilai = $model->getValuesById($data_karyawan['id_karyawan']);
        foreach ($nilai as $data_nilai) {
        $kriteria = $model->getKriteriaId($data_nilai['id_kriteria']);
       foreach ($kriteria as $data_kriteria) {
          if ($data_kriteria['jenis']=="cost") {
            $min = $model->MinValueById($data_nilai['id_kriteria']);
            foreach ($min as $data_min) {
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                    } 
                  }elseif ($data_kriteria['jenis']=="benefit") {
            $max = $model->MaxValueById($data_nilai['id_kriteria']);
            foreach ($max as $data_max) {
            		$hasil = $data_nilai['nilai']/$data_max['max'];
                    $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

             } 
          } 
        } 
      } 
        $hasil_rank['nilai'] = $hasil_normalisasi;
        $hasil_rank['karyawan'] = $data_karyawan['nama_karyawan'];
        array_push($hasil_ranks,$hasil_rank);
        $hasil_normalisasi; 
       } 
   //rsort($hasil_ranks);
    $no = 0;
   $data = array();
   foreach ($hasil_ranks as $rank) { 
    $data[$no++] = $rank;
  } 
print json_encode($data);