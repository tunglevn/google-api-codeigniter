<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');
class Google_library {
	var $client;
	var $key = 'AIzaSyBexcOxsuwGN0khpfEK2SVO9Nue6DB1uLs';
	
	function __construct()
	{
		require_once(APPPATH . 'libraries/google/api/autoload.php');
		$this->client = new Google_Client();
		$this->client->setApplicationName("Client_Library_Examples");
		$this->client->setDeveloperKey($this->key);
	}
	
	function __get($key) {
		$CI = &get_instance();
		$name = $key.'_google';
		$obj = 'google_'.$key;
		$CI->load->library('google/'.$name,NULL,$obj);
		return $CI->$obj;
	}
}