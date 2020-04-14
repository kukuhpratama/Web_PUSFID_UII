<?php

class Welcome extends CI_Controller 
{
	
	function __construct() 
	{
		parent::__construct();
	}


	function index()
	{

		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');
		
	}

}
