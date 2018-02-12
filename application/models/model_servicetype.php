<?php

include_once('model_log.php');
	class Model_servicetype extends CI_Model {
  
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
				if($this->input->post('description'))
				$ins['description']=$this->input->post('description');
				else
				$ins['description']='';
				$ins['created']=date('Y-m-d H:i:s');
				
				/*--Inserting the record to Database..*/
				$this->db->insert('service_types', $ins); 
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
				$ins['updated']=date('Y-m-d H:i:s');
				
				if($this->input->post('hdid'))
				{
					$id=$this->input->post('hdid');
					
					/*--Updating the record to Database..*/
					$this->db->where('type_id', $id);
					$this->db->update('service_types', $ins); 
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
			$q=$this->db->query("select c.* from service_types as c");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'model_servicetypes.php >> getservicetypes >> '.$e->getMessage());
		 }
		 
	 }

public function getservicetypesbyid($id)//-Get servicetypes by ID
	{
		 try
		 {
			if($id)
			{
				$q=$this->db->query("select c.* from service_types as c where c.type_id=".$id);
				$data = $q->result_array();
				return $data;
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
	 public function deleteservicetypes($id) //-Deleting the record from the table
	 {
		 try
		 {
			if($id)
			{
				/*--Deleting the record from Database..*/
				$this->db->where('type_id', $id);
				$del=$this->db->delete('service_types');   
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