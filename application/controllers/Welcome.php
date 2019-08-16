<?php
class Welcome extends CI_Controller {

	public $model = NULL;
	public $crud = NULL;
	public $http = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Saw_model');
		$this->model = $this->Saw_model;
		$this->load->database();
		$this->load->model('Crud_model');
		$this->crud = $this->Crud_model;
		$this->load->model('Http_model');
		$this->http = $this->Http_model;
	}


	public function aksi_kriteria($id){
		if (is_numeric($id) && $id != NULL){
		$update = "";

		$nama_kriteria = $this->crud->getNamaKriteriaById($id);
			if (isset($_POST['nama_kriteria'])){
			$this->crud->nama_kriteria = $this->db->escape_str($_POST['nama_kriteria']);
			$this->crud->jenis = $this->db->escape_str($_POST['atribut_kriteria']);
			$split = explode('%', $this->db->escape_str($_POST['bobot_kriteria']));
			$calculate = $split[0]/100;
			$this->crud->bobot = $calculate;
			$this->crud->id_kriteria = $id;
			$this->crud->update_criteria();
			$update = "<h2>Update Kriteria Success</h2>";
				}
			$this->load->view('aksi_kriteria',array('update'=>$update,'nama_kriteria'=>$nama_kriteria));	
		}
		else
		{
			redirect('http://localhost/saw/index.php/welcome/index');
		}
	}


	public function update_kriteria_v1(){
		error_reporting(0);
		$split = [];
		$calculate = [];
		$update = "";
		$nama_kriteria = $this->model->getKriteria();
	
			if (isset($_POST['nama_kriteria1']) && isset($_POST['nama_kriteria2']) && isset($_POST['nama_kriteria3']) && isset($_POST['nama_kriteria4']) && isset($_POST['nama_kriteria5'])){


			$this->crud->nama_kriteria[1] = $this->db->escape_str($_POST['nama_kriteria1']);
			$this->crud->nama_kriteria[2] = $this->db->escape_str($_POST['nama_kriteria2']);
			$this->crud->nama_kriteria[3] = $this->db->escape_str($_POST['nama_kriteria3']);
			$this->crud->nama_kriteria[4] = $this->db->escape_str($_POST['nama_kriteria4']);
			$this->crud->nama_kriteria[5] = $this->db->escape_str($_POST['nama_kriteria5']);

			$this->crud->atribut_kriteria[1] = $this->db->escape_str($_POST['atribut_kriteria1']);
			$this->crud->atribut_kriteria[2] = $this->db->escape_str($_POST['atribut_kriteria2']);
			$this->crud->atribut_kriteria[3] = $this->db->escape_str($_POST['atribut_kriteria3']);
			$this->crud->atribut_kriteria[4] = $this->db->escape_str($_POST['atribut_kriteria4']);
			$this->crud->atribut_kriteria[5] = $this->db->escape_str($_POST['atribut_kriteria5']);
			
			$split[0] = explode('%', $this->db->escape_str($_POST['bobot_kriteria1']));
			$split[1] = explode('%', $this->db->escape_str($_POST['bobot_kriteria2']));
			$split[2] = explode('%', $this->db->escape_str($_POST['bobot_kriteria3']));
			$split[3] = explode('%', $this->db->escape_str($_POST['bobot_kriteria4']));
			$split[4] = explode('%', $this->db->escape_str($_POST['bobot_kriteria5']));

			$calculate[1] = $split[0][0]/100;
			$calculate[2] = $split[1][0]/100;
			$calculate[3] = $split[2][0]/100;
			$calculate[4] = $split[3][0]/100;
			$calculate[5] = $split[4][0]/100;

			$hitung_total_input = $calculate[1]+$calculate[2]+$calculate[3]+$calculate[4]+$calculate[5];


			$total_bobot = $this->model->jumlah_bobot();

			if($hitung_total_input > doubleval(1)){
			$update = "<h2>melebihi</h2>";
			}	else {
			
			$update = "<center><h2>Update Kriteria Success</h2></center>";
			
			for ($i=1; $i <=5 ; $i++) { 
			$this->crud->update_criteria_at_once($this->crud->nama_kriteria[$i],$this->crud->atribut_kriteria[$i],$calculate[$i],$i);
			}
				
			
				}
			}
			$this->load->view('aksi_kriteria_at_once',array('update'=>$update,'nama_kriteria'=>$nama_kriteria,'total'=>$hitung_total_input));	
	
	}

	public function aksi_nilaibobotalt($id){
		if (is_numeric($id) && $id != NULL){
		$this->load->view('aksi_nilaibobotalt');
		}
		else{
		header("Location:".base_url('index.php/welcome/index'));		
		}
	}

	public function update_alternatif($id){
		$panggil = $this->model->getKampusById($id);
		$id_kriteria = $this->model->getKriteria();
		$update_status="Update Data Nilai Sukses";
			
		foreach ($panggil as $links) {
			$nilai = [];
				$insert = $this->http->create($links['link']);
					$nilai[0] = $insert['alexa'];
					$nilai[1] = $insert['google'];
					$nilai[2] = 2019-$insert['webage'];
					$nilai[3] = $insert['backlink'];
					$nilai[4] = $insert['semrush rank'];
				
				for ($j=0; $j <count($id_kriteria); $j++) { 
				$this->crud->update_data_nilai($nilai[$j],$links['id_kampus'],$id_kriteria[$j]['id_kriteria']);
				}
		}
				header("Location: /gendut/saw/index.php/welcome/lihat_kampus/$id?update=sukses");
			
	
	}


	public function update_nama_alternatif($id){
		if (is_numeric($id) && $id != NULL){
		$update = "";
		$nama_kampus = $this->crud->getKampusById($id);
		if (isset($_POST['nama_kampus'])){
			$this->crud->nama_kampus = $this->db->escape_str($_POST['nama_kampus']);
			$this->crud->id_kampus = $id;
			$this->crud->update_nama_kampus();
			$update = "<h2>Update Nama Kampus Success</h2>";
		}
		$this->load->view('edit_alternatif',array(	'update'=>$update,
													'nama_kampus'=>$nama_kampus,
													));	
		}
		else{
			redirect('http://localhost/saw/index.php/welcome/index');
		}
	}


	public function lihat_kampus($id){
		error_reporting(0);
		$kampus = $this->model->getKampusById($id);
		$update_button = 'index.php/welcome/update_alternatif/'.$id;
		$update_status = "";
		$update_nama = 'index.php/welcome/update_nama_alternatif/'.$id;
		
		if ($_GET['update'] == "sukses") {
		$update_status = "update nilai sukses";
		}
		
		$kriteria = $this->model->getKriteria();
		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		
		$this->load->view('lihat_kampus',array('kriteria'=>$kriteria,
													'model'=>$this->model,
													'kampus'=>$kampus,
													'jumlah_kriteria'=>$get_rows_kriteria,
													'nama_kriteria'=>$this->crud->getNamaKriteria(),
													'nama_kampus'=>$this->crud->getNamaKampus(),
													'update_url'=>$update_button,
													'update_nama'=>$update_nama,
													'update_nilai'=>$update_status,
												));

		
	}


	public function nilai_bobot(){
		$kriteria = $this->model->getKriteria();
		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		if (isset($_GET['q'])) {
		$hasil = $this->model->getSingleKampus($this->db->escape_str($_GET['q']));
		
		$this->load->view('kriteria_kampus',array('kriteria'=>$kriteria,
													'model'=>$this->model,
													'kampus'=>$hasil,
													'jumlah_kriteria'=>$get_rows_kriteria,
													'nama_kriteria'=>$this->crud->getNamaKriteria(),
													'nama_kampus'=>$this->crud->getNamaKampus(),
							
												));

		}else{



		$kriteria = $this->model->getKriteria();

		$halaman = 10; 
		$page = isset($_GET['halaman']) ? (int)$_GET["halaman"]:1;
		$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
		$jumlah_data = $this->model->jumlah_data_kampus();
		$pages = ceil($jumlah_data/$halaman);   
		$panggil = $this->model->getKampusPage($mulai,$halaman);
		$no = $mulai+1;

		$kampus = $this->model->getKampus();
		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		$this->load->view('kriteria_kampus',array('kriteria'=>$kriteria,
													'model'=>$this->model,
													'kampus'=>$panggil,
													'jumlah_kriteria'=>$get_rows_kriteria,
													'nama_kriteria'=>$this->crud->getNamaKriteria(),
													'nama_kampus'=>$this->crud->getNamaKampus(),
													'no' => $no,
													'halaman'=>$page,
													'pages' => $pages
												));
		}
	}

	public function tambah_alt(){
		error_reporting(0);
		if(isset($_POST['situs_kampus']) && isset($_POST['nama_kampus'])){
		$this->crud->nama_kampus = $this->db->escape_str($_POST['nama_kampus']);
		$this->crud->link = $_POST['situs_kampus'];
		$this->crud->create_alternatif();
		$id_kampus = $this->crud->getIDKampus($_POST['nama_kampus']);
		$insert = $this->http->create($_POST['situs_kampus']);

		$id_kriteria = [];
		$id_kriteria[] = $this->crud->getIDKriteria('alexa');
		$id_kriteria[] = $this->crud->getIDKriteria('google_index');
		$id_kriteria[] = $this->crud->getIDKriteria('webage');
		$id_kriteria[] = $this->crud->getIDKriteria('backlink');
		$id_kriteria[] = $this->crud->getIDKriteria('semrush');
	
		$nilai = [];
		$nilai[1] = $insert['alexa'];
		$nilai[2] = $insert['google'];
		$nilai[3] = 2019-$insert['webage'];
		$nilai[4] = $insert['backlink'];
		$nilai[5] = $insert['semrush rank'];
		$id_nya=$id_kampus[0]['id_kampus'];
			for ($i=1; $i <= 5; $i++) { 

				$this->crud->tambah_data_nilai($i,$id_nya,$nilai[$i],$_POST['nama_kampus']);
				}				
		
		$output = "<h2>Data Berhasil Ditambahkan</h2>";

		$this->load->view('tambah_alt',array('insert'=>$output));
	}
	else{
		$insert = "";
		$this->load->view('tambah_alt',array('insert'=>$insert));
		  	}

}


	public function delete_kriteria($id){
		if (is_numeric($id) && $id != NULL){
			$this->crud->id_kriteria = $id;
			$this->crud->delete_criteria();
			redirect('http://localhost/saw/index.php/welcome/criteria');
		}else{
			$this->load->view('list_crit');
		}
	}

	public function delete_alternatif($id){
		if (is_numeric($id) && $id != NULL){
			$this->crud->id_alternatif = $id;
			$this->crud->delete_transaction();
			$this->crud->delete_alternatif();
			header('Location: /gendut/saw/index.php/welcome/alternatif');
		}else{
			$this->load->view('list_alt');
		}	
	}

	public function index(){
		$this->load->view('about');
	}


	public function criteria()
	{
		$rows = $this->model->getKriteria();
		$this->load->view('list_crit',array('rows'=>$rows));

	}

	public function alternatif(){
		if(isset($_GET['q'])){
			$hasil_pencarian =  $this->model->getSingleKampus($this->db->escape_str($_GET['q']));
			$this->load->view('list_alt',array('rows'=>$hasil_pencarian));
		}else{
		$rows = $this->model->getKampus();
		$halaman = 15; 
		$page = isset($_GET['halaman']) ? (int)$_GET["halaman"]:1;
		$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
		$jumlah_data = $this->model->jumlah_data_kampus();
		$pages = ceil($jumlah_data/$halaman);   
		$panggil = $this->model->getKampusPage($mulai,$halaman);
		$no = $mulai+1;


		$this->load->view('list_alt',array('rows'=>$panggil,'no'=>$no,'pages'=>$pages));
											//'paging'=>$paging));
		}
	}


	public function saw_method(){

	
	}
	

	public function metodologi(){
		//$this->load->view('metodologi');

	
		$tablekriteria = $this->model->getKriteria();
		//$calculatepersentase= *100;


		$halaman = 300; 


		$page = isset($_GET['halaman']) ? (int)$_GET["halaman"]:1;
		$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
		$jumlah_data = $this->model->jumlah_data_kampus();
		$pages = ceil($jumlah_data/$halaman);   
		$panggil = $this->model->getKampusPage($mulai,$halaman);
		$no = $mulai+1;

		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		$get_rows_kampus = $this->model->jumlah_data_kampus();
		$get_pembobotan = $this->model->getKriteria();
		$pembobotan = $this->model->getKriteria();
		$kampus = $this->model->getKampus();
		$this->load->view('method',array('jumlah_kampus'=>$get_rows_kampus,
											'criteria'=>$tablekriteria,
											  'jumlah_kriteria'=>$get_rows_kriteria,
											  'pembobotan'=>$pembobotan,
											  'kampus'=> $panggil,
											  'model'=>$this->model,
											  'no'=>$no,
											  'pages'=>$pages,
											  'kampus'=>$panggil
											)
		);
	}


	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		header("Location: index");

	}
	public function about(){
		$this->load->view('about');
	}

	public function login(){
		$this->load->view('login');
	}

	public function ranking(){

		$halaman = 300; 
		$page = isset($_GET['halaman']) ? (int)$_GET["halaman"]:1;
		$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
		$jumlah_data = $this->model->jumlah_data_kampus();
		$pages = ceil($jumlah_data/$halaman);   
		$panggil = $this->model->getKampusPage($mulai,$halaman);
		$no = $mulai+1;

		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		$get_rows_kampus = $this->model->jumlah_data_kampus();
		$get_pembobotan = $this->model->getKriteria();
		$pembobotan = $this->model->getKriteria();
		$kampus = $this->model->getKampus();
		$this->load->view('normalisasi',array('jumlah_kampus'=>$get_rows_kampus,
											  'jumlah_kriteria'=>$get_rows_kriteria,
											  'pembobotan'=>$pembobotan,
											  'kampus'=> $panggil,
											  'model'=>$this->model,
											  'no'=>$no,
											  'pages'=>$pages,
											  'kampus'=>$panggil
											)
		);
	}
}
