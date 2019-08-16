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



	public function graph(){
	
		$this->load->view('graph.php');
	
	}


	public function chart_json(){
		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		$get_rows_kampus = $this->model->jumlah_data_kampus();
		$get_pembobotan = $this->model->getKriteria();
		$kriteria = $this->model->getKriteria();
		$pembobotan = $this->model->getKriteria();
		$kampus = $this->model->getKampus();
		$this->load->view('json_rank',array('jumlah_kampus'=>$get_rows_kampus,
											  'jumlah_kriteria'=>$get_rows_kriteria,
											  'pembobotan'=>$pembobotan,
											  'kriteria'=>$kriteria,
											  'model'=>$this->model,
											  'kampus'=>$kampus)
		);
	}

	public function view($id){
	
	//tampilkan data json api  dalam bentuk table di view

	/*	if (is_numeric($id) && $id != NULL){
		$this->load->view('aksi_alternatif');
		}
		else{
		header("Location:".base_url('index.php/welcome/index'));		
		}*/
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
		else{
			redirect('http://localhost/saw/index.php/welcome/index');
		}
	}

	public function aksi_nilaibobotalt($id){
		if (is_numeric($id) && $id != NULL){
		$this->load->view('aksi_nilaibobotalt');
		}
		else{
		header("Location:".base_url('index.php/welcome/index'));		
		}
	}

