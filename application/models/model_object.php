<?php
class model_object extends CI_Model
{
   function __construct()
   {
	  // Call the Model constructor
	  parent::__construct();
	  $this->load->helper('url');	
	  $this->load->database();
	  $this->load->library('session');
	  			  
   }
   
   function getAllDatabaseFields($table)
	{
		$query=$this->db->query("SHOW FIELDS FROM ".$table);
		return $query->result();
	}
   function getAll($table)
    {
	    $this->db->select('*');
	    $this->db->from($table);
		$this->db->order_by("id", "desc");	
	    $query = $this->db->get();   
	    return $query->result();	
    } 
	function getAllOrder($table,$order)
    {
	    $this->db->select('*');
	    $this->db->from($table);
		$this->db->order_by($order, "desc");	
	    $query = $this->db->get();   
	    return $query->result();	
    } 
	function getAllOrderArray($table,$order)
    {
	    $this->db->select('*');
	    $this->db->from($table);
		$this->db->order_by($order, "desc");	
	    $query = $this->db->get();   
	    return $query->result_array();	
    } 
	function getAllFromWhere($table,$where)
    {
		//echo "SELECT * FROM ".$table." where ".$where." order by id desc";
	    $query=$this->db->query("SELECT * FROM ".$table." where ".$where." order by id desc"); 
	    return $query->result();	
    } 
	function getAllFromWhereParticular($table,$where,$part)
    {
		//echo "SELECT * FROM ".$table." where ".$where." order by id desc";
	    $query=$this->db->query("SELECT ".$part." FROM ".$table." where ".$where); 
	    return $query->result();	
    } 
	function getAllFromWhereOrder($table,$where,$order)
    {
		//echo "SELECT * FROM ".$table." where ".$where." order by id desc";
	    $query=$this->db->query("SELECT * FROM ".$table." where ".$where." order by ".$order." desc"); 
	    return $query->result();	
    } 
	function getAllByStatus($table)
    {
	    $this->db->select('*');
	    $this->db->from($table);
		$this->db->where('status',1);	
	    $query = $this->db->get();   
	    return $query->result();	
    }
	function getDate()
	{
		$query=$this->db->query("SELECT NOW() as get_date FROM dual");
		return $query->row();
	}
	function getElementByIdWhere($table,$field,$id)
    {
   	    $this->db->select('*');
	    $this->db->from($table);	
	    $this->db->where($field,$id);	
	    $query = $this->db->get();   
	    return $query->row();	
    }
	 
   function getElementById($table,$id)
    {
   	    $this->db->select('*');
	    $this->db->from($table);	
	    $this->db->where('id',$id);	
	    $query = $this->db->get();   
	    return $query->row();	
    }
   function usermail($table,$id)
    {
   	    $this->db->select('*');
	    $this->db->from($table);	
	    $this->db->where('main_id',$id);	
		$this->db->where('lang_id',1);
	    $query = $this->db->get();   
	    return $query->row();	
    }
	function Enable($table,$id)
	  {
			$ins['status']=1;
			$this->db->where('id', $id);	
			$this->db->update($table,$ins); 
	  }
  
  function Disable($table,$id)
	  {
			$ins['status']=0;
			$this->db->where('id', $id);	
			$this->db->update($table,$ins); 
	  }
  function Delete($table,$id)
	  {			
			$this->db->delete($table, array('id' => $id)); 
	  }
  function DeleteWhere($table,$field,$val)
  {
	  $this->db->delete($table, array($field => $val)); 
  }
  function Ins_Upd($table)
  {
        $ins=array();
		$dbfields=$this->getAllDatabaseFields($table);
		
		foreach($dbfields as $dbfield)
		{
			if($this->input->post($dbfield->Field))
			$ins[$dbfield->Field] = $this->input->post($dbfield->Field);
		}
	return $ins;
   }
  function Insert($table)
  {
        $ins=array();
		$dbfields=$this->getAllDatabaseFields($table);
		
		foreach($dbfields as $dbfield)
		{
			if($this->input->post($dbfield->Field))
			$ins[$dbfield->Field] = $this->input->post($dbfield->Field);
		}
	$this->db->insert($table,$ins);
   }
  function exist($field,$table,$value)
   {
     $this->db->get($table);
	 $query=$this->db->where($field,$value);
	 if($query->num_rows()>0)
	 return true;
	 else
	 return false;
	 
   }
   
   function getElementByField($field,$table,$value)
   {
   $this->db->where($field,$value);
     
	 $query=$this->db->get($table);
	 return $query->result();
	 
   }
   function getElementByStatus($field,$table,$value)
   {
	   $this->db->where($field,$value);
	   $this->db->where('status',1);  
	   $query=$this->db->get($table);
	   return $query->result(); 
   }
  function do_upload($subfolder,$image_name)
	{
		$config['upload_path'] = 'uploads/'.$subfolder;
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload($image_name))
		{
			return NULL;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());			
			return $data['upload_data']['orig_name'];
		} 
	}
  function change_password()
  {
    $value=$this->input->post('old_password');
	$id=$this->input->post('id');
	
	$this->db->where('id',$id);
	$this->db->where('password',md5($value));
	$query=$this->db->get('admin');
	//check the password is match or not
   if($query->num_rows()>0)
    {
	 $ins['password']=md5($this->input->post('new_password'));
	 $this->db->where('id', $id);	
	 $this->db->update('admin',$ins);	
	 return $this->session->set_userdata('msg','Update Successfully');
    }
   else
    {
	  return $this->session->set_userdata('msg','You have Enter wrong password');
	}
   
  }
  
  function check_inbox()//function to check unread mail
  {
    $user=$this->session->userdata('logged_incheck');
    $query=$this->db->query("select count(status) as unread from mail where receiver_id=".$user['id']." and status=0");
	return $query->result();
  }
  
  function getPageBySeo($seo)
  {
    $this->db->where('seo',$seo);
	$query=$this->db->get('cms');
	return $query->result();
  }
 
 
  
   
  
  function get_wildcard($table,$select,$like)
  {
	$query=$this->db->query("select ".$select." from ".$table." where ".$like);
	return $query->result();  
  }
}
?>