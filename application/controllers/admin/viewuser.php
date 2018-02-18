<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Viewuser extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
		 $this->load->model('model_user');
		  $this->load->model('model_city');
		 $this->load->model('model_country');
		  $this->load->model('model_common');
		// $check=$this->check_valid();
			
	  }
	  
	  public function index()
	  {
		 $data['user'] = $this->model_user->getusers();
		 $data["title"]="User List";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/viewuser',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;
        
		 
	  }
	  public function adduser()
	  {		  
		  if($this->uri->segment(4))
		  {
			  $data['user']=$this->model_user->getuserbyid($this->uri->segment(4));			  
		  }
		  else
		  {
			  $data['user']='';
		  }
		 /* if($this->input->post('username') && $this->input->post('	password')
		  && $this->input->post('country') && $this->input->post('city'))*/
		  if($this->input->post('username'))
		  {
			  if($this->uri->segment(4))
		      {
				  $this->model_user->updateuser($this->uri->segment(4));
			  }
			  else
			  {
			  $this->model_user->createuser();
			  }
			  redirect('admin/viewuser');
		  }
		  $data['country'] = $this->model_country->getcountries();
		  $data['city'] = $this->model_city->getcities();
		  $data['roleid'] = $this->model_common->getroles();
		  
		 $data["title"]="Create User";
		 $this->load->view('admin/common/header',$data);
		 $this->load->view('admin/common/left_menu');
		 $this->load->view('admin/adduser',$data);
		 $this->load->view('admin/common/footer');
		// echo 'hi';exit;       
		 
	  }
	  
	  public function delete()
	  {
		  $this->model_user->deleteRecord($this->uri->segment(4));
		  redirect('admin/viewuser');
	  }
}