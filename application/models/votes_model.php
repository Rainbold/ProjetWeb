<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votes_model extends CI_Model
{
	protected $table_votes = 'aa_votes';
	protected $table_ask = 'aa_ask';

	public function votes_add($id_user, $id_ask, $value)
	{
		$sql = "SELECT value FROM ".$this->table_votes."
				WHERE id_voting_user = ? AND id_ask = ?";
		$data = array($id_user, $id_ask);
		$query = $this->db->query($sql, $data);
		if( $query->num_rows() > 0 )
		{
			if($query->row()->value == $value) {
				$sql = "DELETE FROM ".$this->table_votes."
						WHERE id_voting_user = ? AND id_ask = ?";
				$data = array($id_user, $id_ask);
			}
			else {
				$sql = "UPDATE ".$this->table_votes." SET value = ? 
						WHERE id_voting_user = ? AND id_ask = ?";
				$data = array($value, $id_user, $id_ask);
			}
			$query = $this->db->query($sql, $data);
				
		}
		else
		{
			$sql = "INSERT INTO ".$this->table_votes."(id_ask, id_voting_user, value) 
					VALUES(?, ?, ?)";
			$data = array($id_ask, $id_user, $value);
			$query = $this->db->query($sql, $data);
		}
	}

	public function votes_get_by_ask($id)
	{
		$sql = "SELECT SUM(value) as nb FROM ".$this->table_votes."
				WHERE id_ask = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			return $query->row()->nb;
		else
			return 0;
	}

	public function votes_get_by_ask_user($id_ask, $id_user)
	{
		$sql = "SELECT value FROM ".$this->table_votes."
				WHERE id_ask = ? AND id_voting_user = ?";
		$data = array($id_ask, $id_user);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			return $query->row()->value;
		else
			return 0;
	}

	public function votes_received($id_user)
	{
		$sql = "SELECT SUM(value) as nb FROM ".$this->table_votes." as votes, ".$this->table_ask." as ask
				WHERE votes.id_ask = ask.id AND ask.author_id = ? AND votes.value = -1";
		$data = array($id_user);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			$d = $query->row()->nb;
		else
			$d = 0;

		$sql = "SELECT SUM(value) as nb FROM ".$this->table_votes." as votes, ".$this->table_ask." as ask
				WHERE votes.id_ask = ask.id AND ask.author_id = ? AND votes.value = 1";
		$data = array($id_user);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			$u = $query->row()->nb;
		else
			$u = 0;

		return array('up' => $u, 'down' => $d);
	}

	public function votes_given($id_user)
	{
		$sql = "SELECT SUM(value) as nb FROM ".$this->table_votes."
				WHERE id_voting_user = ? AND value = -1";
		$data = array($id_user);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			$d = $query->row()->nb;
		else
			$d = 0;

		$sql = "SELECT SUM(value) as nb FROM ".$this->table_votes."
				WHERE id_voting_user = ? AND value = 1";
		$data = array($id_user);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			$u = $query->row()->nb;
		else
			$u = 0;

		return array('up' => $u, 'down' => $d);
	}
} 