<?php
class Model_api extends CI_Model {

  public function __construct()
  {
	parent::__construct();
	$this->load->helper('url');	
	$this->load->database();		
  }
  public function getService()
  {
	$query=$this->db->query("select *from service_request where status=1");
	return $query->result();
  }
  public function getMyService()
  {
	$query=$this->db->query("select *from service_request where status=1 and user_id=".$this->input->post('user_id'));
	return $query->result();
  }
  public function editAccount()	
  {
   if($this->input->post('tokenId') && $this->input->post('user_id'))
	{
	  $password=$this->password_encrypt($this->input->post('password'));
	  $upd['email_id']=$this->input->post('email_id');
	  $upd['phone_no']=$this->input->post('phone_no');
	  $upd['password']=$password;
	  
	  if($this->input->post('iqama_id'))
	  $upd['iqama_id']=$this->input->post('iqama_id');
	  if($this->input->post('mobile_token'))
	  $upd['comercial_registration']=$this->input->post('comercial_registration');
	  if($this->input->post('city'))
	  $upd['city']=$this->input->post('city');
	  if($this->input->post('country'))
	  $upd['city']=$this->input->post('country');
	  $this->db->where('user_id', $this->input->post('user_id')); 
	  $this->db->update('user', $upd); 
	  
	  return true;
	  //sms code is here
	}
	else
	{
		return false;
	}
	
  }
  public function registration()
  {
	$created=date('Y-m-d h:i:s');
	if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no') && $this->input->post('role_id') &&  $this->input->post('password'))
	{
	  $password=$this->password_encrypt($this->input->post('password'));
	  $ins['username']=$this->input->post('username');
	  $ins['email_id']=$this->input->post('email_id');
	  $ins['phone_no']=$this->input->post('phone_no');
	  $ins['role_id']=$this->input->post('role_id');
	  $ins['password']=$password;
	  if($this->input->post('user_token'))
	  $ins['user_token']=$this->input->post('user_token');
	  if($this->input->post('iqama_id'))
	  $ins['iqama_id']=$this->input->post('iqama_id');
	  if($this->input->post('comercial_registration'))
	  $ins['comercial_registration']=$this->input->post('comercial_registration');
	  if($this->input->post('city'))
	  $ins['city']=$this->input->post('city');
	  $ins['created']=$created;
	  $this->db->insert('user', $ins); 
	  $insert_id = $this->db->insert_id();
	 // $time=rand(1000,9999);
	  $email_token=$this->token();
	  $token_email['email_token']=$email_token;
	  $token_email['user_id']=$insert_id;
	  $token_email['created']=$created;
      $this->db->insert('email_token', $token_email); 
	 // mail("vkeshri.14@gmail.com","Verification token","Your token id is ".$email_token.", this is valid for 10min");
	  $mobile_token=$this->token();
	  $token_phone['mobile_token']=$mobile_token;
	  $token_phone['user_id']=$insert_id;
	  $token_phone['created']=$created;
      $this->db->insert('mobile_token', $token_phone); 
	  return true;
	  //sms code is here
	}
	else
	{
		return false;
	}
	
  }
  
  public function password_encrypt($pass)
  {
	  $options = [
    'cost' => 11
    ];
    return password_hash($pass, PASSWORD_BCRYPT, $options);
  }
  
  
  public function token()
  {
	  return rand(1000,9999);
  }
  
public function check_email_token()
  {
	  if($this->input->post("email_token") && $this->input->post("user_id"))  
		 {

			 $query=$this->db->query(" select * from email_token where email_token='".$this->input->post("email_token")."' and user_id='".$this->input->post("user_id")."' order by email_token_id desc limit 1");
			 $value=$query->result();
		 }
return $value;
  }
  
  public function check_mobile_token()
  {
	  if($this->input->post("mobile_token") && $this->input->post("user_id"))  
		 {
			 $query=$this->db->query(" select * from mobile_token where mobile_token='".$this->input->post("mobile_token")."' and user_id='".$this->input->post("user_id")."' order by token_id desc limit 1");
			 $value=$query->result();
		 }
return $value;
  }

public function update_email_token($id)
  {
	  $upd['status']=2;
	  $this->db->where('email_token_id', $id); 
	  $this->db->update('email_token', $upd); 
  }
  
