  <?php
  include_once('model_log.php');
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
		  if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no'))
			  {
				  /*--Encrypting the Password before saving*/
				$password=$this->randompassword(5,1,"numbers");
				$encpassword= $this->password_encrypt($password[0]);
				$ins['name']=$this->input->post('name');
				$ins['username']=$this->input->post('username');
				$ins['email_id']=$this->input->post('email_id');
				$ins['phone_no']=$this->input->post('phone_no');
				$ins['role_id']=1;//$this->input->post('role_id');//This will be always 1 Admin.
				$ins['password']=$encpassword;
					//echo $this->randompassword(5,1,"numbers");
					//$my_passwords =$this-> randompassword(10,1,"lower_case,upper_case,numbers,special_symbols");
 
//print_r($this->randompassword(5,1,"numbers"));
					//exit;
				if($this->input->post('iqama_id'))
				$ins['iqama_id']=$this->input->post('iqama_id');				
				
					  
				$ins['city']=$this->input->post('city_id');	
				$ins['country']=$this->input->post('country_id');		
				$ins['status']=1;
				$ins['created']=date('Y-m-d H:i:s');
				$ins['address']=$this->input->post('address');	
				$ins['gender']=$this->input->post('gender');	
				
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
			//echo 'Message: ' .$e->getMessage();
			logwrite( 'model_user.php >> CreateUser >> '.$e->getMessage());
		  }
	}   
      
   public function updateuser()//--Update User Function for Creating Admin Users
   {
	    try 
		{	
		 /* if($this->input->post('username') && $this->input->post('email_id') && $this->input->post('phone_no') && $this->input->post('role_id') &&  $this->input->post('password'))*/
		 if($this->input->post('username'))
			  {
				  /*--Encrypting the Password before Updating the record*/
				$password=$this->password_encrypt($this->input->post('password'));
				$ins['name']=$this->input->post('name');
				$ins['username']=$this->input->post('username');
				$ins['email_id']=$this->input->post('email_id');
				$ins['phone_no']=$this->input->post('phone_no');
				$ins['role_id']=1;//$this->input->post('role_id');//This will be always 1 Admin.				
					
				if($this->input->post('iqama_id'))
				$ins['iqama_id']=$this->input->post('iqama_id');
				
				
					  
				$ins['city']=$this->input->post('city_id');	
				$ins['country']=$this->input->post('country_id');	
			
				$ins['updated']=date('Y-m-d H:i:s');
				$ins['address']=$this->input->post('address');	
				$ins['gender']=$this->input->post('gender');
				if($this->input->post('hdid'))
				{
					$id=$this->input->post('hdid');
				/*--Updating the record to Database..*/
					$this->db->where('user_id', $id);
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
			logwrite( 'model_user.php >> updateuser >> '.$e->getMessage());
		  }
   } 
   
	 public function getusers()//--Getting complete list of users
	 {
		 try
		 {
			/*$q=$this->db->query("select u.*,case u.gender when 1 then 'Male' when 2 then 'Female' else 'N/A' end gender, r.name as rol_name,ct.city_name,cnt.name as country_name,case u.status when 0 then 'Disable' else 'Enable' end status from user as u,role as r,city as ct,country as cnt where u.role_id=r.role_id &&
			u.country=cnt.country_id && u.city = ct.city_id");*/
			
			$q=$this->db->query("select u.*,case u.gender when 1 then 'Male' when 2 then 'Female' else 'N/A' end gender, r.name as rol_name,case u.status when 0 then 'Disable' else 'Enable' end status from user as u,role as r where u.role_id=r.role_id ");
			$data = $q->result_array();
			return $data;
		 }
		 catch(Exception $e)
		 {
			logwrite( 'model_user.php >> getusers >> '.$e->getMessage());
		 }		 
	 }
	 public function deleteRecord($id) //-Deleting the record from the table
	 {
		 try
		 {
			if($id)
			{
				/*--Deleting the record from Database..*/
				$this->db->where('user_id', $id);
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
			logwrite( 'model_user.php >> deleteRecord >> '.$y->getMessage());
		 }
	}
	
	
	public function getuserbyid($id)//-Get User by ID
	 {
		 try
		 {
			if($id)
			{
				$q=$this->db->query("select u.* from user as u where u.user_id=".$id);
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
			logwrite( 'model_user.php >> getuserbyid >> '.$e->getMessage());
		 }
		 
	 }
	 
public function enabledisableuser()//--Enable/Disable users
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
			logwrite( 'model_user.php >> enabledisableuser >> '.$e->getMessage());
		  }
   } 
	 
	public function password_encrypt($pass)
	{
	$options = ['cost' => 11	 ];
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
	
public	function randompassword($length,$count, $characters) {
 
// $length - the length of the generated password
// $count - number of passwords to be generated
// $characters - types of characters to be used in the password
 
// define variables used within the function    
    $symbols = array();
    $passwords = array();
    $used_symbols = '';
    $pass = '';
 
// an array of different character types    
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
    $symbols["special_symbols"] = '!?@#';
 
    $characters = explode(",",$characters); // get characters types to be used for the passsword
    foreach ($characters as $key=>$value) {
        $used_symbols .= $symbols[$value]; // build a string with all characters
    }
    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
     
    for ($p = 0; $p < $count; $p++) {
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); // get a random character from the string with all characters
            $pass .= $used_symbols[$n]; // add the character to the password string
        }
        $passwords[] = $pass;
    }
     
    return $passwords; // return the generated password
}
  
  }