<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votes_model extends CI_Model
{
	protected $table_views = 'aa_votes';

	public function votes_add($id_user, $id_ask, $value)
	{
		$sql = "SELECT value FROM ".$this->table_votes."
				WHERE id_voting_user = ? AND id_ask = ?";
		$data = array($id_user, $id_ask);
		$value = ($value >= 0) ? 1:-1;
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
			$SQL = "INSERT INTO ".$this->views."(id_ask, id_voting_user, value) 
					VALUES(?, ?, ?)";
			$data = array($id_ask, $id_user, $value);
			$query = $this->db->query($sql, $data);
		}
	}

	public function votes_get_by_ask($id)
	{
		$sql = "SELECT COUNT(*) as nb FROM ".$this->views."
				WHERE id_ask = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if($query->num_rows() > 0)
			return $query->row()->nb;
		else
			return 0;
	}
} 