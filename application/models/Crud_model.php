<?php
class Crud_model extends CI_Model 
{
	public $id_kriteria;
	public $nama_kriteria = [];
	public $bobot_kriteria = [];
	public $atribut_kriteria = [];
	public $jenis;
	public $bobot;

	public $id_alternatif;
	public $nama_kampus;
	public $link;
	public $id_kampus;
	public $labels = [];
	public $nilai;
	public $id_nilai = [];
	public function __construct(){
		$this->load->database();
		$this->labels = $this->__attributes_labels();
	}

	public function __attributes_labels(){
		return [
			'id_kriteria'=>'ID Kriteria :',
			'id_alternatif'=>'ID kampus :',
			'nama_kriteria'=>'NAMA KRITERIA :',
			'nama_kampus'=>'NAMA kampus :',
			'jenis'=>'JENIS :',
			'bobot'=>'BOBOT :',
			'id_nilai'=>'id_nilai :'
		];
	}



	public function getNamaKriteria(){
	$sql = $this->db->query('SELECT nama_kriteria FROM kriteria');
    return $sql->result_array();

	}

	public function countRowsKampus(){
		$sql = $this->db->query('SELECT COUNT(*) FROM kampus');
		return $sql->result_array();
	}

	public function getNamaKampus(){
	$sql = $this->db->query('SELECT nama_kampus FROM kampus');
    return $sql->result_array();
    
	}

	public function getLinkKampus($mulai,$halaman){
	$sql = $this->db->query("SELECT link FROM kampus LIMIT $mulai,$halaman");
    return $sql->result_array();
    
	}

	public function searchKampus($search){
     $sql = sprintf("SELECT * FROM kampus WHERE ( `nama_kampus` LIKE `%%s% )", $search);
     $hasil = $this->db->query($sql);
     return $hasil->result_array(); 
  	
  	}

  	public function searchNilai($search){
     //$sql = sprintf("SELECT  * FROM transaction WHERE nama_kampus LIKE '%s'", $search);
     $hasil = $this->db->query('SELECT * FROM transaction WHERE nama_kampus LIKE '."'%".$search."%'");
     return $hasil->result_array(); 
  	
  	}
  	
	public function update_data_nilai($nilai,$id_kampus,$id_kriteria){
	$query = sprintf("UPDATE transaction SET nilai='%F' WHERE id_kampus='%d' && id_kriteria='%d'",
			$nilai,
			$id_kampus,
			$id_kriteria
		);
		return $this->db->query($query);
	}
	

	public function tambah_data_nilai($id_kriteria,$id_kampus,$nilai,$nama_kampus){
		$query = sprintf("INSERT INTO transaction (id_kriteria,id_kampus,nilai,nama_kampus) VALUES ('%d','%d','%F','%s')",
			$id_kriteria,
			$id_kampus,
			$nilai,
			$nama_kampus
		);
		return $this->db->query($query);
	}

	public function update_nilai(){
		$query = sprintf("UPDATE transaction SET id_kriteria='%f',id_kampus='%f',nilai='%f' WHERE id_nilai='%d'",
		$this->id_kriteria,
		$this->id_alternatif,
		$this->nilai,
		$this->id_nilai
	);
		return $this->db->query($query);
	}

	public function create_criteria(){		
		$query = sprintf("INSERT INTO kriteria (nama_kriteria,jenis,bobot) VALUES ('%s','%s','%s')",
		$this->nama_kriteria,
		$this->jenis,
		$this->bobot
	);
		return $this->db->query($query);
	}

	public function read_criteria(){
		$query = sprintf("SELECT * FROM kriteria ORDER BY id_kriteria='%f'",
		$this->id_kriteria
	);
		$this->db->query($query);
	}

	public function update_criteria(){
		$query = sprintf("UPDATE kriteria SET nama_kriteria='%s',jenis='%s',bobot='%f' WHERE id_kriteria='%f'",
			$this->nama_kriteria,
			$this->jenis,
			$this->bobot,
			$this->id_kriteria
	);
		return $this->db->query($query);
	}

	public function update_criteria_at_once($nama_kriteria,$jenis,$bobot,$id_kriteria){
		$query = sprintf("UPDATE kriteria SET nama_kriteria='%s',jenis='%s',bobot='%f' WHERE id_kriteria='%f'",
			$nama_kriteria,
			$jenis,
			$bobot,
			$id_kriteria
	);
		return $this->db->query($query);
	}

	public function update_alternatif(){
		$query = sprintf("UPDATE kampus SET nama_kampus='%s' WHERE id_kampus='%f'",
			$this->nama_kampus,
			$this->id_kampus
	);
		return $this->db->query($query);
	}

	public function getKampusById($id){
		$sql = $this->db->query('SELECT nama_kampus FROM kampus where id_kampus="'.$id.'"');
    return $sql->result_array();
	}

	public function getNamaKriteriaById($id){
		$sql = $this->db->query('SELECT nama_kriteria FROM kriteria where id_kriteria="'.$id.'"');
    return $sql->result_array();	
	}
	

	public function getIdKampus($nama_kampus){
		$sql = $this->db->query('SELECT id_kampus FROM kampus where nama_kampus="'.$nama_kampus.'"');
    return $sql->result_array();
	}

	public function getIDKriteria($nama_kriteria){
		$sql = $this->db->query('SELECT id_kriteria FROM kriteria where nama_kriteria="'.$nama_kriteria.'"');
    return $sql->result_array();	
	}

	public function delete_criteria(){
		$query = sprintf("DELETE FROM kriteria WHERE id_kriteria='%f'",
		$this->id_kriteria

	);
		return $this->db->query($query);
	}

	public function create_alternatif(){
		$query = sprintf("INSERT INTO kampus (nama_kampus,link) VALUES ('%s','%s')",
		$this->nama_kampus,$this->link
	);
		return $this->db->query($query);
	}

	public function read_alternatif(){
		$query = sprintf("SELECT * FROM kampus ORDER BY id_kampus='%f'",
		$this->id_kampus
	);
		$this->db->query($query);
	}



	public function update_nama_kampus(){
		$query = sprintf("UPDATE kampus SET nama_kampus='%s' WHERE id_kampus='%f'",
			$this->nama_kampus,
			$this->id_kampus
		);		
		return $this->db->query($query);
	}

	public function delete_alternatif(){
		$query = sprintf("DELETE FROM kampus WHERE id_kampus='%d'",
		$this->id_alternatif
	);
		return $this->db->query($query);
	}

	public function delete_transaction(){
		$query = sprintf("DELETE FROM transaction WHERE id_kampus='%d'",
		$this->id_alternatif
	);
		return $this->db->query($query);
	}

}