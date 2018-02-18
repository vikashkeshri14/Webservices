<?php

include_once('model_log.php');
	class Model_common extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	 
	  $this->load->helper('url');	
	  $this->load->database();		
	}

	
 public function getroles()//--Getting complete list of roles available
	{
		 try
		 {
			$q=$this->db->query("select r.* from role as r");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'Model_common.php >> getroles >> '.$e->getMessage());
		 }
		 
	 }
}

?>