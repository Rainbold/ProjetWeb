<?php
	$this->load->helper(array('url', 'assets'));
	$this->load->view('header');
	foreach($views as $page)
		$this->load->view($page);
	$this->load->view('footer');
?>