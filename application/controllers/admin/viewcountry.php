<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Viewcountry extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_country');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 $data['country'] = $this->model_country->getcountries();
		 $data["title"]="Country List";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/viewcountry',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	  public function addcountry()
	  {
		  
		  if($this->uri->segment(4))
		  {
			  $data['country']=$this->model_country->getcountriesbyid($this->uri->segment(4));			  
		  }
		  else
		  {
			  $data['country']='';
		  }
		  if($this->input->post('name'))
		  {
			  if($this->uri->segment(4))
		      {
				  $this->model_country->updatecountry($this->uri->segment(4));
			  }
			  else
			  {
			 $this->model_country->createcountry();
			  }
			  redirect('admin/viewcountry');
		  }
		  
		   
		 $data["title"]="Create Country";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/addcountry',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	   public function delete()
	  {
		  $this->model_country->deletecountry($this->uri->segment(4));
		  redirect('admin/viewcountry');
	  }
}