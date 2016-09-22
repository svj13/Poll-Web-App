
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file polls.php
 * @author Matthew Ruffell
 * @date 10 October 2014
 * @brief This file simply serves up the original angular frontpage
 */
class Polls extends CI_Controller 
{
    /**
     * Loads the front angular page
     */
    public function index()
    {
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->view('polls');
    }
}

