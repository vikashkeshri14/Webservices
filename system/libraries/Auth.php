<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
			
	  }
	  
	  public function instructor()
	  {
		  $this->load->model('model_test');
		 echo json_encode($this->model_test->getService());
	  }
	  
	
		
}