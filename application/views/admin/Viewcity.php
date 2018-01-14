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
            <li class="active">View City</li>
        </ul><!--.breadcrumb-->

        <div id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search" id="nav-search-icon"></i>
                </span>
            </form>
        </div><!--#nav-search-->
    </div>
    <div id="page-content" class="clearfix">
        <h3 class="header smaller lighter blue">City List</h3>
        <div class="table-header">
            Complete List of Cities Available
        </div>

        <table id="table_report" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">
                        <label>
                            <input type="checkbox" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>Country Name</th>
                    <th>City Name</th>
                    
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
            
            <?php if(is_array($city)){  foreach ($city as $citys): { ?>
                <tr>
                    <td class="center">
                        <label>
                            <input type="checkbox" />
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td>
                        <a href="#"><?= $citys['name']?></a>
                    </td>
                    <td><?= $citys['city_name']?></td>
                    <td class="hidden-480"><?= $citys['created']?></td>
                    <td class="hidden-phone"><?= $citys['updated']?></td>

              

                    <td class="td-actions">
                        <div class="hidden-phone visible-desktop btn-group">
                            <button class="btn btn-mini btn-success">
                                <i class="icon-ok bigger-120"></i>
                            </button>

                            <button class="btn btn-mini btn-info">
                                <i class="icon-edit bigger-120"></i>
                            </button>

                            <button class="btn btn-mini btn-danger">
                                <i class="icon-trash bigger-120"></i>
                            </button>

                            <button class="btn btn-mini btn-warning">
                                <i class="icon-flag bigger-120"></i>
                            </button>
                        </div>

                        <div class="hidden-desktop visible-phone">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="left">
                                            <span class="green">
                                                <i class="icon-edit"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-warning" data-rel="tooltip" title="Flag" data-placement="left">
                                            <span class="blue">
                                                <i class="icon-flag"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left">
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