<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Views_model extends CI_Model
{
	protected $table_views = 'aa_views';

	// Addsa view for a wuestion/answer
	public function views_add($id_user, $id_quest)
	{
		$sql = "SELECT id FROM ".$this->table_views."
				WHERE id_user = ? AND id_quest = ?";
		$data = array($id_user, $id_quest);
		$query = $this->db->query($sql, $data);
		if( $query->num_rows() <= 0 )
		{
			$sql = "INSERT INTO ".$this->table_views."(id_quest, id_user, time)
					VALUES(?, ?, ?)";
			$data = array($id_quest, $id_user, time());
			$query = $this->db->query($sql, $data);
		}
	}
} 