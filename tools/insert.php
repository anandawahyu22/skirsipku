<?php
function random(){
return rand(40,100);
}
//$db = new data_gua();
$nilai = [];
for($i=1; $i<=10; $i++){
for ($j=1; $j<=6; $j++){
$nilai['id_nilai'] =$i;
$nilai['id_kampus'] = $i;
$nilai['nilai'] = random();
$nilai['id_kriteria'] =$j ;
print_r($nilai);
//$db->insert_me($nilai['id_kriteria'],$nilai['id_kampus'],$nilai['nilai']);
}
}
class data_gua{
private $servername = 'localhost';
	private $username = 'lastc0de';
	private $password = 'lastc0de';
	private $dbname = 'spk_saw';
	private $conn;
	function __construct() {
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$this->conn = $conn;
	}
	public function insert_me($idkrit,$idkar,$nilai){
	$query = "INSERT INTO transaction (id_kriteria,id_kampus,nilai) VALUES ('$idkrit','$idkar','$nilai')";
	if(mysqli_query($this->conn,$query)){
	echo "[+] => success inserted\n";
		}
	}
}
