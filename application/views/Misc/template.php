<?php
	
	$this->load->helper(array('url', 'assets'));
	$this->load->view('Misc/header');
	foreach($views as $page)
		$this->load->view($page[0], $page[1]);
	$this->load->view('Misc/footer');
?>