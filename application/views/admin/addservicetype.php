
<?php
if($servicetype)
{
	$name=$servicetype[0]['name'];
	$type_id=$servicetype[0]['type_id'];
	$description=$servicetype[0]['description'];
	//$city_name=
}
else
{
	$name='';
	$type_id='';
	$description='';
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
            <li class="active">Add Service Type</li>
        </ul><!--.breadcrumb-->

    </div>
    <div id="page-content" class="clearfix">
        <div class="page-header position-relative">
            <h1>
                Create New Service Type
            </h1>
        </div><!--/.page-header-->
        <form class="form-horizontal" method="post" action="<?=base_url('index.php/admin/viewservicetype/addservicetype/'.$type_id)?>">
            <br />
           <input type="hidden" name="hdid" value="<?=$type_id?>" />
               <div class="control-group">
                <label class="control-label" for="form-field-1">Name</label>

                <div class="controls">
                    <input type="text" id="name" name="name" value="<?=$name?>" placeholder="Enter Service Type Name"  required="required" 
                    oninvalid="this.setCustomValidity(this.willValidate ? :'Enter Service Type name')"  />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="form-field-1">Description</label>

                <div class="controls">
                    <input type="text" id="description" value="<?=$description?>" name="description" placeholder="Enter Service Type Description"  />
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
               <a href="<?=base_url('index.php/admin/viewservicetype')?>" class="btn">
									 <i class="icon-reply icon-only"></i>
									Cancel
								</a>
                
            </div>

        </form>
    </div>
</div>