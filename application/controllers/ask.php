<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ask extends CI_Controller
{
	/*
	 * The question/answers' class
	 * Returns the questions/answers' list based on a given id
	 * Displays, add, edit, delete questions/answers
	 * Vote for a question
	 */

	// Var used to pass datas to the views
	var $data = array();

	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	// Returns the list of question based on a given page's number and on the category
	public function list_quest($cat = 'latest', $page = 1)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			// Loads the model for the aa_model table
			$this->load->model('ask_model', 'askManager');

			$data_list = array();

			// Number of questions per page 
			$data_list['nb_quest_page'] = 10;
			$data_list['cat'] = $cat;

			$nb_quest = $this->askManager->ask_get_nb_questions();
			// Number of pages
			$data_list['nb_pages'] = ceil($nb_quest/$data_list['nb_quest_page']);
			
			$page--;
			$offset = ($page >= 0) ? $page : 0;
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
				case 'votes':
					$data_list['data'] = $this->askManager->ask_get_popular_questions(time(), $data_list['nb_quest_page'], $offset, 'votes');
					break;
				default:
					break;
			}
			$this->data['views'] = array(array('Ask/index', $data_list));
			$this->load->view('Misc/template', $this->data);
		}
	}

	public function show($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$id = intval($id);
			if(empty($id))
				redirect(site_url(array('index.php', 'ask', 'list_quest')));
			else
			{
				$this->load->model('ask_model', 'askManager');
				$quest = $this->askManager->ask_get_answer($id);

				// If the entry in the database does not exist the user is redirected to the main page
				if(!$quest)
					redirect(base_url());
				else
				{
					$this->load->model('user_model', 'userManager');
					$this->load->model('views_model', 'viewsManager');
					$this->load->model('votes_model', 'votesManager');

					$this->viewsManager->views_add($this->session->userdata('id'), $id);

					$data_show = array();
					$data_show['answer_aux'] = array();
					$data_show['quest'] = $this->askManager->ask_get_quest($id);
					$data_show['user'] = '';
					$data_show['votes'] = '';

					// If the question exists
					if($data_show['quest']) {
						$data_show['user'] = $this->userManager->user_get_info($data_show['quest']->author_id);
						$data_show['votes'] = array('nb' => $this->votesManager->votes_get_by_ask($id), 'user_value' => $this->votesManager->votes_get_by_ask_user($id, $this->session->userdata('id')));
						$data_show['answers'] = $this->askManager->ask_get_answers($id);
						
						// If there is answers
						if($data_show['answers'])
						{
							foreach($data_show['answers'] as $answer)
							{
								$ans_ans = array( 'answers' => array(), 'users' => array(), 'votes' => array() );
								$ans_ans['answers'] = $this->askManager->ask_get_answers($answer->id);
								// If the original answers also has answers
								if($ans_ans['answers'])
									foreach ($ans_ans['answers'] as $key => $ans) {
										$ans_ans['users'][$key] = $this->userManager->user_get_info($ans->author_id);
										$ans_ans['votes'][$key] = array('nb' => $this->votesManager->votes_get_by_ask($ans->id), 
										  				   				'user_value' => $this->votesManager->votes_get_by_ask_user($ans->id, $this->session->userdata('id')));
									}
								array_push($data_show['answer_aux'], 
									array('ans' => $answer, 
										  'user' => $this->userManager->user_get_info($answer->author_id), 
										  'votes' => array('nb' => $this->votesManager->votes_get_by_ask($answer->id), 
										  				   'user_value' => $this->votesManager->votes_get_by_ask_user($answer->id, $this->session->userdata('id'))), 
										  'rep' => $ans_ans));
							}
						}
					}
					$data_show['answers'] = $data_show['answer_aux'];
					$this->data['views'] = array(array('Ask/show', $data_show));
					$this->load->view('Misc/template', $this->data);
				}
			}
		}
	}

	// Adds a question or an answer into te database
	public function add($id)
	{
		// The $id var is used to redirect the user to the answered question
		// or to the newly added question if it's empty

		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$this->load->model('ask_model', 'askManager');

			$this->load->helper('url');

	    	$this->load->helper('form');
			$this->load->library('form_validation');

			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('answer', '"Answer"', 'trim|required|encode_php_tags|xss_clean');
			// If there is an empty id it means it is a new question, thus the title must be saved
			if(empty($id))
				$this->form_validation->set_rules('title', '"Title"', 'trim|required|encode_php_tags|xss_clean');

			// If everything's fine, the data are stored
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
			
			$id = intval($id);
			if(empty($id))
				redirect( site_url(array('index.php', 'ask', 'show', $this->askManager->ask_get_latest_questions(1)[0]->id )) );
			else
				redirect( site_url(array('index.php', 'ask', 'show', $id)) );
		}
	}

	// Deletes a question or an answer from a database
	public function del($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$data = array('views' => array());

			$this->load->model('ask_model', 'askManager');
			$id = intval($id);

			$quest = $this->askManager->ask_get_answer($id);

			// If the user is truly the author then it is removed
			if($quest->author_id == $this->session->userdata('id')) {
				$this->askManager->ask_delete($quest->id);
			}
			
			redirect( site_url(array('index.php', 'ask', 'show', $this->askManager->ask_get_top_level_id_quest($quest->id_quest))) );
		}
	}

	// Loads the view containing the form for a new question or answer
	public function new_quest()
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$this->load->model('ask_model', 'askManager');
			$this->load->model('user_model', 'userManager');

			$this->data['views'] = array(array('Ask/new', ''));
			$this->load->view('Misc/template', $this->data);
		}
	}

	// Loads the view containing the form used to edit a question or an answer
	public function edit_quest($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$id = intval($id);
			$this->load->model('ask_model', 'askManager');

			$quest = $this->askManager->ask_get_answer($id);
			// If the current user is not the question/answer's author he's redirected to the main page
			if($quest->author_id != $this->session->userdata('id')) {
				redirect(base_url());
			}
			else
			{
				$this->data['views'] = array(array('Ask/new', $quest));
				$this->load->view('Misc/template', $this->data);
			}
		}
	}

	// Edits a question or an answer
	public function edit($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$this->load->model('ask_model', 'askManager');
			$id = intval($id);
			$quest = $this->askManager->ask_get_answer($id);

			// If the entry in the database does not exist the user is redirected to the main page
			if(!$quest)
				redirect(base_url());
			else
			{
				// If the current user is not the question/answer's author he's redirected to the main page
				if($quest->author_id != $this->session->userdata('id'))
					redirect(base_url());
				else
				{
					$this->load->helper('form');
					$this->load->library('form_validation');

					// Rules on the different datas submitted to avoid security exploits
					$this->form_validation->set_rules('answer', '"Answer"', 'trim|required|encode_php_tags|xss_clean');
					if($quest->id_quest < 0)
						$this->form_validation->set_rules('title', '"Title"', 'trim|required|encode_php_tags|xss_clean');
					
					if( $this->form_validation->run() )
					{
						$answer = $this->input->post('answer');
						if($quest->id_quest < 0)
							$title = $this->input->post('title');
						else
							$title = '';
						$this->askManager->ask_edit($id, $answer, $title);
						redirect( site_url(array('index.php', 'ask', 'show', $this->askManager->ask_get_top_level_id_quest($id))) );
					}

				}
			}
		}
	}

	// Votes for a question
	public function vote($id_ask, $value)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$this->load->model('ask_model', 'askManager');
			$id_ask = intval($id_ask);
			$ask = $this->askManager->ask_get_answer($id_ask);

			// If the entry in the database does not exist the user is redirected to the main page
			if(!$ask)
				redirect(base_url());
			else
			{
				// If the current user is the question/answer's author he's redirected to the main page
				if($ask->author_id == $this->session->userdata('id'))
					redirect(base_url());
				else
				{
					switch($value)
					{
						case 'u':
							$value = 1;
							break;
						case 'd':
							$value = -1;
							break;
						default :
							redirect(base_url());
							break;
					}
					$this->load->model('votes_model', 'votesManager');
					$this->votesManager->votes_add($this->session->userdata('id'), $id_ask, $value);

					redirect( site_url(array('index.php', 'ask', 'show', $this->askManager->ask_get_top_level_id_quest($id_ask))) );
				}
			}
		}
	}
}
