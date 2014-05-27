<?php
	/*
	 * The different helpers are loaded
	 * Url is used to manage the different URL poiting to the different parts of the website
	 * Assets is used to link the css and js files
	 * Verif provides functions to perform simple tests on variables
	 */
	$this->load->helper(array('url', 'assets', 'verif'));

	$this->load->view('Misc/header');
	foreach($views as $page)
		// The views' name are stored into $page[0] and the data into $page[1]
		$this->load->view($page[0], $page[1]);
	$this->load->view('Misc/footer');
?>