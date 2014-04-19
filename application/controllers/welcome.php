<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	var $data = array();

	public function Blog()
	{
		parent::Controller();
	}

	public function index()
	{
		$data['views'] = array(array('Home/index', ''));

    	$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('user_model', 'userManager');

		$this->form_validation->set_rules('pseudo', '"Pseudonym"', 'trim|required|min_length[2]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[8]|max_length[52]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('password', '"Password"', 'trim|required|min_length[6]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');

		if( $this->form_validation->run() )
		{
			$pseudo = $this->input->post('pseudo');
			$password = $this->input->post('password');
			$email = $this->input->post('email');

			if($this->userManager->user_if_pseudo_exists($pseudo))
			{
				array_unshift($data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => 'This pseudo is already taken.' )));
			}
			else if($this->userManager->user_if_email_exists($email))
			{
				array_unshift($data['views'], array('Misc/overlay', array( 'title' => 'Error', 'msg' => 'This email address already exists in our database.' )));
			}
			else
			{
				$result = $this->userManager->user_add($pseudo, $password, $email);
				array_unshift($data['views'], array('Misc/overlay', array( 'title' => 'Success', 'msg' => 'Thank you for signing up !' )));
			}
		}
		elseif(form_error('pseudo') || form_error('password') || form_error('email'))
		{
			array_unshift($data['views'], array('Misc/overlay', array( 'title' => 'Titre', 'msg' => form_error('pseudo').'<br/>'.form_error('email').'<br/>'.form_error('password') )));
		}

		$this->load->view('Misc/template', $data);
	}
}