  public function update_mobile_token($id)
  {
      $upd['status']=2;
	  $this->db->where('token_id', $id); 
	  $this->db->update('mobile_token', $upd); 
	  
  }




  public function login_check()
  {
	   if($this->input->post('username') && $this->input->post('password'))
	   {
		   $query=$this->db->query("select * from user where  username='".trim($this->input->post('username'))."'");
		   $value=$query->result();
		   if($value){
		    $check_password=$this->password_verify($this->input->post('password'),$value[0]->password);
			if($check_password)
			{
				return true;
			}
			else
			{
				return false;
			}
		   }
		   else
		   {
			   return false;
		   }
	   }
	   else
	   {
		   return false;
	   }
  }
  public function change_password()
  {
      if($this->input->post('user_id') && $this->input->post('usertoken'))
      {
	  $query=$this->db->query("select * from user where  user_id='".$this->input->post('user_id')."'");
		   $value=$query->result();
		   if($value){
		    $check_password=$this->password_verify($this->input->post('oldpassword'),$value[0]->password);
			if($check_password)
			{
				$password=$this->password_encrypt($this->input->post('newpassword'));
				$upd['password']=$password;
				$this->db->where('user_id',$this->input->post('user_id'));
				$this->db->update('user',$upd);
				return true;
			}
			else
			{
				return false;
			}    
		   }
	      else
	      {
		      return false;
	      }
      }
	      else
	      {
		      return false;
	      }
  }
  public function password_verify($password,$hash)
  {
	 // $hash = '$2y$11$b1Kblxw5UH6xojHn09z9HONcs/IYpzegWhxjsK3vx61eWeeSwdAves';

		if (password_verify($password, $hash)) {
			return true;
		} else {
			return false;
		}
  }
  public function send_email_token($val)
  {
	  $query=$this->db->query("select *from user where email_id='".$val."'");
	  $value=$query->result();
	  return $value;
  }
  public function send_mobile_token($val)
  {
	  $query=$this->db->query("select *from user where phone_no='".$val."'");
	  $value=$query->result();
	  return $value;
  }
  public function send_cancel_token()
  {
	  $cancel_token=$this->token();
	  $created=date('Y-m-d h:i:s');
	  $ins['service_id']=$this->input->post('service_id');
	  $ins['token']=$cancel_token;
	  $ins['created']=$created;
	  $this->db->insert('cancel_service_token', $ins); 
	  //sms code goes here
	  
	  
	  return $value;
  }
  public function withdrawBidToken()
  {
	  if($this->input->post('bid_id')){
      $cancel_token=$this->token();
	  $ins['token']=$cancel_token;
	  $this->db->where('bid_id',$this->input->post('bid_id'));	
	  $this->db->update('place_bids',$ins);   
	  
	  //sms to phone here
	  
	  return true;
	  }
	  else
	  {
		  return false;
	  }
  }
  public function disable_service()
  {

	  $ins['status']=2;
	  $this->db->where('service_request_id',$this->input->post('service_id'));	
	  $this->db->update('service_request',$ins); 
  }
  
