<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Addcity extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_city');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 
		 $data["title"]="Create City";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/addcity',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
}