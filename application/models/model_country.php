<?php

	include('model_log.php');
	class Model_user extends CI_Model {
  
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
				$this->db->where('id', $id);
				$this->db->update('user', $ins); 
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



}

?>
