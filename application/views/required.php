<?php 
error_reporting(0);
session_start(); /* Starts the session */
if(isset($_SESSION['UserData']['Username'])){
	header("Location: index.php/welcome/index");
	exit;
}
$valid_passwords = array ("admin" => "admin");
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="Restricted Area!"');
  header('HTTP/1.0 401 Unauthorized');
  die ("<script>alert('Fuck OFF')</script>");
}
else{
	header("Location: index");
	$_SESSION['UserData']['Username'] = $user;
}
?>