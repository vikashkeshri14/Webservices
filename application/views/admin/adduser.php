<?php
if($user)
{
	$name=$user[0]['name'];
	$user_id=$user[0]['user_id'];
	$username=$user[0]['username'];
	$gender=$user[0]['gender'];
	$email_id=$user[0]['email_id'];
	$phone_no1=$user[0]['phone_no'];
	$iqama_id=$user[0]['iqama_id'];
	$address=$user[0]['address'];
	$comercial_registration=$user[0]['comercial_registration'];
	
	$country1=$user[0]['country'];
	$city1=$user[0]['city'];
	$status=$user[0]['status']; 
	$password=$user[0]['password'];
	$country_id=$user[0]['country'];
	$commercial_registration='';
	$role_id=$user[0]['role_id'];
	//$city_name=
}
else
{
	$name='';
	$user_id='';
	$username='';
	$gender='';
	$email_id='';
	$phone_no1='';
	$iqama_id='';
	$address='';
	$comercial_registration='';
	$country1='';
	$city1='';
	$status='';
	$password='';
		$role_id='';
		$commercial_registration='';
}
?>
<div id="main-content" class="clearfix">
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="home">Home</a>

                <span class="divider">
                    <i class="icon-angle-right"></i>
                </span>
            </li>
            <li class="active">Add User</li>
        </ul><!--.breadcrumb-->

    </div>
    <div id="page-content" class="clearfix">
        <div class="page-header position-relative">
            <h1>
                Create New User
            </h1>
        </div><!--/.page-header-->
        <form class="form-horizontal" method="post" action="<?=base_url('index.php/admin/viewuser/adduser/'.$user_id)?>">
            <br />
            <input type="hidden" name="hdid" value="<?=$user_id?>" />
            
            <div class="control-group">
                <label class="control-label" for="form-field-1">Name</label>

                <div class="controls">
                    <input type="text" id="name" name="name" value="<?=$name?>" placeholder="Enter name"  required="required" 
                   oninvalid="this.setCustomValidity(this.willValidate ? :'Enter name')"  />
                </div>
            </div>
             <div class="control-group">
                <label class="control-label" for="form-field-1">User Name</label>

                <div class="controls">
                    <input type="text" id="username" <?php if(!$user_id){ ?> onblur="check_user(this.value)" <?php } ?> name="username" value="<?=$username?>" placeholder="Enter User Name"  required="required" 
                   oninvalid="this.setCustomValidity(this.willValidate ? :'Enter Username')"  />
                </div>
            </div>
           
             <div class="control-group">
                <label class="control-label" for="form-field-1">Gender</label>

                <div class="controls">
                <label>
<input type="radio" name="gender" value="1" <?php echo ($gender=='1')?'checked':'' ?>size="17"><span class="lbl">Male</span>
											</label>
                                             <label>
<input type="radio" name="gender" value="2" <?php echo ($gender=='2')?'checked':'' ?> size="17"><span class="lbl">Female</span>
											</label>
                                            


            </div>
            
             <div class="control-group">
                <label class="control-label" for="form-field-1">Email ID</label>

                <div class="controls">
                    <input id="email_id" type="email" name="email_id" value="<?=$email_id?>" placeholder="Enter Email Id"  required="required" 
                   oninvalid="this.setCustomValidity(this.willValidate ? :'Email required')"  />
                </div>
            </div>
             <div class="control-group">
                <label class="control-label" for="form-field-1"  >Phone No</label>


                <div class="controls">
                    <input type="text" id="phone_no" type="phone_no" maxlength="10"  name="phone_no" 
					<?php if(!$user_id){ ?> onblur="check_mobile(this.value)" <?php } ?> value="<?=$phone_no1?>" placeholder="Enter Phone No"  required="required" 
                   oninvalid="this.setCustomValidity(this.willValidate ? :'Phone No required')"  />
                </div>
            </div>
          
              <div class="control-group">
                <label class="control-label" for="form-field-1">Country</label>

                <div class="controls">
                    <select id="form-field-select-1" name="country_id" onchange="get_city(this.value)" >
                     <?php if(is_array($country)){  foreach ($country as $countries): { ?>                        
                        <option <?php if($countries['country_id']==$country1){?> selected="selected" <?php } ?> value="<?= $countries['country_id']?>"><?= $countries['name']?></option>
                        <?php } endforeach;} else { echo ' no values';} ?>
                    </select>
                </div>
            </div>
               <div class="control-group">
                <label class="control-label" for="form-field-1">City</label>

                <div class="controls">
                    <select  name="city_id" id="city_id" >
                     <?php if(is_array($city)){  foreach ($city as $cities): { ?>                        
                        <option <?php if($cities['city_id']==$city1){?> selected="selected" <?php } ?> value="<?= $cities['city_id']?>"><?= $cities['city_name']?></option>
                        <?php } endforeach;} else { echo ' no values';} ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="form-field-1">Iqama ID</label>

                <div class="controls">
                    <input type="text" id="iqama_id"  name="iqama_id" maxlength="10" value="<?=$iqama_id?>" placeholder="Enter iqama id"  />
                </div>
            </div>
              <div class="control-group">
                <label class="control-label" for="form-field-1">CR</label>

                <div class="controls">
                    <input type="text" id="commercial_registration" maxlength="10"  name="commercial_registration" value="<?=$commercial_registration?>" placeholder="Enter commercial registration"    />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="form-field-1">Address</label>

                <div class="controls">
                <textarea name="address" cols="40" rows="5" ><?=$address?></textarea>
                   
                </div>
            </div>
            <br /><br />
            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
               <a href="<?=base_url('index.php/admin/viewuser')?>" class="btn">
									 <i class="icon-reply icon-only"></i>
									Cancel
								</a>
                
            </div>

        </form>
    </div>
</div>
<script>
function check_user(args)
{
	$.ajax({
  method: "POST",
  url: "<?=base_url('index.php/admin/user/check_user')?>",
  data: { username:args }
})
  .done(function( msg ) {
    if(msg==1)
	{
		alert("username allready exist");
		$('#username').val('');
	}
	
  });
}

function check_mobile(args)
{
	$.ajax({
  method: "POST",
  url: "<?=base_url('index.php/admin/user/check_mobile')?>",
  data: { phone_no:args }
})
  .done(function( msg ) {
    if(msg==1)
	{
		alert("mobile no already exist");
		$('#phone_no').val('');
	}
	
  });
}

function get_city(args)
{
	$.ajax({
  method: "POST",
  url: "<?=base_url('index.php/admin/user/get_city')?>",
  data: { country_id:args }
})
  .done(function( msg ) {
	  //alert(msg);
   $('#city_id').html(msg);
	
  });
}
</script>