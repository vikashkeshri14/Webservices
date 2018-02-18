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
            <li class="active">View Service Type</li>
        </ul><!--.breadcrumb-->


    </div>
    
    <div id="page-content" class="clearfix">
        <h3 class="header smaller lighter blue">Service Type List</h3>
        <div class="table-header">
            Complete List of Service Types Available
        </div>

        <table id="table_report" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">
                        <label>
                            <span class="lbl">S/No</span>
                        </label>
                    </th>
                    <th>Service Type Name</th>
                    <th>Description</th>
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
            <?php $counterst = 0; ?>
            <!--print_r($city);echo '<pre>';-->
            <?php if(is_array($servicetype)){  foreach ($servicetype as $servicetypes): { $counterst++;?>
                <tr>
                    <td class="center">
                        <label>
                            <span class="lbl"><?=$counterst?></span>
                        </label>
                    </td>

                    <td>
					<?= $servicetypes['name']?>
                    </td>
                    <td><?= $servicetypes['description']?></td>
                    <td class="hidden-480"><?= $servicetypes['created']?></td>
                    <td class="hidden-phone"><?= $servicetypes['updated']?></td>

              

                    <td class="td-actions">
                        <div class="hidden-phone visible-desktop btn-group">
                            
                           <!--  <a href="<?=base_url('index.php/admin/viewservicetype/addservicetype')?>" class="btn btn-mini btn-success" title="Add New Service Type">
									 <i class="icon-plus bigger-120"></i>
								</a>-->

                            <button class="btn btn-mini btn-info" onclick="location.href='<?=base_url('index.php/admin/viewservicetype/addservicetype/'.$servicetypes['type_id'])?>'" title="Edit Service Type">
                                <i class="icon-edit bigger-120"></i>
                            </button>

                            <button class="btn btn-mini btn-danger" onclick="if(confirm('Are you sure,you want to delete ?')){location.href='<?=base_url('index.php/admin/viewservicetype/delete/'.$servicetypes['type_id'])?>';}">
                                <i class="icon-trash bigger-120"></i>
                            </button>

                           <!-- <button class="btn btn-mini btn-warning">
                                <i class="icon-lock bigger-120"></i>
                            </button>-->
                        </div>

                        <div class="hidden-desktop visible-phone">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="<?=base_url('index.php/admin/viewservicetype/addservicetype/'.$servicetypes['type_id'])?>" class="tooltip-success" data-rel="tooltip" name="edit" title="Edit" data-placement="left">
                                            <span class="green">
                                                <i class="icon-edit"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('index.php/admin/viewservicetype/delete/'.$servicetypes['type_id'])?>" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left"
                                        onclick="return confirm('Are you sure,you want to delete ?')">
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
