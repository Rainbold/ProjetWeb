<?php
	$this->load->helper(array('url', 'assets'));
	$this->load->view('header');
	echo $this->input->post('pseudo').' ';
	echo $this->input->post('password').' ';
	echo $this->input->post('email');
	foreach($views as $page)
		$this->load->view($page);
	print_r($views);
	$this->load->view('footer');
?>