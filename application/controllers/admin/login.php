<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_login');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 
		  if($this->input->post())
		  {
			 // Validate the user can login
        $result = $this->model_login->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $this->index();
        }else{
            // If user did validate, 
            // Send them to members area
            redirect('home');
        }        // echo $this->input->post('username');
		  }
		 $data["title"]="Login Page";
		 //$this->load->view('admin/common/header',$data);
		 //$this->load->view('admin/common/left_menu');
		 $this->load->view('admin/login',$data);
		// $this->load->view('admin/common/footer');
		// echo 'hi';exit;
		
        
		 
	  }
}