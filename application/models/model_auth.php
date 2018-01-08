<?php class Model_auth extends CI_Model {

  public function __construct()
  {
	parent::__construct();
	$this->load->helper('url');	
	$this->load->database();		
  }
  
  function auth_controller()
  {
	  try{
		  if($this->input->request_headers())
		  { 
		    if($this->input->request_headers()['Api-Key'] && $this->input->request_headers()['Api-Password'])
			{
				if($this->input->request_headers()['Api-Key']=='Vikash12345678' && $this->input->request_headers()['Api-Password']=='Vikash12345678')
				{
					return true;
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
		  else
		  {
			  return false;
		  }
	  }
	  catch (Exception $e)
		  {
		   $data['request']="Error";
		     $data['data']="Wrong Request";
		     $data['request_id']=0;
		     echo json_encode($data);
		 }
	  
            
  }
}
?>