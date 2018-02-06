<?php
if($city)
{
	$city_name=$city[0]['city_name'];
	$country_id=$city[0]['country_id'];
	$city_id=$city[0]['city_id'];
	//$city_name=
}
else
{
	$city_name='';
	$country_id='';
	$city_id='';
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
            <li class="active">Add City</li>
        </ul><!--.breadcrumb-->

    <!--    <div id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search" id="nav-search-icon"></i>
                </span>
            </form>
        </div><!--#nav-search-->-->
    </div>
    <div id="page-content" class="clearfix">
        <div class="page-header position-relative">
            <h1>
                Create New City
            </h1>
        </div><!--/.page-header-->
        <form class="form-horizontal" method="post" action="<?=base_url('index.php/admin/viewcity/addcity/'.$city_id)?>">
            <br />
            <input type="hidden" name="hdid" value="<?=$city_id?>" />
            <div class="control-group">
                <label class="control-label" for="form-field-1">Country</label>

                <div class="controls">
                    <select id="form-field-select-1" name="country_id" >
                     <?php if(is_array($country)){  foreach ($country as $countries): { ?>                        
                        <option <?php if($countries['country_id']==$country_id){?> selected="selected" <?php } ?> value="<?= $countries['country_id']?>"><?= $countries['name']?></option>
                        <?php } endforeach;} else { echo ' no values';} ?>
                    </select>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label" for="form-field-1">Name</label>

                <div class="controls">
                    <input type="text" id="name" name="city_name" value="<?=$city_name?>" placeholder="Enter City Name"  required="required" 
                   oninvalid="this.setCustomValidity(this.willValidate ? :'Enter City name')"  />
                </div>
            </div>
<br />
<br />
            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
               <a href="<?=base_url('index.php/admin/viewcity')?>" class="btn">
									 <i class="icon-reply icon-only"></i>
									Cancel
								</a>
                
            </div>

        </form>
    </div>
</div>