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
		 $this->load->model('model_object');
		 
        /* $verify=$this->model_auth->auth_controller();
		 if($verify==true)
		 {
			 redirect('auth_failed');
		 }
		 */
	  }
	  public function getuser()
	  {
		  ob_start('ob_gzhandler');
		     $data['request']="Success";
		     $data['data']=$this->model_object->getAllOrderArray('user','user_id');
		     $data['request_id']=1;
			 echo '<pre>';
		     print_r( json_encode($data));
			 echo '<pre>';
	  }
	  
	  public function getServiceById()
	  {
		  try
		  {
			  if($this->input->post("serviceId")){
				  
				 $data['request']="Error";
				 $data['data']=$this->model_object->getElementByIdWhere('service_request','service_request_id',$this->input->post("serviceId"));
				 $data['request_id']=0;
				 echo json_encode($data);
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
	  public function getService()
	  {
		try
		{
		//if($this->input->post("usertoken")){ 
		
		    $data['request']="Success";
		     $data['data']=$this->model_api->getService();
		     $data['request_id']=1;
			 //$data['data']=$data;
		     echo json_encode($data);
		/// echo json_encode();
		/*}
		else
		{
		     $data['request']="Error";
		     $data['data']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		}*/
	  }
		 catch (Exception $e)
		  {
		   $data['request']="Error";
		     $data['data']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		 }
	  }
	  public function send_notification()
	  {
		  //$user=$this->model_object->getAllByStatus('user');
				 
		// API access key from Google API's Console
		define( 'API_ACCESS_KEY', 'AIzaSyBRT7diAx_ip6dXhcS8DPlBg7Bwg0GuLhU' );
		$registrationIds = array( 'ea65Telb7dk:APA91bGD4UpSZpnHBL19QoAr_3wW1iJ-ZEeBq_lYC8TfAXzeFE0mg1z61o6wRNT7MpGwCMKydIozJbR9ekxi0m0MSJ4Th5dvmGWmft6cTBHa1MRinsvLd6iZXhRUTQ-kvBEBpb6FP7Xe' );
		// prep the bundle
		$msg = array
		(
			'message' 	=> 'here is a message. message',
			
		);
		$fields = array
		(
			'registration_ids' 	=> $registrationIds,
			'data'			=> $msg
		);
		 
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		 
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result;
	  }
	  public function getMyService()
	  {
		try
		{
		if($this->input->post("usertoken") && $this->input->post("user_id")){ 
		     $data['request']="Success";
		     $data['data']=$this->model_api->getMyService();
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
		  $target_path = dirname(__FILE__).'/uploads/';
		  if (isset($_FILES['image']['name'])) {
    $target_path = $target_path . basename($_FILES['image']['name']);
	move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
		  }
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
		 $services=$this->model_api->add_services();   
		 if($services)
		 {
			$data['request']="success";
			$data['message']="Services successfully added";
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
			$data['request']=true;
			$data['message']="User Exist";
			$data['request_id']=1;
			echo json_encode($data);  
		   }
		   else
		   {
			$data['request']=false;
			$data['message']="User not Exist";
			$data['request_id']=1;
			echo json_encode($data); 
		   }
		  }
		  else
		  {
			$data['request']=false;
			$data['message']="failed";
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
			$data['request']=true;
			$data['message']="Phone number Exist";
			$data['request_id']=1;
			echo json_encode($data);  
		   }
		   else
		   {
			$data['request']=false;
			$data['message']="Phone number not Exist";
			$data['request_id']=1;
			echo json_encode($data); 
		   }
		  }
		  else
		  {
			$data['request']=false;
			$data['message']="not";
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
			$data['request']=true;
			$data['message']="Email Exist";
			$data['request_id']=0;
			echo json_encode($data);  
		   }
		   else
		   {
			$data['request']=false;
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
			  if($this->input->post('suggestion'))
			  {
		    $city=$this->model_object->get_wildcard('city','city_id,city_name',"city_name like '%".$this->input->post('suggestion')."%'");
			$data['request']=true;
			$data['message']="Entered data wrong";
			$data['request_id']=1;
			$data['city']= $city;
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
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Entered data wrong";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  
	  public function cancel_service_token()
	  {
		  try
		  {
			  if($this->input->post('service_id') && $this->input->post('user_id'))
			  {
				  $check_valid=$this->model_object->getAllFromWhereParticular('service_request',"user_id=".$this->input->post('user_id')." and service_request_id=".$this->input->post('service_id')." and status=1","service_request_id");
				  if(count($check_valid)>0)
				  {
					  $token=$this->model_api->send_cancel_token();
					  $data['request']=true;
					  $data['message']="Token send Successfully";
					  $data['request_id']=0;
					  echo json_encode($data);
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);  
				  }
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function check_service_token()
	  {
		  try
		  {
			  if($this->input->post('service_id') && $this->input->post('user_id')  && $this->input->post('tokenId'))
			  {
				$check_valid=$this->model_object->getAllFromWhereParticular('cancel_service_token',"service_id=".$this->input->post('service_id')." and token=".$this->input->post('token'),"service_id");  
				if(count($check_valid)>0)
				{
					  $this->model_api->disable_service();
					  $data['request']=true;
					  $data['message']="Service Successfully Cancel";
					  $data['request_id']=1;
					  echo json_encode($data);  
				}
				else
				{
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);  
				}
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function placeBid()
	  {
		  try
		  {
			  if($this->input->post('service_id') && $this->input->post('user_id')  && $this->input->post('bibAmount') && $this->input->post('delivery'))
			  {
				  $placed=$this->model_api->placeBid();
				  if($placed)
				  {
					  $data['request']=true;
					  $data['message']="Bid Added Successfully";
					  $data['request_id']=1;
					  echo json_encode($data);
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);  
				  }
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);  
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function updateBid()
	  {
		 try
		  {
		 if($this->input->post('service_id') && $this->input->post('user_id')  && $this->input->post('bibAmount') && $this->input->post('delivery') && $this->input->post('bid_id'))
			  {
				  $placed=$this->model_api->updateBid();
				  if($placed)
				  {
					  $data['request']=true;
					  $data['message']="Bid Added Successfully";
					  $data['request_id']=1;
					  echo json_encode($data);
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);  
				  }
			  }
			else
			{
				$data['request']=false;
				$data['message']="Invalid Request";
				$data['request_id']=0;
				echo json_encode($data);  
			}
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  
	  public function withdrawBid()
	  {
		  try
		  {
			  if($this->input->post('bid_id') && $this->input->post('user_id') && $this->input->post('service_id'))
			  {
				$check_valid=$this->model_object->getAllFromWhereParticular('place_bids',"service_id=".$this->input->post('service_id')." and user_id=".$this->input->post('user_id')." and bid_id =".$this->input->post('bid_id'),"service_id");  
				if(count($check_valid)>0)
				{
					$check=$this->model_api->withdrawBidToken();
					if($check)
					{
						$data['request']=true;
				        $data['message']="Invalid Request";
				        $data['request_id']=0;
				        echo json_encode($data);
					}
					else
					{
						$data['request']=true;
				        $data['message']="Invalid Request";
				        $data['request_id']=0;
				        echo json_encode($data);
					}
				}
				else
				{
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);  
				}
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);  
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  
	  public function disable_bid()
	  {
		  try
		  {
			  if($this->input->post('service_id') && $this->input->post('user_id')   && $this->input->post('bid_id') && $this->input->post('token'))
			  {
				$check_valid=$this->model_object->getAllFromWhereParticular('place_bids',"bid_id=".$this->input->post('bid_id')." and token=".$this->input->post('token'),"service_id");  
				if(count($check_valid)>0)
				{
					  $this->model_api->disable_bid();
					  $data['request']=true;
					  $data['message']="Bid Successfully Withdraw";
					  $data['request_id']=1;
					  echo json_encode($data);  
				}
				else
				{
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);  
				}
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  } 
	  }
	  public function addCategoryNotification()
	  {
		 try
		 {
			 if($this->input->post('user_id') && $this->input->post('service_types'))
			 {
				$service_types=implode(',',$this->input->post('service_types'));
				$check=$this->model_object->getAllFromWhereParticular('service_notification',"user_id='".$this->input->post('user_id')."'","user_id");
				if($check)
				{
					$this->model_api->updateServiceNotification();
					$data['request']=true;
					$data['message']="Request Succesfull";
					$data['request_id']=1;
					echo json_encode($data);  
				}
				else
				{
					$this->model_api->insertServiceNotification();
					$data['request']=true;
					$data['message']="Request Succesfull";
					$data['request_id']=1;
					echo json_encode($data);  
				}
			 }
			 else
			 {
			    $data['request']=false;
				$data['message']="Invalid request";
				$data['request_id']=0;
				echo json_encode($data);  
			 }
		 }
		 catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid request";
			$data['request_id']=0;
			echo json_encode($data);  
		  } 
	  }
	  
	  public function viewMyWatchList()
	  {
		 try
		 {
			 if($this->input->post('user_id'))
			 {
				 $check=$this->model_api->viewMyWatchList();
				 if($check)
				 {
					  $data['request']=true;
					  $data['message']="successfull";
					  $data['request_id']=1;
					  $data['data']=$check;
					  echo json_encode($data);
				 }
				 else
				 {
					$data['request']=false;
					$data['message']="Invalid Request";
					$data['request_id']=0;
					echo json_encode($data);
				 }
			 }
			 else
			 {
			    $data['request']=false;
				$data['message']="Invalid Request";
				$data['request_id']=0;
				echo json_encode($data);  
			 }
		 }
		 catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function removeWatchList()
	  {
		  try
		  {
			  if($this->input->post('user_id') && $this->input->post('watchlist_id'))
			  {
				  $this->model_object->Delete('watchlist',$this->input->post('watchlist_id'));
				  $data['request']=true;
				  $data['message']="Remove successfully";
				  $data['request_id']=1;
				  echo json_encode($data);
				  
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid request";
				  $data['request_id']=0;
				  echo json_encode($data);  
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function addWatchList()
	  {
		  try
		  {
			  if($this->input->post('user_id') && $this->input->post('service_id') && $this->input->post('token'))
			  {
				  $check=$this->model_api->addWatchList();
				  if($check)
				  {
					  $data['request']=true;
		              $data['message']="Added Successfully";
			          $data['request_id']=0;
			          echo json_encode($data);  
				  }
				  else
				  {
					  $data['request']=false;
		              $data['message']="Invalid Request";
			          $data['request_id']=0;
			          echo json_encode($data);  
				  }
			  }
			  else
			  {
				  $data['request']=false;
		          $data['message']="Invalid Request";
			      $data['request_id']=0;
			      echo json_encode($data);  
				  
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function viewMyBids()
	  {
		  try
		  {
			  if($this->input->post('user_id'))
			  {
				  $get=$this->model_api->viewMyBids();
				  if(count($get)>0)
				  {
					  $data['request']=true;
					  $data['message']="Successfull";
					  $data['request_id']=1;
					  $data['bid_val']=$get;
					  echo json_encode($data); 
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data); 
				  }
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data); 
			  }
		  }
		 catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function ViewBidServiceExpire()
	  {
		  try
		  {
			  if($this->input->post('user_id') && $this->input->post('service_id'))
			  {
				  $get=$this->model_api->ViewBidServiceExpire();
				  if(count($get)>0)
				  {
					  $data['request']=true;
					  $data['message']="Successfull";
					  $data['request_id']=1;
					  $data['bid_val']=$get;
					  echo json_encode($data); 
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data); 
				  }
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data); 
			  }
		  }
		 catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  
	   /*Comment Section Start */
	  public function Comment()
	  {
		  try
		  {
			  if($this->input->post('user_comment_id') && $this->input->post('comment') && $this->input->post('post_id') && $this->input->post('type'))
			  {
				  $valid=$this->model_api->comment();
				  if($valid)
				  {
					  $data['request']=true;
					  $data['message']="Comment Placed Successfully";
					  $data['request_id']=1;
					  echo json_encode($data);
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);
				  }
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  
	  
	  public function UpdateComment()
	  {
		  try
		  {
			  if($this->input->post('user_comment_id') && $this->input->post('comment_id') && $this->input->post('comment'))
			  {
				  $valid=$this->model_api->comment(); 
				  if($valid)
				  {
					  $data['request']=true;
					  $data['message']="Update Successfully";
					  $data['request_id']=0;
					  echo json_encode($data);
				  }
				  else
				  {
					  $data['request']=false;
					  $data['message']="Invalid Request";
					  $data['request_id']=0;
					  echo json_encode($data);
				  }
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function DeleteComment()
	  {
		  try
		  {
			  if($this->input->post('user_comment_id') && $this->input->post('comment_id'))
			  {
				  $this->model_api->DeleteWhere('comment','comment_id',$this->input->post('comment_id'));
				  $data['request']=true;
				  $data['message']="Delete Successfully";
				  $data['request_id']=0;
				  echo json_encode($data);  
				  
			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);  
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	  public function ReportSpam()
	  {
		  try
		  {
			  if($this->input->post('comment_id') && $this->input->post('user_id'))
			  {
				  $spam=$this->model_api->ReportSpam();
				  if($spam){
				  $data['request']=true;
				  $data['message']="Successfully done";
				  $data['request_id']=1;
				  echo json_encode($data); 
				  }
				  else
				  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data);   
				  }

			  }
			  else
			  {
				  $data['request']=false;
				  $data['message']="Invalid Request";
				  $data['request_id']=0;
				  echo json_encode($data); 
			  }
		  }
		  catch (Exception $e)
		  {
			$data['request']=false;
			$data['message']="Invalid Request";
			$data['request_id']=0;
			echo json_encode($data);  
		  }
	  }
	   /*Comment Section End */
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
