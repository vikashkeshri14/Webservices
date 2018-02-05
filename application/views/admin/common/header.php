<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from easy-themes.tk/themes/preview/ace/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 03 Jul 2013 07:29:47 GMT -->
<head>
		<meta charset="utf-8" />
		<title><?=$title?></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?=base_url()?>/assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?=base_url()?>/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?=base_url()?>/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="<?=base_url()?>/assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>/assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?=base_url()?>/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles if any-->
	</head>

	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							Theeb Admin Panel
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						

						

						<li class="light-blue user-profile">
							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
								<!--<img class="nav-user-photo" src="<?=base_url()?>/assets/avatars/user.jpg" alt="Jason's Photo" />-->
								<span id="user_info">
									<small>Welcome,</small>
									Jason
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
								
								<li>
									<a href="#">
										<i class="icon-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="#">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="container-fluid" id="main-container">
			<a id="menu-toggler" href="#">
				<span></span>
			</a>