/*	public function updatedataperpage($id){

		$halaman = 1; 
		$page = isset($_GET['halaman']) ? (int)$_GET["halaman"]:1;
		$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
		$jumlah_data = $this->model->jumlah_data_kampus();
		$pages = ceil($jumlah_data/$halaman);   
		$panggil = $this->model->getKampusPage($mulai,$halaman);
		$no = $mulai+1;

		$panggil = $this->model->getKampusPage($mulai,$halaman);
		$id_kampus = $this->crud->getLinkKampus($mulai,$halaman);
		$id_kriteria = $this->model->getKriteria();
			//$ngampus = $this->model->getKampus();
			
		foreach ($panggil as $upin) {
			$nilai = [];
				$insert = $this->http->create($upin['link']);
					$nilai[0] = $insert['alexa'];
					$nilai[1] = $insert['google'];
					$nilai[2] = 2019-$insert['webage'];
					$nilai[3] = $insert['backlink'];
					$nilai[4] = $insert['semrush rank'];
				
				for ($j=0; $j <count($id_kriteria); $j++) { 
					//$this->crud->update_data_nilai($nilai[$j],$ngampus[$i]['id_kampus'],$id_kriteria[$j]['id_kriteria']);
				$this->crud->update_data_nilai($nilai[$j],$bangsat['id_kampus'],$id_kriteria[$j]['id_kriteria']);
				}
		}
				header("Location: /gendut/saw/index.php/welcome/nilai_bobot?halaman=$page");
	}

*/
	public function update_alternatif($id){
		$panggil = $this->model->getKampusById($id);
		$id_kriteria = $this->model->getKriteria();
			//$ngampus = $this->model->getKampus();
			
		foreach ($panggil as $bangsat) {
			$nilai = [];
				$insert = $this->http->create($bangsat['link']);
					$nilai[0] = $insert['alexa'];
					$nilai[1] = $insert['google'];
					$nilai[2] = 2019-$insert['webage'];
					$nilai[3] = $insert['backlink'];
					$nilai[4] = $insert['semrush rank'];
				
				for ($j=0; $j <count($id_kriteria); $j++) { 
					//$this->crud->update_data_nilai($nilai[$j],$ngampus[$i]['id_kampus'],$id_kriteria[$j]['id_kriteria']);
				$this->crud->update_data_nilai($nilai[$j],$bangsat['id_kampus'],$id_kriteria[$j]['id_kriteria']);
				}
		}
				header("Location: /gendut/saw/index.php/welcome/lihat_kampus/$id");
	
	}


	public function update_nama_alternatif($id){
		if (is_numeric($id) && $id != NULL){
		$update = "";
		$nama_kampus = $this->crud->getKampusById($id);
		if (isset($_POST['nama_kampus'])){
			$this->crud->nama_kampus = $this->db->escape_str($_POST['nama_kampus']);
			//$this->crud->jenis = $_POST['atribut_kriteria'];
			//$split = explode('%', $_POST['bobot_kriteria']);
			//$calculate = $split[0]/100;
			//$this->crud->bobot = $calculate;
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
		$kampus = $this->model->getKampusById($id);
		$update_button = 'index.php/welcome/update_alternatif/'.$id;
		$update_nama = 'index.php/welcome/update_nama_alternatif/'.$id;
		
		$kriteria = $this->model->getKriteria();
		$get_rows_kriteria = $this->model->jumlah_data_kriteria();
		//$nilai = $this->model->getValueById($id);
		$this->load->view('lihat_kampus',array('kriteria'=>$kriteria,
													'model'=>$this->model,
													'kampus'=>$kampus,
													'jumlah_kriteria'=>$get_rows_kriteria,
													'nama_kriteria'=>$this->crud->getNamaKriteria(),
													'nama_kampus'=>$this->crud->getNamaKampus(),
													'update_url'=>$update_button,
													'update_nama'=>$update_nama,
													//'no' => $no,
													//'pages' => $pages
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




		/*if($update != NULL){
			$ngampus = $this->model->getKampusPage($mulai,$halaman);
			$id_kampus = $this->crud->getLinkKampus($mulai,$halaman);
			$jumlah = $this->crud->countRowsKampus();
			$id_kriteria = $this->model->getKriteria();
			//$ngampus = $this->model->getKampus();
			
			
			$nilai = [];
			for ($i=0; $i <count($ngampus); $i++) { 
				$insert = $this->http->create($id_kampus[$i]['link']);
					$nilai[0] = $insert['alexa'];
					$nilai[1] = $insert['google'];
					$nilai[2] = 2019-$insert['webage'];
					$nilai[3] = $insert['backlink'];
					$nilai[4] = $insert['semrush rank'];
				
				for ($j=0; $j <count($id_kriteria); $j++) { 
					//$this->crud->update_data_nilai($nilai[$j],$ngampus[$i]['id_kampus'],$id_kriteria[$j]['id_kriteria']);
					$this->crud->update_data_nilai($nilai[$j],$ngampus[$i]['id_kampus'],$id_kriteria[$j]['id_kriteria']);
				}
				
						
			}
				header("Location: /gendut/saw/index.php/welcome/nilai_bobot");
			}*/
		}
	}

	public function tambah_alt(){
		if(isset($_POST['situs_kampus']) && isset($_POST['nama_kampus'])){
		$this->crud->nama_kampus = $_POST['nama_kampus'];
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
		
		//$this->crud->id_kampus = $id_kampus['0']['id_kampus'];
		//$this->crud->id_kriteria = 
		/*
		*/
		/*$this->crud->id_kriteria;
		$this->crud->id_kampus = $id_kampus;
		$this->crud->tambah_data_nilai();
		*/
		$output = "<h2>Data Berhasil Ditambahkan</h2>";

		$this->load->view('tambah_alt',array('insert'=>$output));
	}
	else{
		$insert = "";
		$this->load->view('tambah_alt',array('insert'=>$insert));
		}
	}

	public function tambah_kriteria(){
		if(isset($_POST['nama_kriteria']) && isset($_POST['atribut_kriteria']) && isset($_POST['bobot_kriteria'])){
		$this->crud->nama_kriteria = $_POST['nama_kriteria'];
		$this->crud->jenis = $_POST['atribut_kriteria'];
		$split = explode('%', $_POST['bobot_kriteria']);
		$calculate = $split[0]/100;
		$this->crud->bobot = $calculate;
		$this->crud->create_criteria();
		$insert = "<h2>Menambahkan Data Selesai</h2>";
		$this->load->view('tambah_kriteria',array('insert'=>$insert));
	}
	else{
		$insert = "";
		$this->load->view('tambah_kriteria',array('insert'=>$insert));
		}
	}

	public function tambah_nilai(){
		if(isset($_POST['c1'])){
		$this->crud->create_nilai();
		$insert = "<h2>Menambahkan Data Selesai</h2>";
		$this->load->view('tambah_nilai',array('insert'=>$insert));
	}
	else{
		$insert = "";
		$this->load->view('tambah_nilai',array('insert'=>$insert));
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
		//$this->load->view('index');
		$this->load->view('about');
	}

	/*
	public function req(){
		$this->load->view('required.php');
	}
	*/

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


	public function metodologi(){
		$this->load->view('metodologi');
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

	public function saw_method(){

		$halaman = 5; 


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
