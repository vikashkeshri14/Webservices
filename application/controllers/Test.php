<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {
		
		
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
	  
	  $this->load->view('test');
	  $get_service= $this->model_test->getService();
	  print_r($get_service);
  }
}
