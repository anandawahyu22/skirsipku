<?php

class Http_model extends CI_Model{

	public $url;
	public function create($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://supardi.net/supardi.net/evoo/lil.php?url=".$url."&apikey=c7d868d08c3b7987cb0271181ef64b99");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true );
	curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    return curl_error($ch);
	}
	else
	{
	curl_close ($ch);
	return $this->getJson($result);	
		}
	}
public function getJson($json){
	error_reporting(0);
	$tmp = json_decode($json,true);
	
	/*if (gettype($tmp['semrush rank']['rank']) == 'array') {
		$tmp['semrush rank']['rank'][0] = 45000000;
	}		
	*/
	if($tmp['semrush rank']['rank'][0] == NULL){
		$tmp['semrush rank']['rank'][0] = 45000000;
	}
	if($tmp['web age']['tahun'] == NULL){
		$tmp['web age']['tahun'] = 2018;
	}
	if (!is_numeric($tmp['alexa']['indonesia rank'])) {
		$tmp['alexa']['indonesia rank'] = 25000000;
	}
	$db = [];
	if(floatval($tmp['google index'])){
		$ye = explode('.', $tmp['google index']);
		$gabung = implode($ye);
		$tmp['google index'] = $gabung;
	}
	$db['alexa'] = $tmp['alexa']['indonesia rank'];
	$db['google'] = $tmp['google index'];
	$db['semrush rank'] = $tmp['semrush rank']['rank'][0];
	$db['webage'] = $tmp['web age']['tahun'];
	$db['backlink'] = $tmp['backlink']['links'];

	return $db;
	}

}
