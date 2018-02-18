<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Viewservicerequest extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_user');
		  $this->load->model('model_servicerequest');
		 $this->load->model('model_country');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 $data['servicerequest'] = $this->model_servicerequest->getservicerequest();
		
		 $data["title"]="Service Request List";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/viewservicerequest',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
		 
	  }
	  
	  
	  public function delete()
	  {
		  $this->model_servicerequest->deleteservicerequest($this->uri->segment(4));
		  redirect('admin/viewservicerequest');
	  }
	  public function disable()
	  {
		  $this->model_servicerequest->enabledisableservicerequest($this->uri->segment(4),2);
		  redirect('admin/viewservicerequest');
	  }
	  public function enable()
	  {
		  $this->model_servicerequest->enabledisableservicerequest($this->uri->segment(4),1);
		  redirect('admin/viewservicerequest');
	  }
}