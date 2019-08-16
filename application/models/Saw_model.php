<?php
class Saw_model extends CI_Model
{
 
 public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getKriteria(){
     $sql = $this->db->query("SELECT id_kriteria,nama_kriteria,jenis,bobot,reference_link FROM kriteria ORDER BY id_kriteria");
	   return $sql->result_array();
  }

  public function jumlah_bobot(){
      $sql = $this->db->query("SELECT sum(bobot) AS totalbobot FROM kriteria");
      return $sql->result_array();
  }

  public function getNilaiPage($mulai,$halaman){
    $sql = $this->db->query("SELECT * FROM transaction LIMIT $mulai,$halaman");
    return $sql->result_array();
  }

  public function getKampusPage($mulai,$halaman){
    $sql = $this->db->query("SELECT * FROM kampus LIMIT $mulai,$halaman");
    return $sql->result_array();
  }

  public function getSingleKampus($query){
   $sql = $this->db->query("SELECT * FROM kampus WHERE nama_kampus like '%$query%'");
    return $sql->result_array(); 
  }

  public function getKampusById($id){
   $sql = $this->db->query("SELECT * FROM kampus where id_kampus=$id");
    return $sql->result_array(); 
  }


  public function limitUpdate($limit = 3){
    $sql = $this->db->query("SELECT id_kampus,nama_kampus,link FROM kampus ORDER BY id_kampus LIMIT 0,$limit");
    return $sql->result_array();
  }

  public function getKampus(){
    $sql = $this->db->query("SELECT id_kampus,nama_kampus,link FROM kampus ORDER BY id_kampus");
    return $sql->result_array();
  }

  public function jumlah_data_kampus(){
  	$sql = $this->db->query("SELECT * FROM kampus ORDER BY id_kampus");
    return $sql->num_rows();
  }

  public function jumlah_data_kriteria(){
  	$sql = $this->db->query("SELECT * FROM kriteria ORDER BY id_kriteria");
  	return $sql->num_rows();
  }

  public function getKriteriaId($id){
    $sql = $this->db->query("SELECT * FROM kriteria WHERE id_kriteria='$id' ORDER BY id_kriteria");
		return $sql->result_array();
  }

  public function getValuesById($id){
    $sql = $this->db->query("SELECT * FROM transaction WHERE id_kampus='$id' ORDER BY id_kriteria");
    return $sql->result_array();
  }

//tambahkan ditable transaction nama_kampus !!
  public function getNilaiByNamaKampus($nama_kampus){
   $sql = $this->db->query("SELECT * FROM transaction WHERE nama_kampus='$nama_kampus' ORDER BY id_kriteria");
    return $sql->result_array(); 
  }

  public function MaxValueById($id){
    $sql = $this->db->query("SELECT id_kriteria, MAX(nilai) AS max FROM transaction WHERE id_kriteria='$id' GROUP BY id_kriteria");
    return $sql->result_array();
  }

  public function MinValueById($id){
    $sql = $this->db->query("SELECT id_kriteria, MIN(nilai) AS min FROM transaction WHERE id_kriteria='$id' GROUP BY id_kriteria");
    return $sql->result_array();
  }

}