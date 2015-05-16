<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Youtube extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('google_library',NULL,'google');
		
	}

	public function index()
	{
		set_output('html', 'Youtube Api From Google');
	}
	
	public function search()
	{
		
		$request = array(
			'q'				=> $this->input->get('q'),
			'maxResults'	=> $this->input->get('limit')	
		);
		
		$data = $this->google->youtube->search($request);
		
		set_output('json', json_encode($data));
		
	}
	
	
	public function video()
	{
		$id = $this->input->get('id');
		
		$data = $this->google->youtube->video($id);
	
		set_output('json', json_encode($data));
	
	}
	
	
}