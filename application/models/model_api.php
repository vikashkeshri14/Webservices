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
	$query=$this->db->query("select *from service_request");
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
	  if($this->input->post('mobile_token'))
	  $ins['mobile_token']=$this->input->post('mobile_token');
	  if($this->input->post('mobile_token'))
	  $ins['iqama_id']=$this->input->post('iqama_id');
	  if($this->input->post('mobile_token'))
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
  public function send_email_token($val)
  {
	  $query=$this->db->query("select *from user where phone_no='".$val."'");
	  $value=$query->result();
	  return $value;
  }
	
  
}
