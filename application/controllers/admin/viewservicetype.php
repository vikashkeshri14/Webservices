<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Viewservicetype extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_servicetype');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 $data['servicetype'] = $this->model_servicetype->getservicetypes();
		 $data["title"]="Service Type List";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/viewservicetype',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	  public function addservicetype()
	  {
		  
		  if($this->uri->segment(4))
		  {
			  
			  $data['servicetype']=$this->model_servicetype->getservicetypesbyid($this->uri->segment(4));
			  //print_r(  $data['servicetype']);
			  //exit;			  
		  }
		  else
		  {
			  $data['servicetype']='';
		  }
		  if($this->input->post('name'))
		  {
			  if($this->uri->segment(4))
		      {
				  $this->model_servicetype->updateservicetype($this->uri->segment(4));
			  }
			  else
			  {
			  $this->model_servicetype->createservicetype();
			  }
			  redirect('admin/viewservicetype');
		  }
	
		 //$data['servicetype'] = $this->model_servicetype->getservicetypes();
		 $data["title"]="Create Service type";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/addservicetype',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	  
	  public function delete()
	  {
		  $this->model_servicetype->deleteservicetypes($this->uri->segment(4));
		  redirect('admin/viewservicetype');
	  }
}