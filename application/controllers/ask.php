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
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());

		// Loads the model for the aa_users table
		// $this->load->model('user_model', 'userManager');
		$this->load->model('ask_model', 'askManager');

		$data_list = array(); 
		$data_list['nb_quest_page'] = 2;
		$data_list['cat'] = $cat;

		$nb_quest = $this->askManager->ask_get_nb_questions();
		$data_list['nb_pages'] = ceil($nb_quest/$data_list['nb_quest_page']);
		
		$page--;
		$offset = ($page >= 0 && $page+2 < $nb_quest) ? $page : 0;
		$data_list['page'] = $offset+1;
		$offset *= $data_list['nb_quest_page'];

		switch($cat)
		{
			case 'latest':
				$data_list['data'] = $this->askManager->ask_get_latest_questions($data_list['nb_quest_page'], $offset);
				break;
			case 'views':
				$data_list['data'] = $this->askManager->ask_get_popular_questions(time(), $data_list['nb_quest_page'], $offset, 'views');
				break;
			case 'answers':
				$data_list['data'] = $this->askManager->ask_get_popular_questions(time(), $data_list['nb_quest_page'], $offset, 'answers');
				break;
			default:
				break;
		}
		$this->data['views'] = array(array('Ask/index', $data_list));
		$this->load->view('Misc/template', $this->data);
	}

	public function show($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());

		if(empty($id))
			redirect(site_url(array('index.php', 'ask', 'list_quest')));

		$this->load->model('ask_model', 'askManager');
		$this->load->model('user_model', 'userManager');

		$data_show = array();
		$data_show['answer_aux'] = array();
		$data_show['quest'] = $this->askManager->ask_get_quest($id);
		$data_show['user'] = '';
		if($data_show['quest']) {
			$data_show['user'] = $this->userManager->user_get_info($data_show['quest']->author_id);
			$data_show['answers'] = $this->askManager->ask_get_answers($id);
			if($data_show['answers'])
			{
				foreach($data_show['answers'] as $answer)
				{
					$ans_ans = array( 'answers' => array(), 'users' => array() );
					$ans_ans['answers'] = $this->askManager->ask_get_answers($answer->id);
					if($ans_ans['answers'])
						foreach ($ans_ans['answers'] as $key => $ans) {
							$ans_ans['users'][$key] = $this->userManager->user_get_info($ans->author_id);
						}
					array_push($data_show['answer_aux'], array('ans' => $answer, 'user' => $this->userManager->user_get_info($answer->author_id), 'rep' => $ans_ans));
				}
			}
		}
		$data_show['answers'] = $data_show['answer_aux'];
		$this->data['views'] = array(array('Ask/show', $data_show));
		$this->load->view('Misc/template', $this->data);
	}

	public function add($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());

		$this->load->model('ask_model', 'askManager');

		$this->load->helper('url');

    	$this->load->helper('form');
		$this->load->library('form_validation');

		// Rules on the different datas submitted to avoid security exploits
		$this->form_validation->set_rules('answer', '"Answer"', 'trim|required|encode_php_tags|xss_clean');
		if(empty($id))
			$this->form_validation->set_rules('title', '"Title"', 'trim|required|encode_php_tags|xss_clean');

		if( $this->form_validation->run() )
		{
			$answer = $this->input->post('answer');
			$id_quest = intval($this->input->post('id_quest'));
			if(empty($id))
				$title = $this->input->post('title');
			else
				$title = '';
			$author_id = $this->session->userdata('id');
			$this->askManager->ask_add($author_id, $answer, $title, $id_quest);
		}
		
		if(empty($id))
			redirect( site_url(array('index.php', 'ask', 'show', $this->askManager->ask_get_latest_questions(1)[0]->id )) );
		else
			redirect( site_url(array('index.php', 'ask', 'show', $id)) );

	}

	public function del($id)
	{
		$data = array('views' => array());
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());

		$this->load->model('ask_model', 'askManager');

		$quest = $this->askManager->ask_get_answer($id);
		if($quest->author_id == $this->session->userdata('id')) {
			$this->askManager->ask_delete($quest->id);
			redirect( site_url(array('index.php', 'ask', 'show', $this->askManager->ask_get_top_level_id_quest($quest->id_quest))) );
		}
	}

	public function new_quest()
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());

		$this->load->model('ask_model', 'askManager');
		$this->load->model('user_model', 'userManager');

		$data_new = array();

		$this->data['views'] = array(array('Ask/new', $data_new));
		$this->load->view('Misc/template', $this->data);
	}

}
