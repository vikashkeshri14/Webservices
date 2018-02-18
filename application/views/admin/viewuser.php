
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
            <li class="active">View User</li>
        </ul><!--.breadcrumb-->
    </div>
    
    <div id="page-content" class="clearfix">
        <h3 class="header smaller lighter blue">User List</h3>
        <div class="table-header">
            Complete List of Users Available
        </div>

        <table id="table_report" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">
                        <label>
                            <span class="lbl">S/No</span>
                        </label>
                    </th>
                    <th>User Name</th>
                    <th>Role Name</th>
                    <th>LoginID</th>
                    <th>Gender</th>
                    <th>EmailID</th>
                    <th>Phone No</th>
                    <th>Iqama ID</th>
                    <th>Status</th>                   
                    <th>adress</th>
                    <th class="hidden-phone">
                        <i class="icon-time hidden-phone"></i>
                        Created date
                    </th>
                    <th class="hidden-480">
                        <i class="icon-time hidden-phone"></i>
                    Updated date</th>

                    <th></th>
                </tr>
            </thead>

            <tbody>
            <?php $counter = 0; ?>
            <!--print_r($city);echo '<pre>';-->
            <?php if(is_array($user)){ foreach ($user as $users): { $counter++; //increment counter by 1 on every pass ?>
                <tr>
                    <td class="center">
                        <label>                            
                            <span class="lbl"><?=$counter?></span>
                        </label>
                    </td>

                    <td>
					<?= $users['name']?>
                    </td>
                    <td><?= $users['rol_name']?></td>
                    <td class="hidden-480"><?= $users['username']?></td>
                    <td class="hidden-phone"><?= $users['gender']?></td>
                     <td class="hidden-phone"><?= $users['email_id']?></td>
                     <td class="hidden-phone"><?= $users['phone_no']?></td>
                     <td class="hidden-phone"><?= $users['iqama_id']?></td>
                     
                     <td class="hidden-phone"><?= $users['status']?></td>
                     <td class="hidden-phone"><?= $users['address']?></td>
                      <td class="hidden-480"><?= $users['created']?></td>
                    <td class="hidden-phone"><?= $users['updated']?></td>

              

                    <td class="td-actions">
                        <div class="hidden-phone visible-desktop btn-group">
                            
                             <!--<a href="<?=base_url('index.php/admin/viewuser/adduser')?>" class="btn btn-mini btn-success" title="Add New City">
									 <i class="icon-plus bigger-120"></i>
								</a>-->

                            <button class="btn btn-mini btn-info" onclick="location.href='<?=base_url('index.php/admin/viewuser/adduser/'.$users['user_id'])?>'" title="Edit User">
                                <i class="icon-edit bigger-120"></i>
                            </button>

                            <button onclick="if(confirm('Are you sure,you want to delete ?')){location.href='<?=base_url('index.php/admin/viewuser/delete/'.$users['user_id'])?>';}" class="btn btn-mini btn-danger">
                                <i class="icon-trash bigger-120"></i>
                            </button>
                        </div>

                        <div class="hidden-desktop visible-phone">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="<?=base_url('index.php/admin/viewuser/adduser/'.$users['user_id'])?>" class="tooltip-success" data-rel="tooltip" name="edit" title="Edit" data-placement="left">
                                            <span class="green">
                                                <i class="icon-edit"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('index.php/admin/viewuser/delete/'.$users['user_id'])?>" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left" onclick="return confirm('Are you sure,you want to delete ?')">
                                            <span class="red">
                                                <i class="icon-trash"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
<?php } endforeach;} else { echo ' no values';} ?>
            
            </tbody>
        </table>
    </div>
    
</div>
