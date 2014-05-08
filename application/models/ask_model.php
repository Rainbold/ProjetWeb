<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ask_model extends CI_Model
{
	protected $table_ask = 'aa_ask';
	protected $table_views = 'aa_views';

	// Function used to sort the result of some queries by the number of views
	protected function ask_sort_by_nb_views($a, $b)
	{
		if( $a->nb_views == $b->nb_views ){ return 0 ; }
		return( $a->nb_views < $b->nb_views ) ? -1 : 1;
	}

	public function ask_get_nb_questions()
	{
		$sql = "SELECT COUNT(*) AS nb_quest
				FROM ".$this->table_ask."
				WHERE id_quest = -1";
		$query = $this->db->query($sql);
		if( $query->row() != NULL )
			return $query->row()->nb_quest;
		else
			return 0;
	}


	// Returns an array containing the most recent questions
	public function ask_get_latest_questions($nb = 10, $offset = 0)
	{
		$sql = "SELECT ask.id, ask.title 
				FROM ".$this->table_ask." ask 
				WHERE ask.id_quest = -1
				ORDER BY date DESC LIMIT ? OFFSET ?";
		$data = array($nb, intval($offset));
		$query = $this->db->query($sql, $data);
		$this->load->model('votes_model', 'votesManager');
		$res = $query->result();
		for( $i=0; $i<count($res); $i++ ) {
			$res[$i]->nb_ans = $this->ask_get_nb_answers($res[$i]->id);
			$res[$i]->nb_views = $this->ask_get_nb_views($res[$i]->id);
			$val = $this->votesManager->votes_get_by_ask($res[$i]->id);
			$res[$i]->nb_votes = ($val) ? $val:0;
		}
		if( $query->result() )
			return $query->result();
		else
			return 0;
	}

	// Returns an array containing the most popular questions during a given period
	public function ask_get_popular_questions($range = 0, $nb = 10, $offset = 0, $sort='')
	{
		$sql = "SELECT ask.id, ask.title, COUNT(views.id_quest) AS nb_views 
				FROM ".$this->table_ask." ask, ".$this->table_views." views 
				WHERE ask.date >= UNIX_TIMESTAMP()-?
				AND ask.id_quest = -1
				GROUP BY ask.id
				LIMIT ? OFFSET ?";
		$data = array($range, $nb, $offset);
		$query = $this->db->query($sql, $data);
		$res = $query->result();
		$this->load->model('votes_model', 'votesManager');
		for( $i=0; $i<count($res); $i++ ) {
			$res[$i]->nb_ans = $this->ask_get_nb_answers($res[$i]->id);
			$res[$i]->nb_views = $this->ask_get_nb_views($res[$i]->id);
			$val = $this->votesManager->votes_get_by_ask($res[$i]->id);
			$res[$i]->nb_votes = ($val) ? $val:0;
		}


		switch($sort)
		{
			case 'answers':
				usort($res, function($a, $b)
				{
					if($a->nb_ans == $b->nb_ans){ 
						if($a->nb_views == $b->nb_views){
							if($a->nb_votes == $b->nb_votes)
								return 0;
							return ($a->nb_votes < $b->nb_votes) ? 1 : -1;
						}
						return ($a->nb_views < $b->nb_views) ? 1 : -1;
					}
					return ($a->nb_ans < $b->nb_ans) ? 1 : -1;
				});
				break;
			case 'views':
				usort($res, function($a, $b)
				{
					if($a->nb_views == $b->nb_views){ 
						if($a->nb_ans == $b->nb_ans){
							if($a->nb_votes == $b->nb_votes)
								return 0;
							return ($a->nb_votes < $b->nb_votes) ? 1 : -1;
						}
						return ($a->nb_ans < $b->nb_ans) ? 1 : -1;
					}
					return ($a->nb_views < $b->nb_views) ? 1 : -1;
				});
				break;
			case 'votes':
				usort($res, function($a, $b)
				{
					if($a->nb_votes == $b->nb_votes){ 
						if($a->nb_ans == $b->nb_ans){
							if($a->nb_views == $b->nb_views)
								return 0;
							return ($a->nb_views < $b->nb_views) ? 1 : -1;
						}
						return ($a->nb_ans < $b->nb_ans) ? 1 : -1;
					}
					return ($a->nb_votes < $b->nb_votes) ? 1 : -1;
				});
				break;
			default:
				break;

		}

		if( $res )
			return $res;
		else
			return 0;
	}

	// Gets the number of answers for the question with $id as id
	protected function ask_get_nb_answers($id)
	{
		$sql = "SELECT COUNT(*) AS nb_ans
				FROM ".$this->table_ask."
				WHERE id_quest = ?
				GROUP BY id_quest";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if( $query->row() != NULL )
			return $query->row()->nb_ans;
		else
			return 0;
	}

	// Gets the number of views for the question with $id as id
	protected function ask_get_nb_views($id)
	{
		$sql = "SELECT COUNT(*) AS nb_views
				FROM ".$this->table_views."
				WHERE id_quest = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if( $query->row() != NULL )
			return $query->row()->nb_views;
		else
			return 0;
	}

	// Gets the info of the question with $id as id
	public function ask_get_quest($id)
	{
		$sql = "SELECT *
				FROM ".$this->table_ask."
				WHERE id = ?
				AND id_quest = -1
				LIMIT 1";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if( $query->row() != NULL )
			return $query->row();
		else
			return 0;
	}

	// Gets the answers for the question with $id as id
	public function ask_get_answers($id)
	{
		$sql = "SELECT *
				FROM ".$this->table_ask."
				WHERE id_quest = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		$res = $query->result();
		$this->load->model('votes_model', 'votesManager');
		for( $i=0; $i<count($res); $i++ ) {
			$val = $this->votesManager->votes_get_by_ask($res[$i]->id);
			$res[$i]->nb_votes = ($val) ? $val:0;
		}

		// The answers are sorted by number of votes
		usort($res, function($a, $b)
		{
			if($a->nb_votes == $b->nb_votes) {
				return 0;
			}
			return ($a->nb_votes < $b->nb_votes) ? 1 : -1;
		});

		if( $res )
			return $res;
		else
			return 0;
	}

	// Gets the answers for the question with $id as id
	public function ask_get_answer($id)
	{
		$sql = "SELECT *
				FROM ".$this->table_ask."
				WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		if( $query->row() != NULL )
			return $query->row();
		else
			return 0;
	}

	// Gets the answers for the question with $id as id
	public function ask_get_top_level_id_quest($id)
	{
		$sql = "SELECT id_quest
				FROM ".$this->table_ask."
				WHERE id = ?";
		$id_quest = $id;
		$data = array();
		while($id_quest != -1)
		{
			$data = array($id_quest);
			$query = $this->db->query($sql, $data);
			if( $query->row() == NULL )
				return -1;
			$id_quest = $query->row()->id_quest;
		}
		
		return $data[0];
	}

	// Gets the questions asked by the user with $id as id
	public function ask_get_user_questions($id)
	{
		$sql = "SELECT *
				FROM ".$this->table_ask."
				WHERE id_quest = -1
				AND author_id = ?
				ORDER BY date DESC";
		$data = array($id);
		$query = $this->db->query($sql, $data);
		$res = $query->result();
		for( $i=0; $i<count($res); $i++ ) {
			$res[$i]->nb_ans = $this->ask_get_nb_answers($res[$i]->id);
			$res[$i]->nb_views = $this->ask_get_nb_views($res[$i]->id);
		}
		if( $query->result() != NULL )
			return $query->result();
		else
			return 0;
	}

	// Gets the unanswered questions
	public function ask_get_unanswered_questions()
	{
		$sql = "SELECT *
				FROM ".$this->table_ask."
				WHERE id NOT IN 
				(SELECT id_quest FROM `aa_ask` WHERE id_quest != -1) 
				AND id_quest = -1";
		$query = $this->db->query($sql);
		$res = $query->result();
		for( $i=0; $i<count($res); $i++ ) {
			$res[$i]->nb_ans = $this->ask_get_nb_answers($res[$i]->id);
			$res[$i]->nb_views = $this->ask_get_nb_views($res[$i]->id);
		}
		if( $query->result() != NULL )
			return $query->result();
		else
			return 0;
	}

	// Add a new question/answer
	public function ask_add($author_id, $answer, $title = '', $id_quest=-1)
	{
		$sql = "INSERT INTO ".$this->table_ask."(id_quest, title, text, date, author_id) VALUES(?, ?, ?, ?, ?)";
		$data = array($id_quest, $title, $answer, time(), $author_id);
		$query = $this->db->query($sql, $data);	
	}

	// Edit a previous question/answer
	public function ask_edit($id, $answer, $title = '')
	{
		$sql = "UPDATE ".$this->table_ask." SET text = ?, title = ? WHERE id = ?";
		$data = array($answer, $title, $id);
		$query = $this->db->query($sql, $data);	
	}

	// Deletes the question/answer and its answers
	public function ask_delete($id)
	{
		$ids = array($id);

		$sql = "SELECT id
				FROM ".$this->table_ask."
				WHERE id_quest = ?";
		$data = array($id);
		$query = $this->db->query($sql, $data);

		while(!empty($data)) {
			$data = array();
			foreach($query->result() as $quest)
			{
				array_push($data, $quest->id);
				array_push($ids, $quest->id);
			}
			if(empty($data))
				break;
			$clause = implode(',', array_fill(0, count($data), '?'));
			$sql = "SELECT id
					FROM ".$this->table_ask."
					WHERE id_quest IN (".$clause.")";
			$query = $this->db->query($sql, $data);
		}

		$clause = implode(',', array_fill(0, count($ids), '?'));
		$sql = "DELETE FROM ".$this->table_ask." WHERE id IN (".$clause.")";
		$query = $this->db->query($sql, $ids);
	}
} 