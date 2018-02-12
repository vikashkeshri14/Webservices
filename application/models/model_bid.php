<?php

include('model_log.php');
	class Model_bid extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	 
	  $this->load->helper('url');	
	  $this->load->database();		
	}

	
	public function getbids()//--Getting complete list of cities available
	{
		 try
		 {
			 
			$q=$this->db->query("select b.* from place_bids as b where b.status=1");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			 /* Need to add the Logger class */
			logwrite( 'Model_bid.php >> getbids >> '.$e->getMessage());
		 }
		 
	 }
	 
	 public function deletebid() //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('bid_id', $id);
				$del=$this->db->delete('place_bids');   
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
			logwrite( 'Model_bid.php >> deletebid >> '.$y->getMessage());
		 }
	}
	
	
public function enabledisablebid()//--Enable/Disable bid
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
				$this->db->where('bid_id', $id);
				$this->db->update('place_bids', $ins); 
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
			logwrite( 'Model_bid.php >> enabledisablebid >> '.$e->getMessage());
		  }
   } 

}

?>