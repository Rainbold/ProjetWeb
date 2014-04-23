<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	/*
	 * The homepage's class
	 * Manages the authentication and the registration
	 * Shows the most recent and popular questions
	 */

	// Var used to pass datas to the views
	var $data = array();

	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	// Homepage's method 
	public function index()
	{
		$this->data['views'] = array();

    	$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		// Loads the model for the aa_users table
		$this->load->model('user_model', 'userManager');
		$this->load->model('ask_model', 'askManager');

		$formSubmit = $this->input->post('submitForm');

		// Telling apart the signup, signout and signin forms
		if( $formSubmit == 'formSignOut' )
		{
			$this->session->sess_destroy();
		}
		elseif( $formSubmit == 'formSignIn' ) 
		{
			// If the user is already logged in...
			if( $this->session->userdata('logged_in') )
			{
				array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => 'You are already logged in !' )));
			}
			else
			{
				// Rules on the different datas submitted to avoid security exploits
				$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[8]|max_length[52]|valid_email|encode_php_tags|xss_clean');
				$this->form_validation->set_rules('password', '"Password"', 'trim|required|min_length[6]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');

				if( $this->form_validation->run() )
				{
					$password = $this->input->post('password');
					$email = $this->input->post('email');
					$id = $this->userManager->user_get_id($email, $password);

					// If the user exists he can be logged in
					if( $id )
					{
						$user = $this->userManager->user_get_info($id);
						$this->session->set_userdata('logged_in', TRUE);
						$this->session->set_userdata('pseudo', $user->pseudo);
						$this->session->set_userdata('email', $user->email);
						$this->session->set_userdata('color', $user->color);
						array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Success', 'msg' => $id )));
					}
					else
					{
						array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => 'Wrong email address or password' )));
					}
				}
				// If errors happened, they are displayed
				elseif(form_error('password') || form_error('email'))
				{
					array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => form_error('pseudo').'<br/>'.form_error('email').'<br/>'.form_error('password') )));
				}
			}
		}
		elseif( $formSubmit == 'formSignUp' )
		{
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('pseudo', '"Pseudonym"', 'trim|required|min_length[2]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[8]|max_length[52]|valid_email|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('password', '"Password"', 'trim|required|min_length[6]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');

			if( $this->form_validation->run() )
			{
				$pseudo = $this->input->post('pseudo');
				$password = $this->input->post('password');
				$email = $this->input->post('email');

				// If the pseudo is already registered in the database...
				if($this->userManager->user_if_pseudo_exists($pseudo))
				{
					array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => 'This pseudo is already taken.' )));
				}
				// If the email address is already registered in the database...
				else if($this->userManager->user_if_email_exists($email))
				{
					array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => 'This email address already exists in our database.' )));
				}
				// If everything's okay, the user is added to the database
				else
				{
					$result = $this->userManager->user_add($pseudo, $password, $email);
					array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Success', 'msg' => 'Thank you for signing up !' )));
				}
			}
			// If errors happened, they are displayed
			elseif(form_error('pseudo') || form_error('password') || form_error('email'))
			{
				array_unshift($this->data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => form_error('pseudo').'<br/>'.form_error('email').'<br/>'.form_error('password') )));
			}	
		}

		$data_home = array(); 
		$data_home['quest_latest'] = $this->askManager->ask_get_latest_questions();
		$data_home['quest_pop_day'] = $this->askManager->ask_get_popular_questions(3600*24);
		$data_home['quest_pop_week'] = $this->askManager->ask_get_popular_questions(3600*24*7);
		$data_home['quest_pop_month'] = $this->askManager->ask_get_popular_questions(3600*24*cal_days_in_month(CAL_GREGORIAN, date('m', time()), date('Y', time())) );

		array_unshift($this->data['views'], array('Home/index', $data_home));

		$this->load->view('Misc/template', $this->data);
	}
}
