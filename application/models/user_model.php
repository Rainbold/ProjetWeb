<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	protected $table = 'aa_users';

	// Add a user to the database
	public function user_add($pseudo, $pass, $email)
	{
		$this->db->set('pseudo', $pseudo);
		$this->db->set('password', md5($pass));
		$this->db->set('email', $email);

		$code = "aaaaaa";
		$hexa = "0123456789abcdef";
		for( $i=0; $i<6; $i++ )
			$code[$i] = $hexa[rand(0, 15)];

		$this->db->set('color', $code);

		return $this->db->insert($this->table);
	}

	// Check if the submitted pseudo already exists
	public function user_if_pseudo_exists($pseudo)
	{
		$sql = "SELECT id FROM ".$this->table." WHERE UPPER(pseudo) = UPPER(?)";
		$data = array($pseudo);
		$query = $this->db->query($sql, $data);
		return $query->num_rows();
	}

	// Check if the submitted email already exists
	public function user_if_email_exists($email)
	{
		$sql = "SELECT id FROM ".$this->table." WHERE email = ?";
		$data = array($email);
		$query = $this->db->query($sql, $data);
		return $query->num_rows();
	}

	// Check if the guest can log in
	public function user_get_id($email, $password)
	{
		$sql = "SELECT id FROM ".$this->table." WHERE email = ? AND password = ? LIMIT 1";
		$data = array($email, md5($password));
		$query = $this->db->query($sql, $data);
		if( $query->row() )
			return $query->row()->id;
		else
			return 0;
	}

	// Check if the guest can log in
	public function user_get_info($id)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE id = ? LIMIT 1";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if( $query->row() )
			return $query->row();
		else
			return 0;
	}
}