<?php

/* 
 * 
 */
class Poll extends CI_Model {
    public $Id;
    public $Title;
    public $Body;
   

    public function __construct() {
        $this->load->database();
    }
    
    public function read($id) {
    $poll = new Poll();
    $query = $this->db->get_where('polls', array('id'=>$id));
    if ($query->num_rows() !== 1) {
        throw new Exception("Poll ID $id not found in database");
    }

        $rows = $query->result();
        $row = $rows[0];
        $poll->load($row);
        return $poll;
    }


    /** Return an associative array id=>poll for all polls in the
     *  database
     * @param pollId
     * @return associative array mapping id to pollId
     */
    public function listAll($pollId=NULL) {
        $this->db->order_by('Title');
        $this->db->select('id, Title as title');
        if ($pollId) {
            $this->db->where(array('Id' => $pollId));
        }
        $rows = $this->db->get('polls')->result();
        $list = array();
        foreach ($rows as $row) {
            $list[$row->id] = $row->title;
        }
        return $list;
    }


    /** Return an array of all polls in the database.
     * @return an array of Poll objects containing all polls, ordered
     * by id.
     */
    public function getAllPolls() {
        $this->db->order_by('Title', 'ASC');
        $rows = $this->db->get('polls')->result();
        $list = array();
        foreach ($rows as $row) {
            $poll = new Poll();
            $poll->load($row);
            $list[] = $row;
        }
        return $list;
    }
    
    
     /**
     * @param type $id
     * Takes a poll id and reeturns the poll with the given id with its 
     * given id, title and body*/
    public function getPoll($id) {
        $query = $this->db
                ->select('*')
                ->from('polls')
                ->where('Id=\'' . $id . '\'');
        $query = $query->get()->result();
        $poll = new Poll();
        $row = $query[0];
        $poll->load($row);
        return $poll;
    }
    
     /**
     * @param type $id
     * Takes a poll id and reeturns the poll with the given id with its 
     * given id, the id of the option, and the body of the the option that
        correspond to that poll */ 
    public function getPollOptions($id) {
        
        $query = $this->db
                ->select('Id, poll_id, Body')
                ->from('Options')
                ->where('poll_id=\'' . $id . '\'');  
        $query = $query->get()->result();
        return $query;
    }
    
    
         /**
         * @param type $id
         * Takes a poll id and reeturns the poll with the given id with its 
        given id, the id of the option, the body of the poll 
         * and the body of the the option that
        correspond to that poll */
    public function getPollWithOptions($id) {

        $query = $this->db
                ->select('polls.Id, polls.Title, polls.Body, Options.poll_id, '
                        . 'Options.Id, Options.Body')
                ->from('Options')
                ->where('polls.Id=\'' . $id . '\'')
                ->join('polls', 'Options.poll_id=polls.Id');
        
        $query = $query->get()->result();
        return $query;
            
    }


    // Given a row from the database, copy$row all database column values
    // into 'this', converting column names to fields names by converting
    // first char to lower case.
    private function load($row) {
        foreach ((array) $row as $field => $value) {
            $this->$field = $value;
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
