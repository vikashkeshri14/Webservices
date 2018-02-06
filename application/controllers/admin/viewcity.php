<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Viewcity extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_city');
		 $this->load->model('model_country');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 $data['city'] = $this->model_city->getcities();
		 $data["title"]="City List";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/viewcity',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	  public function addcity()
	  {
		  
		  if($this->uri->segment(4))
		  {
			  $data['city']=$this->model_city->getElementById($this->uri->segment(4));			  
		  }
		  else
		  {
			  $data['city']='';
		  }
		  if($this->input->post('city_name') && $this->input->post('country_id'))
		  {
			  if($this->uri->segment(4))
		      {
				  $this->model_city->updatecity($this->uri->segment(4));
			  }
			  else
			  {
			  $this->model_city->createcity();
			  }
			  redirect('admin/viewcity');
		  }
	
		 $data['country'] = $this->model_country->getcountries();
		 $data["title"]="Create City";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/addcity',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	  
	  public function delete()
	  {
		  $this->model_city->deletecity($this->uri->segment(4));
		  redirect('admin/viewcity');
	  }
}