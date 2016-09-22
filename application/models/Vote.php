<?php

/* 
 * Vote model which fetches information from the sql table Votes
 */
class Vote extends CI_Model {
    public $id;
    public $pollId;
    public $optionId;
    public $ipAddress;
   

    public function __construct() {
        $this->load->database();
    }
    
    public function read($id) {
    $vote = new Vote();
    $query = $this->db->get_where('Votes', array('id'=>$id));
    if ($query->num_rows() !== 1) {
        throw new Exception("Vote ID $id not found in database");
    }

        $rows = $query->result();
        $row = $rows[0];
        $vote->load($row);
        return $vote;
    }


/**
 * 
 * @param type $pollId
 * @return \Vote
 * 
 * Takes a poll id and returns all of the votes
 * 
 */
    public function listAll($pollId=NULL) {
        $this->db->order_by('poll_id');
        $this->db->select('id, poll_id as pollId');
        $this->db->select('id, option_id as optionId');
        $this->db->select('id, ip_adress as ipAddress');
        
        if ($pollId) {
            $this->db->where(array('poll_id' => $pollId));
            
        }
        $rows = $this->db->get('Votes')->result();
        $list = array();
        
        foreach ($rows as $row) {
            $vote = new Vote();
            $vote->load($row);
            $list[] = $vote;
        }
        
        return $list;
    }


    /** Return an array of all votes in the database.
     * @return an array of Vote objects containing votes and ordered by their
     * id 
     */
    public function getAllVotes() {
        $this->db->order_by('Id', 'ASC');
        $rows = $this->db->get('Votes')->result();
        $list = array();
        foreach ($rows as $row) {
            $vote = new Vote();
            $vote->load($row);
            $list[] = $row;
        }
        return $list;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     * 
     * Takes a poll id and returns the vote count for that given poll
     */
    public function getVoteCount($id) {
        $votesList = array();
        $query = $this->db->select('option_id, count(*) as voteCount')
                          ->from('Votes')
                          ->where('poll_id=\'' . $id . '\'')
                          ->group_by('option_id');
  
        
        $query = $query->get()->result();
        return $query;
    }
    
    
    /**
     * 
     * @param type $pollId
     * @param type $optionId
     * 
     * Adds vote object to the given poll and adds a count next to the
     * given option id
     */
    public function addVote($pollId, $optionId) {
        $voteData = array(
            'poll_id'=> $pollId,
            'option_id' => $optionId,
            'ip_address' => $this->input->ip_address()
        );
        
        $this->db->insert('Votes', $voteData);
        
    }
    
    
     /**
     * 
     * @param type $id
     * 
     * Takes a poll id and deletes the vote objects that correspond to that
     * poll id from the Votes sql table
     */
    public function deleteVotes($id) {
        $this->db->where('poll_id', $id);
        $this->db->delete('Votes');
    }


    // Given a row from the database, copy all database column values
    // into 'this', converting column names to fields names by converting
    // first char to lower case.
    private function load($row) {
        foreach ((array) $row as $field => $value) {
            $fieldName = strtolower($field[0]) . substr($field, 1);
            $this->$fieldName = $value;
        }
    }


    // Check that the result from a DB query was OK
    private static function checkResult($result) {
        global $DB;
        if (!$result) {
            die("DB error ({$DB->error})");
        }
    }
};
