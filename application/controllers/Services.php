<?php

/* 
 * Services controller which implement all of the methods that invoke
 * queries on the database to fetch information
 */

class Services extends CI_Controller 
{
    /**Returns the list of polls in the database. Each item of the list 
    represents a poll, with its given id, title and body*/ 
    public function getPollList()
    {
       $this->output->set_content_type('application/json');
       $this->load->model('poll');
       $pollList = json_encode($this->poll->getAllPolls());
       $this->output->set_status_header(200, "OK");
       $this->output->set_output($pollList);
    }
    
    /**
     * @param type $id
     * Takes a poll id and reeturns the poll with the given id with its 
     * given id, title and body*/ 
    public function getPoll($id)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('poll'); 
       $poll = json_encode($this->poll->getPoll($id));
       $this->output->set_status_header(200, "OK");
       $this->output->set_output($poll);
        
    }
    
    /**
     * @param type $id
     * Takes a poll id and reeturns the poll with the given id with its 
     * given id, the id of the option, and the body of the the option that
        correspond to that poll */ 
    public function getPollOptions($id)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('poll');
       $optionsList = json_encode($this->poll->getPollOptions($id));
       $this->output->set_output($optionsList);
           
    }   
    
        /**
         * @param type $id
         * Takes a poll id and reeturns the poll with the given id with its 
        given id, the id of the option, the body of the poll 
         * and the body of the the option that
        correspond to that poll */
        public function getPollWithOptions($id)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('poll');
       $pollWithOpt = json_encode($this->poll->getPollWithOptions($id));
       $this->output->set_output($pollWithOpt);
       $this->output->set_status_header(200, "OK");
       $this->output->set_content_type('html');
           
    }   
    
    /**
     * 
     * @param type $id
     * 
     * Takes a poll id and returns a list of vote objects. Each vote object 
     * contains the id of the vote, the poll id, the option id and
     * the ip address it corresponds to of the given poll
     * 
     */
    public function getVotesList($id)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('vote');
       
       $votesList = json_encode($this->vote->getAllVotes($id));
       $this->output->set_output($votesList);
       $this->output->set_content_type('html');
        
    }
    
    /**
     * 
     * @param type $id
     * 
     * Takes a poll id and returns a voteCount object that contains the 
     * option id, and the voteCount corresponding to that option id
     * 
     */
        public function getVoteCount($id)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('vote');
       
       $votesCount = json_encode($this->vote->getVoteCount($id));
       $this->output->set_output($votesCount);
       $this->output->set_status_header(200, "OK");
       $this->output->set_content_type('html');
        
    }
    
    /**
     * 
     * @param type $pollId
     * @param type $optionId
     * 
     * Adds vote object to the given poll and adds a count next to the
     * given option id
     */
    public function addVote($pollId, $optionId)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('vote');
       
       $addVote = json_encode($this->vote->addVote($pollId, $optionId));
       $this->output->set_output($addVote);
       $this->output->set_status_header(200, "OK");
       $this->output->set_content_type('html');
    }
    
    /**
     * 
     * @param type $id
     * 
     * Takes a poll id and deletes the vote objects that correspond to that
     * poll id from the Votes sql table
     */
    public function deleteVotes($id)
    {
       $this->output->set_content_type('application/json');
       $this->load->model('vote');
       
       $votesCount = json_encode($this->vote->deleteVotes($id));
       $this->output->set_output($votesCount);
       $this->output->set_status_header(200, "OK");
       $this->output->set_content_type('html');
    }
    
    
}