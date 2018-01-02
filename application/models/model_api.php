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
	  $token_email=$this->token();
	  $token_email['email_token']=$token_email;
	  $token_email['user_id']=$insert_id;
	  $token_email['created']=$created;
      $this->db->insert('email_token', $token_email); 
	  mail("vkeshri.14@gmail.com","Verification token","Your token id is ".$token_email.", this is valid for 10min");
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
  
  public function password_verify()
  {
	  $hash = '$2y$11$b1Kblxw5UH6xojHn09z9HONcs/IYpzegWhxjsK3vx61eWeeSwdAves';

		if (password_verify('vikash', $hash)) {
			return true;
		} else {
			return false;
		}
  }
  public function token()
  {
	  return rand(1000,9999);
  }
  public function check_email_token()
  {
	  if($this->input->post("email_token") && $this->input->post("user_id"))  
		 {
			 
		 }
  }

}