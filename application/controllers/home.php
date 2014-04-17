<?php

class Home extends CI_Controller
{
	var $data = array();

	public function Blog()
	{
		parent::Controller();
	}

	public function index()
	{
		$data['views'] = array('Home/index');

    	$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('pseudo', '"Pseudonym"', 'trim|required|min_length[2]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[8]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('password', '"Password"', 'trim|required|min_length[6]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');

		if( $this->form_validation->run() )
		{
			array_unshift($data['views'], 'overlay');
		}
		else
		{
		}

		$this->load->view('template', $data);
	}
}
