<?php

	include_once('model_log.php');
	class Model_dashboard extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();		
	}
   

	

 public function getactivesr()
	{
		 try
		 {
			$q=$this->db->query("select count(*) from user  as u where u.user_id not in (select user_id from blocked_user) and u.role_id=2");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			
		 }
		 
	 }
	 
	 
 public function getblocksr()
	{
		 try
		 {
			$q=$this->db->query("select count(*) from user  as u where u.user_id in (select user_id from blocked_user) and u.role_id=2");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			
		 }
		 
	 }
	 
public function getactivesp()
	{
		 try
		 {
			$q=$this->db->query("select count(*) from user  as u where u.user_id not in (select user_id from blocked_user) and u.role_id=3");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			
		 }
		 
	 }
	 
	 public function getblocksp()
	{
		 try
		 {
			$q=$this->db->query("select count(*) from user  as u where u.user_id in (select user_id from blocked_user) and u.role_id=3");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			
		 }
		 
	 }
	 public function getactivesa()
	{
		 try
		 {
			$q=$this->db->query("select count(*) from user  as u where u.user_id not in (select user_id from blocked_user) and u.role_id=1");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			
		 }
		 
	 }
	  public function getblocksa()
	{
		 try
		 {
			$q=$this->db->query("select count(*) from user  as u where u.user_id in (select user_id from blocked_user) and u.role_id=1");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			
		 }
		 
	 }
	 public function getnewrequest()
	{
		$query=$this->db->query("select * from service_request as sr where sr.service_request_id not in (select `service_id` from place_bids where status =1) and expiry_date > now() and status=1");
		return $query->result();
	}
	
	public function getinprogresrequest()
	{
		$query=$this->db->query("select * from service_request as sr where sr.service_request_id in 
(select `service_id` from place_bids where status ='1' and `bid_accept` = '0') and sr.expiry_date > now() and sr.status=1");
		return $query->result();
	}
	
	
	
	public function getExpiredrequest()
	{
		$query=$this->db->query("SELECT * FROM `service_request` WHERE `expiry_date` < DATE_ADD(NOW(), INTERVAL -1 DAY) and status=1 ");
		return $query->result();
	}
	public function getCompletedrequest()
	{
		$query=$this->db->query("select * from service_request as sr 
inner join place_bids as pb on sr.service_request_id = pb.service_id 
where pb.bid_accept='1' and sr.status=1 ");
		return $query->result();
	}
	 
	}

?>
