
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
            <li class="active">View Service Request</li>
        </ul><!--.breadcrumb-->

    </div>
    
    <div id="page-content" class="clearfix">
        <h3 class="header smaller lighter blue">Service Request List</h3>
        <div class="table-header">
            Complete List of Service Requests Available
        </div>

        <table id="table_report" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">
                        <label>
                            <span class="lbl">S/No</span>
                        </label>
                    </th>
                    <th>Title</th>
                    <th>Service Type</th>
                    <th>Description</th>                     
                    <th>Posted by</th>                   
                    <th>Expiry Date</th>
                    <th>Delivery Date</th>
                    <th>Skills</th>
                    <th>Status</th>                                      
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
            <?php if(is_array($servicerequest)){ foreach ($servicerequest as $servicerequests): { $counter++; //increment counter by 1 on every pass ?>
                <tr>
                    <td class="center">
                        <label>                            
                            <span class="lbl"><?=$counter?></span>
                        </label>
                    </td>

                    <td>
					<?= $servicerequests['title']?>
                    </td>
                    <td><?= $servicerequests['servicetype']?></td>
                    <td ><?= $servicerequests['description']?></td>
                    <td class="hidden-480"><?= $servicerequests['username']?></td>
                    <td class="hidden-phone"><?= $servicerequests['expiry_date']?></td>
                     
                     <td class="hidden-phone"><?= $servicerequests['delivery']?></td>
                     <td><?= $servicerequests['skills']?></td>                     
                     <td class="hidden-phone"><?= $servicerequests['status']?></td>
                      <td class="hidden-480"><?= $servicerequests['created']?></td>
                    <td class="hidden-phone"><?= $servicerequests['updated']?></td>
                    <td class="td-actions">
                        <div class="hidden-phone visible-desktop btn-group">
                            <button class="btn btn-mini btn-info" title="Disable Request" onclick="if(confirm('Are you sure,you want to disable ?')){location.href='<?=base_url('index.php/admin/viewservicerequest/disable/'.$servicerequests['service_request_id'])?>';}">
                                <i class="icon-edit bigger-120"></i>
                            </button>
                            <button class="btn btn-mini btn-info" title="Enable Request" onclick="if(confirm('Are you sure,you want to enable ?')){location.href='<?=base_url('index.php/admin/viewservicerequest/enable/'.$servicerequests['service_request_id'])?>';}">
                                <i class="icon-edit bigger-120"></i>
                            </button>

                            <button onclick="if(confirm('Are you sure,you want to delete ?')){location.href='<?=base_url('index.php/admin/viewservicerequest/delete/'.$servicerequests['service_request_id'])?>';}" class="btn btn-mini btn-danger">
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
                                        <a href="<?=base_url('index.php/admin/viewservicerequest/disable/'.$servicerequests['service_request_id'])?>" class="tooltip-success" data-rel="Disable the Request" name="disable" title="Disable" onclick="return confirm('Are you sure,you want to disable ?')" data-placement="left">
                                            <span class="green">
                                                <i class="icon-edit"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('index.php/admin/viewservicerequest/enable/'.$servicerequests['service_request_id'])?>" class="tooltip-success" data-rel="Enable the Request" name="enable" title="Enable" data-placement="left" onclick="return confirm('Are you sure,you want to enable ?')">
                                            <span class="green">
                                                <i class="icon-edit"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('index.php/admin/viewservicerequest/delete/'.$servicerequests['service_request_id'])?>" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left" onclick="return confirm('Are you sure,you want to delete ?')">
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
