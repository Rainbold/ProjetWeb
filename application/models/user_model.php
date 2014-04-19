<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	protected $table = 'aa_users';

	public function user_add($pseudo, $pass, $email)
	{
		$this->db->set('pseudo', $pseudo);
		$this->db->set('password', md5($pass));
		$this->db->set('email', $email);

		$code = "aaaaaa";
		$hexa = "0123456789abcdef";
		for($i=0; $i<6; $i++)
			$code[$i] = $hexa[rand(0, 15)];

		$this->db->set('color', $code);

		return $this->db->insert($this->table);
	}

	public function user_if_pseudo_exists($pseudo)
	{
		$sql = "SELECT id FROM ".$this->table." WHERE UPPER(pseudo) = UPPER(?)";
		$data = array($pseudo);
		$query = $this->db->query($sql, $data);
		return $query->num_rows();
	}

	public function user_if_email_exists($email)
	{
		$sql = "SELECT id FROM ".$this->table." WHERE email = ?";
		$data = array($email);
		$query = $this->db->query($sql, $data);
		return $query->num_rows();
	}
}