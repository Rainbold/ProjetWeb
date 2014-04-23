<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ask extends CI_Controller
{
	/*
	 * The question/answers' class
	 * 
	 * 
	 */

	// Var used to pass datas to the views
	var $data = array();

	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	public function list_quest($cat = 'latest', $page = 1)
	{
		// Loads the model for the aa_users table
		// $this->load->model('user_model', 'userManager');
		$this->load->model('ask_model', 'askManager');

		$data_home = array(); 
		$data_home['nb_quest_page'] = 2;
		$data_home['cat'] = $cat;

		$nb_quest = $this->askManager->ask_get_nb_questions();
		$data_home['nb_pages'] = ceil($nb_quest/$data_home['nb_quest_page']);
		
		$page--;
		$offset = ($page >= 0 && $page+2 < $nb_quest) ? $page : 0;
		$data_home['page'] = $offset+1;
		print $offset;
		$offset *= $data_home['nb_quest_page'];

		switch($cat)
		{
			case 'latest':
				$data_home['data'] = $this->askManager->ask_get_latest_questions($data_home['nb_quest_page'], $offset);
				break;
			case 'views':
				$data_home['data'] = $this->askManager->ask_get_popular_questions(time(), $data_home['nb_quest_page'], $offset, 'views');
				break;
			case 'answers':
				$data_home['data'] = $this->askManager->ask_get_popular_questions(time(), $data_home['nb_quest_page'], $offset, 'answers');
				break;
			default:
				break;
		}
		$this->data['views'] = array(array('Ask/index', $data_home));
		$this->load->view('Misc/template', $this->data);
	}
}
