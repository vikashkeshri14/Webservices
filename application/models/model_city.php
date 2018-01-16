<?php

	include_once('model_log.php');
	class Model_city extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();		
	}
   

	public function createcity()//--Create city Function for Creating new cities
	{
		try 
		{
			if($this->input->post('city_name') && $this->input->post('country_id'))
			{
				$ins['city_name']=$this->input->post('city_name');
				$ins['country_id']=$this->input->post('country_id');
				$ins['created']=date('Y-m-d H:i:s');
				/*--Inserting the record to Database..*/
				$this->db->insert('city', $ins); 
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)//catch exception
		{
			/* Need to add the Logger class */
			logwrite( 'model_city.php >> createcity >> '.$e->getMessage());
		}
	}

public function updatecity()//--Update city Function for updating cities
{
	try
	{
		if($this->input->post('city_name') && $this->input->post('country_id'))
		{
			$ins['city_name']=$this->input->post('city_name');
			$ins['country_id']=$this->input->post('country_id');
			$ins['updated']=$updated;
			
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				
				/*--Updating the record to Database..*/
				$this->db->where('city_id', $id);
				$this->db->update('city', $ins); 
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
		logwrite( 'model_city.php >> updatecity >> '.$e->getMessage());
		return false;
	}
}

 public function getcities()//--Getting complete list of cities available
	{
		 try
		 {
			 
			$q=$this->db->query("select c.*, cnt.name as cnt_name from city as c,country as cnt where c.country_id=cnt.country_id");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'model_city.php >> getcities >> '.$e->getMessage());
		 }
		 
	 }

public function getcitiesbyid()//-Get cities by ID
	{
		 try
		 {
			if($this->input->post('hdid'))
			{
				$this->db->where('city_id', $id);
				$q = $this->db->get('city');
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
			logwrite( 'model_city.php >> getcitiesbyid >> '.$e->getMessage());
		 }		 
	 }
	 public function deletecity() //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('city_id', $id);
				$del=$this->db->delete('city');   
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
			logwrite( 'model_city.php >> deletecity >> '.$y->getMessage());
		 }
	}

}

?>
