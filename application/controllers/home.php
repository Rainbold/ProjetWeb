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
		$data['index'] = 'Home/index';
		$this->load->view('template', $data);
	}
}
