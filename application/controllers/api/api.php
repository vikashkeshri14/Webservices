<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
			//  $check=$this->check_valid();
			$check=1;
			  if($check=='false')
			  {
				  echo 'Check your url and api screate code before submiting';
			  }
	  }
	  
	  public function getService()
	  {
		  $this->load->model('model_test');
		 echo json_encode($this->model_test->getService());
	  }
	  
	  public function check_valid()
	  {
		 if($this->input->post('username')!='ApiUsername' && $this->input->post('ApiPassword')!='ApiPassword')
		 {
			 return true;
		 }
		 else
		 {
			 return true;
		 }
	  }
		
		
		
}