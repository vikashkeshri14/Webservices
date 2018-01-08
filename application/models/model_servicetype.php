<?php

include('model_log.php');
	class model_servicetype extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	 
	  $this->load->helper('url');	
	  $this->load->database();		
	}


	public function createservicetype()//--Create service type Function for Creating new service type
	{
		try 
		{
			if($this->input->post('name'))
			{
				$ins['name']=$this->input->post('name');
				$ins['description']=$this->input->post('description');
				$ins['created']=$created;
				
				/*--Inserting the record to Database..*/
				$this->db->insert('servicetypes', $ins); 
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)//catch exception
		{
			/* Need to add the Logger class */
			logwrite( 'model_servicetype.php >> createservicetype >> '.$e->getMessage());
		}
	}
	
	public function updateservicetype()//--Update service type Function for updating service types
	{
		try
		{
			if($this->input->post('name'))
			{
				$ins['name']=$this->input->post('name');
				$ins['description']=$this->input->post('description');
				$ins['updated']=$updated;
				
				if($this->input->post('hdid'))
				{
					$id=$this->input->post('hdid');
					
					/*--Updating the record to Database..*/
					$this->db->where('type_id', $id);
					$this->db->update('servicetypes', $ins); 
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
			logwrite( 'model_servicetype.php >> updateservicetypes >> '.$e->getMessage());
			return false;
		}
	}
	
 public function getservicetypes()//--Getting complete list of servicetypes available
	{
		 try
		 {
			$q = $this->db->get('servicetypes');
			$data = $q->result_array();
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'model_servicetypes.php >> getservicetypes >> '.$e->getMessage());
		 }
		 
	 }

public function getservicetypesbyid()//-Get servicetypes by ID
	{
		 try
		 {
			if($this->input->post('hdid'))
			{
				$this->db->where('type_id', $id);
				$q = $this->db->get('servicetypes');
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
			logwrite( 'model_servicetypes.php >> getservicetypesbyid >> '.$e->getMessage());
		 }		 
	 }
	 public function deleteservicetypes() //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('type_id', $id);
				$del=$this->db->delete('servicetypes');   
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
			logwrite( 'model_servicetypes.php >> deleteservicetypes >> '.$y->getMessage());
		 }
	}

}

?>