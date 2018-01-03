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
		try
		{
		if($this->input->post("usertoken")){ 
		    $data['request']="Success";
		     $data['data']=$this->model_test->getService();
		     $data['request_id']=1;
		     echo json_encode($data);
		// echo json_encode();
		}
		else
		{
		     $data['request']="Error";
		     $data['data']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		}
	  }
		 catch (Exception $e)
		  {
		   $data['request']="Error";
		     $data['data']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		 }
	  }
	  public function editAccount
	  {
		try
		{
		if($this->input->post('tokenId') && $this->input->post('user_id'))
			{
				$res=$this->model_api->editAccount();  
		        }
		else
		    {
		     $data['request']="Error";
		     $data['message']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		    }
		}
	     catch (Exception $e)
		  {
		     $data['request']="Error";
		     $data['message']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		  }
	  }
	
	  public function  registration()
	  {
		try
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
		  catch (Exception $e)
		  {
			$data['request']="Error";
			$data['message']="Check your request";
			$data['request_id']=0;
			echo json_encode($data);    
		  }
	  }
	 
	  public function check_token()
	  {
		try
		{
		if($this->input->post("email_token") && $this->input->post("mobile_token") && $this->input->post("user_id"))  
		 {
			$email_token=$this->model_api->check_email_token(); 
			$mobile_token=$this->model_api->check_mobile_token();
			if($email_token && $mobile_token)
			{
				$date=date('Y-m-d h:i:s');
				$min_email=$email_token[0]->created;
				$min_phone=$mobile_token[0]->created;
				$registration_date = date_create($date); //Replace static date with your database field
				$expiration_date = date_create($min_email); //Replace static date with your database field
				$email=date_diff($registration_date,$expiration_date);
				$email_min=$email->format("%i");
				$registration_date_phone = date_create($date); //Replace static date with your database field
				$expiration_date_phone = date_create($min_phone); //Replace static date with your database field
				$phone=date_diff($registration_date_phone,$expiration_date_phone);
                $phone_min=$phone->format("%i");
				if($email_min<=10)
				{
				  $data['request']="Error";
				  $data['message']="Verification code does not match";
				  $data['request_id']=0;
				  echo json_encode($data);
				}
				elseif($phone_min<=10)
				{
				  $data['request']="Error";
				  $data['message']="Verification code does not match";
				  $data['request_id']=0;
				  echo json_encode($data);

				}
				else
				{
				  $data['request']="Success";
				  $data['message']="Verification code match";
				  $data['request_id']=1;
				  echo json_encode($data);
				}
			}
			else
			{
				$data['request']="Error";
				$data['message']="Verification code does not match";
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
		catch (Exception $e)
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
	  
	  public function login()
	  {
		  try
		  {
		  if($this->input->post('username') && $this->input->post('password'))
		  {
			  $valid=$this->model_api->login_check();
		  }
		  else
		  {
			$data['request']="Error";
			$data['message']="Username or password entered wrong";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
		  }
		  catch (Exception $e)
		  {
			$data['request']="Error";
			$data['message']="Username or password entered wrong";
			$data['request_id']=0;
			echo json_encode($data);  
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
