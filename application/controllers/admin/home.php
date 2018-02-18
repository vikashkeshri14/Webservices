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
		 	 $this->load->model('model_dashboard');
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
		 
		 $data['ActiveSR'] = $this->model_dashboard->getactivesr();
		 $data['BlockSR'] = $this->model_dashboard->getblocksr();
		 
		  $data['ActiveSP'] = $this->model_dashboard->getactivesp();
		  $data['BlockSP'] = $this->model_dashboard->getblocksp();
		  
		  $data['ActiveSA'] = $this->model_dashboard->getactivesa();
		  $data['BlockSA'] = $this->model_dashboard->getblocksa();
		  
		  $data['newlyaddedrequestcount']=count($this->model_dashboard->getnewrequest());
		   $data['inprogresscount']=count($this->model_dashboard->getinprogresrequest());
		  $data['expiredrequestcount']=count($this->model_dashboard->getExpiredrequest());
		  $data['Completerequestcount']=count($this->model_dashboard->getCompletedrequest());
		  
		  
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
