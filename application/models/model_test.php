<?php
class Model_test extends CI_Model {

 public function __construct()
        {
          parent::__construct();
	      $this->load->helper('url');	
	      $this->load->database();		
        }
        public function getService()
        {
                $query=$this->db->query("select *from service_request");
		        return $query->result();
        }
}