  <?php
  class Model_user extends CI_Model {
  
	public function __construct()
	{
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();		
	}
   
  public function createuser()//--Create User Function for Creating Admin Users
	{
	try 
		{	
		  if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no') && $this->input->post('role_id') &&  $this->input->post('password'))
			  {
				  /*--Encrypting the Password before saving*/
				$password=$this->password_encrypt($this->input->post('password'));
				$ins['username']=$this->input->post('username');
				$ins['email_id']=$this->input->post('email_id');
				$ins['phone_no']=$this->input->post('phone_no');
				$ins['role_id']=1;//$this->input->post('role_id');//This will be always 1 Admin.
				$ins['password']=$password;
					
				if($this->input->post('iqama_id'))
				$ins['iqama_id']=$this->input->post('iqama_id');				
				
				if($this->input->post('city'))	  
				$ins['city']=$this->input->post('city');	
			
				$ins['created']=$created;
				
				/*--Inserting the record to Database..*/
				$this->db->insert('user', $ins); 
			  }
			  else
			  {
				  return false;
			  }		
		}	  
	  catch(Exception $e)//catch exception
		  {
			  /* Need to add the Logger class */
			echo 'Message: ' .$e->getMessage();
		  }
	}   
      
   public function updateuser()//--Update User Function for Creating Admin Users
   {
	    try 
		{	
		  if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no') && $this->input->post('role_id') &&  $this->input->post('password'))
			  {
				  /*--Encrypting the Password before Updating the record*/
				$password=$this->password_encrypt($this->input->post('password'));
				$ins['username']=$this->input->post('username');
				$ins['email_id']=$this->input->post('email_id');
				$ins['phone_no']=$this->input->post('phone_no');
				$ins['role_id']=1;//$this->input->post('role_id');//This will be always 1 Admin.
				$ins['password']=$password;
					
				if($this->input->post('iqama_id'))
				$ins['iqama_id']=$this->input->post('iqama_id');
				
				
				if($this->input->post('city'))	  
				$ins['city']=$this->input->post('city');	
			
				$ins['created']=$created;
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
			  /* Need to add the Logger class */
			echo 'Message: ' .$e->getMessage();
		  }
   } 
   
	 public function getusers()
	 {
		 try
		 {
			$q = $this->db->get('user');
			$data = $q->result_array();
		 }
		 catch(Exception $r)
		 {
			 /* Need to add the Logger class */
			echo 'Message: ' .$r->getMessage();
		 }
		 
	 }
	 public function deleteRecord($id) //-Deleting the record from the table
	 {
		 try
		 {
			if($this->input->post('hdid'))
			{
				$id=$this->input->post('hdid');
				/*--Deleting the record from Database..*/
				$this->db->where('id', $id);
				$del=$this->db->delete('user');   
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
			echo 'Message: ' .$y->getMessage();
		 }
	}
	
	public function password_encrypt($pass)
	{
		//$options = ['cost' => 11	  ];
	  return password_hash($pass, PASSWORD_BCRYPT, $options);
	}
	
	public function password_verify()
	{
		$hash = '$2y$11$b1Kblxw5UH6xojHn09z9HONcs/IYpzegWhxjsK3vx61eWeeSwdAves';
  
		  if (password_verify('vikash', $hash)) {
			  return true;
		  } else {
			  return false;
		  }
	}
  
  }