  public function disable_bid()
  {
	  $ins['status']=0;
	  $this->db->where('bid_id',$this->input->post('bid_id'));	
	  $this->db->update('place_bids',$ins); 
  }
  public function addWatchList()
  {
	  if($this->input->post('user_id') && $this->input->post('service_id') && $this->input->post('token'))
	  {
		  $created=date('Y-m-d h:i:s');
		  $ins['user_id']=$this->input->post('user_id');
		  $ins['service_id']=$this->input->post('service_id');
		  $ins['created']=$created;
		  $this->db->insert('watchlist', $ins);  
		  return true;
	  }
	  else
	  {
		  return false;
	  }
  }
  public function placeBid()
  {
	   if($this->input->post('service_id') && $this->input->post('user_id')  && $this->input->post('bibAmount') && $this->input->post('delivery'))
	   {
		    $created=date('Y-m-d h:i:s');
		    $ins['service_id']=$this->input->post('service_id');
			$ins['user_id']=$this->input->post('user_id');
			$ins['bid_amount ']=$this->input->post('bibAmount');
			$ins['delivery']=$this->input->post('delivery');
			if($this->input->post('qualification'))
			$ins['qualification']=$this->input->post('qualification');
			if($this->input->post('description'))
			$ins['description']=$this->input->post('description');
			$ins['created']=$created;
	        $this->db->insert('place_bids', $ins);  
		   return true;
	   }
	   else
	   {
		   return false;
	   }
  }
  
  public function updateBid()
  {
	   if($this->input->post('service_id') && $this->input->post('user_id')  && $this->input->post('bibAmount') && $this->input->post('delivery') && $this->input->post('bid_id'))
	   {
			$upd['bid_amount ']=$this->input->post('bibAmount');
			$upd['delivery']=$this->input->post('delivery');
			if($this->input->post('qualification'))
			$upd['qualification']=$this->input->post('qualification');
			if($this->input->post('description'))
			$upd['description']=$this->input->post('description');
		    $this->db->where('bid_id',$this->input->post('bid_id'));
	        $this->db->update('place_bids', $upd); 
		    return true;
	   }
	   else
	   {
		   return false;
	   }
  }
  public function add_services()	
  {
   if($this->input->post('tokenId') && $this->input->post('user_id'))
	{
	  //$password=$this->password_encrypt($this->input->post('password'));
	  $ins['tittle']=$this->input->post('tittle');
	  if($this->input->post('expiry_date'))
	  $ins['expiry_date']=$this->input->post('expiry_date');
	  if($this->input->post('delivery'))
	  $ins['delivery']=$this->input->post('delivery');
	  if($this->input->post('description'))
	  $ins['description']=$this->input->post('description');
	  if($this->input->post('skill'))
	  $ins['skill']=$this->input->post('skill');
	  if($this->input->post('category'))
	  $ins['service_types']=$this->input->post('category');
	  if($this->input->post('attachment'))
	  $ins['attachment']=$this->input->post('attachment');
	  $ins['user_id']=$this->input->post('user_id');
	  
	  $this->db->insert('service_request', $ins); 
	  
	  return true;
	  //sms code is here
	}
	else
	{
		return false;
	}
	
  }
  public function upd_services()	
  {
   if($this->input->post('tokenId') && $this->input->post('user_id'))
	{
	  //$password=$this->password_encrypt($this->input->post('password'));
	  $upd['tittle']=$this->input->post('tittle');
	  if($this->input->post('expiry_date'))
	  $upd['expiry_date']=$this->input->post('expiry_date');
	  if($this->input->post('delivery'))
	  $upd['delivery']=$this->input->post('delivery');
	  if($this->input->post('description'))
	  $upd['description']=$this->input->post('description');
	  if($this->input->post('skill'))
	  $upd['skill']=$this->input->post('skill');
	  if($this->input->post('category'))
	  $upd['service_types']=$this->input->post('category');
	  if($this->input->post('attachment'))
	  $upd['attachment']=$this->input->post('attachment');
	 
	  $this->db->where('service_request_id',$this->input->post('service_request_id'));
	  
	  $this->db->update('service_request', $upd); 
	  
	  return true;
	  //sms code is here
	}
	else
	{
		return false;
	}
	
  }
  
  public function extend_services()	
  {
   if($this->input->post('tokenId') && $this->input->post('user_id'))
	{
	  
	  $upd['expiry_date']=$this->input->post('expiry_date');
	 
	  $this->db->where('service_request_id',$this->input->post('service_request_id'));
	  
	  $this->db->update('service_request', $upd); 
	  
	  return true;
	  //sms code is here
	}
	else
	{
		return false;
	}
	
  }
  
}
