<?php

	include_once('model_log.php');
	class Model_comments extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();		
	}
   


	public function getcommentlist()//--Getting complete list of comments available
	{
	 try
		 {
			$q = $this->db->get('comment');
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
			 {
				 /* Need to add the Logger class */
				logwrite( 'Model_comments.php >> getcommentlist >> '.$e->getMessage());
			 }
			 
		 }

	public function getcommentbyid()//-Get comment by ID
	{
		 try
		 {
			if($this->input->post('hdid'))
			{
				$this->db->where('comment_id', $id);
				$q = $this->db->get('comment');
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
			logwrite( 'Model_comments.php >> getcommentbyid >> '.$e->getMessage());
		 }		 
	 }
	 public function deletecomment() //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('comment_id', $id);
				$del=$this->db->delete('comment');   
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
			logwrite( 'Model_comments.php >> deletecomment >> '.$y->getMessage());
		 }
	}
public function enabledisablecomment()//--Enable/Disable comment
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
				$this->db->where('comment_id', $id);
				$this->db->update('comment', $ins); 
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
			logwrite( 'Model_comments.php >> enabledisablecomment >> '.$e->getMessage());
		  }
   } 
}

?>
