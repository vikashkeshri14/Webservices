<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_failed extends CI_Controller {
		
		
public function __construct()
    {
         parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');	
    }
public function index()
  {
	         $data['request']="Error";
		     $data['data']="Authentication failed";
		     $data['request_id']=0;
			 echo json_encode($data);
	 
  }
}
