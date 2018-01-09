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
 
  function notification($id)
   {
     return $this->db->query("select *from transfer_request where status=0 and request_to=$id")->num_rows(); 
   }
  function get_cat_name($id)
	{
		$query=$this->db->query("select category.name from category where id in (".$id.")");
		return $query->result();
	}
  function get_design($cat_id)
   {
	   $sql=mysql_query("select *from admin where role_id=7 and status=1");
	   $val=array();
	   while($row=mysql_fetch_object($sql))
	    {
			$category=explode(',',$row->category);
			
			foreach($category as $cat)
			{
				if($cat_id==$cat)
				{
					$val[]=$row;
				    break;
				}
			}
			
		}
		return $val;
   }
   
  
   
function get_user_id($role_id,$cat_id)
{
	$ke_cat='';
	$sql=mysql_query("select *from admin where role_id=".$role_id);
	while($rows=mysql_fetch_object($sql))
	{
		$cat=explode(',',$rows->category);
		
		foreach($cat as $cats)
		 {
			 if($cats==$cat_id || $role_id==1 )
			 {
				 $ke_cat.=$rows->id.',';
			 }
		 }
	}
	return  substr($ke_cat,0,strlen($ke_cat)-1);
}
   
 function update_notification($user_id)
  {
	
			  $ins['flag']=1; 
			  $this->db->where('to_user', $user_id);
			  $this->db->update('notification', $ins); 
  }
  
  function get_project_identity($cat_id)
  {
	  $query=$this->db->query("select p.identifier from projects as p,category as c where c.project_id=p.id and c.id=".$cat_id);
	  return $query->row();
  }
  function getStatus($table,$id)
   {
	  
	    $query=$this->db->query("select cm.status,cm.edited,cm.designer_status,cm.publish,cm.image_upload from ".$table." as cm where cm.id=".$id);
		return $query->row();
   }
   function getStatus_t($table,$id)
   {
	    $query=$this->db->query("select cm.status,cm.reject,cm.edited from ".$table." as cm where cm.id=".$id);
		return $query->row();
   }
   function get_designer()
   {
	    $query=$this->db->query("select design_assign from topic where design_assign!=0");
		return $query->result();
   }
   function get_pending_designer()
   {
	   $query=$this->db->query("select design_assign from topic where design_assign!=0 and status=0");
	   return $query->result();
   }
   function get_trans()
   {
	   $query=$this->db->query("SELECT count(*) as cnt FROM `translator` WHERE `status`=0 and `reject`=1");
	   return $query->row();
   }
   function get_syntax()
   {
	   $query=$this->db->query("SELECT count(*) as cnt FROM `topic` WHERE `status`=0 and `assign_syntax`!='' and design_assign_topic=0");
	   return $query->row();
   }
   function get_info()
   {
	    $query=$this->db->query("SELECT count(*) as cnt FROM `topic` WHERE `status`=0 and `design_assign`!='' and designer_status=1");
	    return $query->row();
   }
   function get_info_admin()
   {
	    $query=$this->db->query("SELECT count(*) as cnt FROM `admin_articles` WHERE `status`=0 and `design_assign`!='' and designer_status=1");
	    return $query->row();
   }
   function get_medical()
   {
	    $query=$this->db->query("SELECT count(*) as cnt FROM `topic` WHERE `flag`=0");
	    return $query->row();
   }
   function get_syntax_pend()
   {
	   $query=$this->db->query("SELECT count(*) as cnt FROM `topic` WHERE `flag`=1 or status=2");
	    return $query->row();
   }
   function get_identifier($id)
   {
	   //echo "select c.identifier as identifier from admin as u, topic as cm,category as c where u.id=cm.user_id and cm.category_id=c.id and cm.id=".$id;
	   $query=$this->db->query("select c.identifier as identifier from admin as u, topic as cm,category as c where u.id=cm.user_id and cm.category_id=c.id and cm.id=".$id);
	     return $query->row();
   }
   function getNameById($table,$id)
   {
	   $query=$this->db->query("select u.fname,u.lname from admin as u where  u.id=".$id);
	     return $query->row(); 
   }
   
   function get_admin_designer_pending()
   {
	   $query=$this->db->query("select design_assign from admin_articles where design_assign!=0 and status!=1");
	   return $query->result();
   }
   function get_admin_designer_approved()
   {
	   $query=$this->db->query("select design_assign from admin_articles where design_assign!=0 and status=1");
	   return $query->result();
   }
   function get_admin_designer()
   {
	   $query=$this->db->query("select design_assign from admin_articles where design_assign!=0");
		return $query->result();
   }
   
   function check_process($id)
   {
	  $query=$this->db->query("select process from category where id=".$id);
	  return $query->row(); 
   }
  function get_editor_status()
   {
	  $query=$this->db->query("SELECT count(t.id) as cnt FROM `topic` as t , category as c WHERE t.status=0 and t.assign_medical=0 and t.assign_syntax=0 and t.category_id=c.id and c.process=3 and t.design_assign_topic=0");
	  return $query->row();
   }
  function cnt_request()
   {
	  $query=$this->db->query("select count(*) as cnt from urgent_request where flag=0 and designer_id=".$this->session->userdata('logged_incheck')['id']);
	  return $query->result();
   }
  function get_f_articles($id,$role)
   {
	   $query=$this->db->query("select id from published_articles where articles_id=".$id." and articles_role_id=".$role);
	   return $query->result();
   }
   function getAllAdmin()
   {
	  $query=$this->db->query("SELECT * FROM video_editor_page where status=0 order by id desc"); 
	  return $query->result();
   }
}
?>