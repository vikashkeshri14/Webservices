<?php
class Model_Api extends CI_Model {

  public function __construct()
  {
	parent::__construct();
	$this->load->helper('url');	
	$this->load->database();		
  }
  public function getService()
  {
	$query=$this->db->query("select s.service_request_id,s.user_id,s.title,s.delivery,s.attachment,u.username,st.name as service_name , CONCAT( FLOOR(HOUR(TIMEDIFF(now(), s.expiry_date)) / 24), ' days ', MOD(HOUR(TIMEDIFF(now(), s.expiry_date)), 24), ' hr ', MINUTE(TIMEDIFF(now(), s.expiry_date)), ' min') as expiry from service_request as s,user as u,service_types as st where s.status=1 and s.user_id=u.user_id and s.service_types=st.type_id ORDER BY s.service_request_id");
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
	  $password=md5($this->input->post('password'));
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
	  //$email_token=$this->token();
$email_token='1234';
	  $token_email['email_token']=$email_token;
	  $token_email['user_id']=$insert_id;
	  $token_email['created']=$created;
          $this->db->insert('email_token', $token_email); 

	  mail("vkeshri.14@gmail.com","Verification token Code","Your token id is ".$email_token.", this is valid for 30min");
	  
          //$mobile_token=$this->token();
$mobile_token='1234';
	  $token_phone['mobile_token']=$mobile_token;
	  $token_phone['user_id']=$insert_id;
	  $token_phone['created']=$created;
          $this->db->insert('mobile_token', $token_phone); 
	  return $insert_id;
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
public function update_user($id)
  {
          $upd['status']='1';
$upd['email_token_verify']='1';
$upd['phone_token_verify']='1';
	  $this->db->where('user_id', $id); 
	  $this->db->update('user', $upd); 
return true;
	  
  }

public function valid_token()
  {
	  if($this->input->post("token") && $this->input->post("bidId") && $this->input->post('service_id'))  
		 {

			 $query=$this->db->query("select * from acceptbidtoken where token='".$this->input->post("token")."' and bid_id='".$this->input->post("bidId")."' and service_id='".$this->input->post("service_id")."' order by id desc limit 1");
			 $value=$query->result();
		 }
   return $value;
  }
public function updateAcceptBid($id)
  {
      $upd['status']=1;
	  $this->db->where('bid_id', $id); 
	  $this->db->update('place_bids', $upd); 
	  
  }
  public function addplacedBidToken()
  {
	  if($this->input->post('token') && $this->input->post('bidId') && $this->input->post('service_id'))
	  {
	  }
  }
  public function login_check()
  {
	   if($this->input->post('username') && $this->input->post('password'))
	   {
		   $query=$this->db->query("select * from user where  username='".trim($this->input->post('username'))."' and password='".md5($this->input->post('password'))."' ");
		   $value=$query->result();
		   if($value){
			return $value;
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
  public function viewMyBids()
  {
	  $query=$this->db->query("select s.title as service_title,p.description as desc,p.bid_amount as amount,p.bid_id as bid_id,p.created as bidDate from service_request as s, place_bids as p where s.service_request_id=p.service_id and p.user_id='".$this->input->post('user_id')."' order by p.created desc");
	  
	  return $query->result_array();
  }
  
  public function ViewBidServiceExpire()
  {
	  $query=$this->db->query("select s.title as service_title,p.description as desc,p.bid_amount as amount,p.bid_id as bid_id,p.created as bidDate from service_request as s, place_bids as p where s.service_request_id=p.service_id and p.user_id='".$this->input->post('user_id')."' and p.service_id= '".$this->input->post('service_id')."' order by p.created desc");
	  
	  return $query->result_array();
  }
  
  public function viewMyWatchList()
  {
	  if($this->input->post('user_id'))
	   {
	   $query=$this->db->query("select w.watchlist_id as watchlist_id,s.title as service_title,s.expiry_date as expiry_date,s.delivery as delivery from service_request as s, watchlist as w where s.service_request_id=w.service_id and w.user_id='".$this->input->post('user_id')."' order by w.created desc");
	   return $query->result_array();
	   }
	   else
	   {
		   return false;
	   }
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
  public function updateServiceNotification()
  {
	$service_types=implode(',',$this->input->post('service_types'));  
	$upd['service_types']=$service_types;
	$this->db->where('user_id',$this->input->post('user_id'));
	$this->db->update('service_notification', $upd); 
  }
  
  public function insertServiceNotification()
  {
	  $service_types=implode(',',$this->input->post('service_types')); 
	  $ins['service_types']=$service_types;
	  $ins['user_id']=$this->input->post('user_id');
	  $this->db->insert('service_notification', $upd); 
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
  
  /*Comment section start here */
  public function comment()
  {
	  if($this->input->post('user_comment_id') && $this->input->post('comment') && $this->input->post('post_id') && $this->input->post('type'))
	  {
		  $created=date('Y-m-d h:i:s');
		  $ins['user_comment_id']=$this->input->post('user_comment_id');
		  $ins['comment']=$this->input->post('comment');
		  $ins['post_id']=$this->input->post('post_id');
		  $ins['type']=$this->input->post('type');
		  if($this->input->post('reply_comment_id'))
		  $ins['reply_comment_id']=$this->input->post('reply_comment_id');
		  if($this->input->post('reply'))
		  $ins['reply']=$this->input->post('reply');
		  $ins['created']=$created;
		  $this->db->insert('comment', $ins);
		  if($this->db->insert_id())
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
  
  public function UpdateComment()
  {
	  if($this->input->post('user_comment_id') && $this->input->post('comment_id') && $this->input->post('comment'))
	  {
		  $upd['comment']=$this->input->post('comment');
		  $this->db->where('comment_id',$this->input->post('comment_id'));
	      $this->db->update('comment', $upd); 
	      return true;
	  }
	  else
	  {
		  return false;
	  }
  }
  
  public function ReportSpam()
  {
	  if($this->input->post('comment_id') && $this->input->post('user_id'))
	  {
		 $created=date('Y-m-d h:i:s');
		 $ins['comment_id']=$this->input->post('comment_id');
		 $ins['user_id']=$this->input->post('user_id');
		 $ins['created']=$created;
		 $this->db->insert('spam_comment', $ins);
		 return true;
	  }
	  else
	  {
		  return false;
	  }
  }
  /*Comment Section End Here */
  
}
