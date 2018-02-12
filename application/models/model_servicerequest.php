<?php

include_once('model_log.php');
	class Model_servicerequest extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	 
	  $this->load->helper('url');	
	  $this->load->database();		
	}

	
	public function updateservicerequest()//--Update service request Function for updating service request
	{
		try
		{
			if($this->input->post('title') && $this->input->post('service_types') && $this->input->post('user_id'))
			{
				$ins['title']=$this->input->post('title');
				$ins['service_types']=$this->input->post('service_types');
				
				$ins['skills']=$this->input->post('skills');
				$ins['description']=$this->input->post('description');
				$ins['expiry_date']=$this->input->post('expiry_date');
				$ins['delivery_date']=$this->input->post('delivery_date');
				
				$ins['updated']=$updated;
				
				if($this->input->post('hdid'))
				{
					$id=$this->input->post('hdid');
					
					/*--Updating the record to Database..*/
					$this->db->where('service_request_id', $id);
					$this->db->update('service_request', $ins); 
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
		catch(Exception $e)//catch exception
		{
			/**/
			logwrite( 'Model_servicerequest.php >> updateservicerequest >> '.$e->getMessage());
			return false;
		}
	}
	
 public function getservicerequest()//--Getting complete list of servicerequest available
	{
		 try
		 {
			//$q = $this->db->get('service_request');
			$q=$this->db->query("SELECT sr.*,srt.name as servicetype,u.username as username FROM service_request as sr
LEFT join service_types as srt ON srt.type_id= sr.service_types
LEFT join user as u on u.user_id=sr.user_id");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'Model_servicerequest.php >> getservicerequest >> '.$e->getMessage());
		 }
		 
	 }

public function getservicerequestbyid()//-Get servicetypes by ID
	{
		 try
		 {
			if($this->input->post('hdid'))
			{
				$this->db->where('service_request_id', $id);
				$q = $this->db->get('service_request');
				$data = $q->result_array();
			}
			else
			{
				return false;
			}
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'Model_servicerequest.php >> getservicerequestbyid >> '.$e->getMessage());
		 }		 
	 }
	 public function deleteservicerequest($id) //-Deleting the record from the table
	 {
		 try
		 {
			if($id)
			{
				
				/*--Deleting the record from Database..*/
				$this->db->where('service_request_id', $id);
				$del=$this->db->delete('service_request');   
				return $del;
			}
			else
			{
				return false;
			}
		 }
		catch(Exception $y)
		 {
			 /* Need to add the Logger class */
			logwrite( 'Model_servicerequest.php >> deleteservicerequest >> '.$y->getMessage());
		 }
	}
	
	
public function enabledisableservicerequest($id)//--Enable/Disable servicerequest
   {
	    try 
		{	
				
		  if($this->input->post('status'))
			{
				$ins['status']=$this->input->post('status');
				if($this->input->post('hdid'))
				{
					$id=$this->input->post('hdid');
				/*--Updating the record to Database..*/
				$this->db->where('service_request_id', $id);
				$this->db->update('service_request', $ins); 
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
	  catch(Exception $e)//catch exception
		  {
			  /* Need to add the Logger class */
			logwrite( 'Model_servicerequest.php >> enabledisableservicerequest >> '.$e->getMessage());
		  }
   } 

}

?>