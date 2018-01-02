<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

	  public function __construct()
	  {
		  parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_test');
		 $this->load->model('model_api');
			//  $check=$this->check_valid();
			$check=1;
			  if($check=='false')
			  {
				  echo 'Check your url and api screate code before submiting';
			  }
	  }
	  
	  public function getService()
	  {
		  
		 echo json_encode($this->model_test->getService());
	  }
	  public function  registration()
	  {
		  if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no') && $this->input->post('role_id'))
		  {
			  $res=$this->model_api->registration();
			  if($res)
			  {
				  $data['request']="Success";
				  $data['message']="Data inserted into the system. Please check the email and phone to verify your identity";
				  $data['request_id']=1;
				  echo json_encode($data);
			  }
			  else
			  {
				  $data['request']="Error";
				  $data['message']="Check your request";
				  $data['request_id']=0;
				  echo json_encode($data); 
			  }
		  }
		  else
		  {
			$data['request']="Error";
			$data['message']="Check your request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function check_valid()
	  {
		 if($this->input->post('username')!='ApiUsername' && $this->input->post('ApiPassword')!='ApiPassword')
		 {
			 return true;
		 }
		 else
		 {
			 return true;
		 }
	  }
	  public function check_password()
	  {
		echo  $this->model_api->password_encrypt('vikash');
	  }
	   public function verify_password()
	  {
		echo  $this->model_api->password_verify();
	  }
	  public function get_rand()
	  {
		  echo $this->model_api->token();
		  echo '<br>';
		  echo $this->model_api->token();
	  }
		
		
		
}