<?php

	include('model_log.php');
	class model_country extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();		
	}
   

	public function createcountry()//--Create Country Function for Creating new countries
	{
		try 
		{
			if($this->input->post('name'))
			{
				$ins['name']=$this->input->post('name');
				$ins['created']=$created;
				
				/*--Inserting the record to Database..*/
				$this->db->insert('country', $ins); 
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)//catch exception
		{
			/* Need to add the Logger class */
			//echo 'Message: ' .$e->getMessage();
			logwrite( 'model_country.php >> createcountry >> '.$e->getMessage());
		}
	}

public function updatecountry()//--Update Country Function for updating countries
{
	try
	{
		if($this->input->post('name'))
		{
			$ins['name']=$this->input->post('name');
			$ins['updated']=$updated;
			
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				
				/*--Updating the record to Database..*/
				$this->db->where('country_id', $id);
				$this->db->update('country', $ins); 
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
		logwrite( 'model_country.php >> updatecountry >> '.$e->getMessage());
		return false;
	}
}

 public function getcountries()//--Getting complete list of countries available
	{
		 try
		 {
			$q = $this->db->get('country');
			$data = $q->result_array();
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'model_country.php >> getcountries >> '.$e->getMessage());
		 }
		 
	 }

public function getcountriesbyid()//-Get countries by ID
	{
		 try
		 {
			if($this->input->post('hdid'))
			{
				$this->db->where('country_id', $id);
				$q = $this->db->get('country');
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
			logwrite( 'model_country.php >> getcountriesbyid >> '.$e->getMessage());
		 }		 
	 }
	 public function deletecountry() //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('country_id', $id);
				$del=$this->db->delete('country');   
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
			logwrite( 'model_country.php >> deletecountry >> '.$y->getMessage());
		 }
	}

}

?>
