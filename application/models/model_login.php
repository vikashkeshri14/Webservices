<?php

//include('model_log.php');
	class Model_login extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->library('session');
	  $this->load->helper('url');	
	  $this->load->database();		
	}


	 public function validate(){
        // grab user input
        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        
        // Prep the query
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        
        // Run the query
        $query = $this->db->get('user');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'username' => $row->username,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}

?>