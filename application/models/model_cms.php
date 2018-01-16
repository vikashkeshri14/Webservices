<?php

	include_once('model_log.php');
	class Model_cms extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();		
	}
   

	public function createcms()//--Create CMS Function for Creating new cities
	{
		try 
		{
			if($this->input->post('title') && $this->input->post('description'))
			{
				$ins['title']=$this->input->post('title');
				$ins['description']=$this->input->post('description');
				$ins['user_id']=$this->input->post('user_id');
				$ins['created']=date('Y-m-d H:i:s');
				/*--Inserting the record to Database..*/
				$this->db->insert('cms', $ins); 
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)//catch exception
		{
			/* Need to add the Logger class */
			logwrite( 'model_cms.php >> createcms >> '.$e->getMessage());
		}
	}

public function updatecms()//--Update cms Function for updating cities
{
	try
	{
		if($this->input->post('title') && $this->input->post('description'))
		{
			$ins['title']=$this->input->post('title');
			$ins['description']=$this->input->post('description');
			$ins['user_id']=$this->input->post('user_id');
			$ins['updated']=$updated;
			
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				
				/*--Updating the record to Database..*/
				$this->db->where('id', $id);
				$this->db->update('cms', $ins); 
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
		logwrite( 'model_cms.php >> updatecms >> '.$e->getMessage());
		return false;
	}
}

 public function getcms()//--Getting complete list of CMS's available
	{
		 try
		 {
			 
			$q = $this->db->get('cms');
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'model_cms.php >> getcities >> '.$e->getMessage());
		 }
		 
	 }

public function getcmsbyid()//-Get cms by ID
	{
		 try
		 {
			if($this->input->post('hdid'))
			{
				$this->db->where('id', $id);
				$q = $this->db->get('cms');
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
			logwrite( 'model_cms.php >> getcitiesbyid >> '.$e->getMessage());
		 }		 
	 }
	 public function deletecms() //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('id', $id);
				$del=$this->db->delete('cms');   
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
			logwrite( 'model_cms.php >> deletecms >> '.$y->getMessage());
		 }
	}

}

?>
