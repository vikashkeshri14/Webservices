<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	  public function __construct()
	  {
		 parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		// $this->check_isvalidated();
			//  $check=$this->check_valid();
			$check=1;
			  if($check=='false')
			  {
				  echo 'Check your url and api screate code before submiting';
			  }
	  }
	  
	  public function index()
	  {
		 $data["title"]="home";
		 //echo 'Congratulations, you are logged in.';
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/dashboard');
		 $this->load->view('admin/common/footer');
		 
	  }
	  private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
}