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
	  	 $this->load->model('model_auth');
		 echo '<pre>';
         print_r($this->input->request_headers());exit;
         $verify=$this->model_auth->auth_controller();
		 if($verify==false)
		 {
			 redirect('auth_failed');
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
		/// echo json_encode();
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
	  public function editAccount()
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
	 public function  test()
{

		     $data['request']=false;
		     $data['message']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
}
	  public function  registration()
	  {
		try
		{
			if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no'))
			{
				$res=$this->model_api->registration();
				if($res)
				{
					$data['request']=true;
					$data['message']="Data inserted into the system. Please check the email and phone to verify your identity";
					$data['request_id']=1;
					echo json_encode($data);
				}
				else
				{
					$data['request']=false;
					$data['message']="Check your request";
					$data['request_id']=0;
					echo json_encode($data); 
				}
			}
		  else
		  {
			$data['request']=false;
			$data['message']="Check your request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
		}
		  catch (Exception $e)
		  {
			$data['request']=false;
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
		 {//echo 'hiss';
			$email_token=$this->model_api->check_email_token(); 
			$mobile_token=$this->model_api->check_mobile_token();
//print_r($email_token);
			if($email_token && $mobile_token)
			{
//echo 'hi';
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
				if($email_min>=30)
				{
				  $data['request']=false;
				  $data['message']="Verification code does not match";
				  $data['request_id']=0;
				  echo json_encode($data);
				}
				elseif($phone_min>=30)
				{
				  $data['request']=false;
				  $data['message']="Verification code does not match";
				  $data['request_id']=0;
				  echo json_encode($data);

				}
				else
				{
                                  $email_token=$this->model_api->update_email_token($email_token[0]->email_token_id); 
			          $mobile_token=$this->model_api->update_mobile_token($mobile_token[0]->token_id);
				  $data['request']=true;
				  $data['message']="Verification code match";
				  $data['request_id']=1;
				  echo json_encode($data);
				}
			}
			else
			{
				$data['request']=false;
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
	  public function change_password()
	  {
	     try{
              if($this->input->post('user_id') && $this->input->post('usertoken'))
	      {
		 $pass=$this->model_api->change_password();   
		 if($pass)
		 {
			$data['request']="success";
			$data['message']="Password successfully updated";
			$data['request_id']=1;
			echo json_encode($data); 
		 }
		 else
		 {
			$data['request']="Error";
			$data['message']="Entered data wrong";
			$data['request_id']=0;
			echo json_encode($data); 
		 }
	      }
	     }
            catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Entered data wrong";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function reset_password()
	  {
		try
		{
			if($this->input->post('value'))
			{
				if (filter_var($this->input->post('value'), FILTER_VALIDATE_EMAIL)) {
                                  $valid=$this->model_api->send_token_email($this->input->post('value'));
				       if($valid)
				       {
					    $data['request']=true;
			                    $data['message']="Entered data wrong";
			                    $data['request_id']=1;
					    $data['data']=$valid;
			                    echo json_encode($data);   
				       }
				       else
				       {
					    $data['request']=false;
			                    $data['message']="Entered data wrong";
			                    $data['request_id']=0;
			                    echo json_encode($data);     
				       }
						
                                } else {
                                  $valid=$this->model_api->send_token_phone($this->input->post('value'));
				      if($valid)
				       {
					    $data['request']=true;
			                    $data['message']="Entered data wrong";
					    $data['data']=$valid;
			                    $data['request_id']=1;
			                    echo json_encode($data);   
				       }
				       else
				       {
					    $data['request']=false;
			                    $data['message']="Entered data wrong";
			                    $data['request_id']=0;
			                    echo json_encode($data);     
				       }
                                }

			}
			else
			{
				$data['request']=false;
			        $data['message']="Entered data wrong";
			        $data['request_id']=0;
			        echo json_encode($data);  
			}
		}
		catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Entered data wrong";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function add_services()
	  {
		   try{
              if($this->input->post('user_id') && $this->input->post('usertoken'))
	      {
		 $pass=$this->model_api->change_password();   
		 if($pass)
		 {
			$data['request']="success";
			$data['message']="Password successfully updated";
			$data['request_id']=1;
			echo json_encode($data); 
		 }
		 else
		 {
			$data['request']="Error";
			$data['message']="Entered data wrong";
			$data['request_id']=0;
			echo json_encode($data); 
		 }
	      }
	     }
            catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Entered data wrong";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function check_user()
	  {
		  if($this->input->post('username')){
		   $check=$this->model_object->getAllFromWhereParticular('user',"username='".$this->input->post('username')."'","user_id");
		   if($check)
		   {
			$data['request']=false;
			$data['message']="User Exist";
			$data['request_id']=0;
			echo json_encode($data);  
		   }
		   else
		   {
			$data['request']=true;
			$data['message']="User not Exist";
			$data['request_id']=1;
			echo json_encode($data); 
		   }
		  }
		  else
		  {
			$data['request']=false;
			$data['message']="User Exist";
			$data['request_id']=0;
			echo json_encode($data); 
		  }
	  }
	  public function check_mobile()
	  {
		  if($this->input->post('mobile')){
		   $check=$this->model_object->getAllFromWhereParticular('user',"phone_no ='".$this->input->post('mobile')."'","user_id");
		   if($check)
		   {
			$data['request']=false;
			$data['message']="Phone number Exist";
			$data['request_id']=0;
			echo json_encode($data);  
		   }
		   else
		   {
			$data['request']=true;
			$data['message']="Phone number not Exist";
			$data['request_id']=1;
			echo json_encode($data); 
		   }
		  }
		  else
		  {
			$data['request']=false;
			$data['message']="Phone number Exist";
			$data['request_id']=0;
			echo json_encode($data); 
		  }
	  }
	  public function check_email()
	  {
		  if($this->input->post('email')){
		   $check=$this->model_object->getAllFromWhereParticular('user',"email_id='".$this->input->post('email')."'","user_id");
		   if($check)
		   {
			$data['request']=false;
			$data['message']="Email Exist";
			$data['request_id']=0;
			echo json_encode($data);  
		   }
		   else
		   {
			$data['request']=true;
			$data['message']="Email not Exist";
			$data['request_id']=1;
			echo json_encode($data); 
		   }
		  }
		  else
		  {
			$data['request']=false;
			$data['message']="Email Exist";
			$data['request_id']=0;
			echo json_encode($data); 
		  }
	  }
	  public function getsuggessation()
	  {
		  try
		  {
		  $city=$this->model_object->getAllOrder('city','city_id');
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Entered data wrong";
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
