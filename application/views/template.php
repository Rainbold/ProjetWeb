<?php
	$this->load->helper(array('url', 'assets'));
	$this->load->view('header');
	$this->load->view($index);
	$this->load->view('footer');
?>