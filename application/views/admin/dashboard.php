
<?php
if($ActiveSR)
{
	$activesr=$ActiveSR[0]['count(*)'];
	
	//$city_name=
}
else
{
	$activesr='N/A';
}
if($BlockSR)
{
	$blocksr=$BlockSR[0]['count(*)'];
	
	//$city_name=
}
else
{
	$blocksr='N/A';
}

if($BlockSP)
{
	$blocksp=$BlockSP[0]['count(*)'];
	
	//$city_name=
}
else
{
	$blocksp='N/A';
}
if($BlockSA)
{
	$blocksa=$BlockSA[0]['count(*)'];
	
	//$city_name=
}
else
{
	$blocksa='N/A';
}



if($ActiveSP)
{
	$activesp=$ActiveSP[0]['count(*)'];
}
else
{
	$activesp='N/A';
}
if($ActiveSP)
{
	$activesa=$ActiveSA[0]['count(*)'];
}
else
{
	$activesa='N/A';
}


?>

<div id="main-content" class="clearfix">
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
						<li class="active">Dashboard</li>
					</ul><!--.breadcrumb-->

				</div>

				<div id="page-content" class="clearfix">
					<div class="page-header position-relative">
						<h1>
							Dashboard
							<small>
								<i class="icon-double-angle-right"></i>
								
							</small>
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<!--PAGE CONTENT BEGINS HERE-->

						<div class="alert alert-block alert-success">
							<button type="button" class="close" data-dismiss="alert">
								<i class="icon-remove"></i>
							</button>

							<i class="icon-ok green"></i>

							Welcome to
							<strong class="green">
								Theeb
								<small>(v1.1)</small></strong>, Support Panel.
						</div>

						<div class="space-6"></div>

						<div class="row-fluid">
							<div class="span7 infobox-container">
								<div class="infobox infobox-green  ">
									<div class="infobox-icon">
										<i class="icon-comments"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?=$activesr?></span>
										<div class="infobox-content">Service Requesters</div>
                                        <div class="infobox-content">(Active)</div>
									</div>
								</div>

								<div class="infobox infobox-blue  ">
									<div class="infobox-icon">
										<i class="icon-twitter"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?=$activesp?></span>
										<div class="infobox-content">Service Provider</div>
                                        <div class="infobox-content">(Active)</div>
									</div>

									
								</div>

								<div class="infobox infobox-pink  ">
									<div class="infobox-icon">
										<i class="icon-shopping-cart"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?=$activesa?></span>
										<div class="infobox-content">Super Admins</div>
                                        <div class="infobox-content">(Active)</div>
									</div>
								</div>

								<div class="infobox infobox-red  ">
									<div class="infobox-icon">
										<i class="icon-beaker"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?=$blocksr?></span>
										<div class="infobox-content">Service Requesters</div>
                                        <div class="infobox-content">(Block)</div>
									</div>
								</div>

								<div class="infobox infobox-orange2  ">
									<div class="infobox-chart">
										<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?=$blocksp?></span>
										<div class="infobox-content">Service Provider</div>
                                        <div class="infobox-content">(Block)</div>
									</div>

									
								</div>

								<div class="infobox infobox-blue2  ">
<div class="infobox-chart">
										<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
									</div>

									<div class="infobox-data">										
                                        <span class="infobox-data-number"><?=$blocksa?></span>
											<div class="infobox-content">
                                            <div class="infobox-content">Super Admins</div>
                                        <div class="infobox-content">(Block)</div>
										</div>
									</div>
								</div>

								<div class="space-6"></div>

								
							</div>

							<div class="vspace"></div>

							<div class="span5">
								<div class="widget-box">
									<div class="widget-header widget-header-flat widget-header-small">
										<h5>
											<i class="icon-signal"></i>
											Service requests
										</h5>										
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div id="piechart-placeholder"></div>
										</div><!--/widget-main-->
									</div><!--/widget-body-->
								</div><!--/widget-box-->
							</div><!--/span-->
						</div><!--/row-->						
					</div><!--/row-->
				</div><!--/#page-content-->

			</div>