<div id="sidebar">
				<div id="sidebar-shortcuts">
					<div id="sidebar-shortcuts-large">
						<span>Welcome.. <?php if(is_array($this->session->userdata('userdata'))){
			 $user_data = $this->session->userdata('userdata'); echo $user_data['name'];}?></span>
					</div>

				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
					<li <?php if($this->uri->segment(2)=='home') {?> class="active" <?php } ?> >
						<a href="<?=base_url('index.php/admin/home')?>">
							<i class="icon-dashboard"></i>
							<span>Dashboard</span>
						</a>
					</li>

					<!--<li>
						<a href="typography.html">
							<i class="icon-text-width"></i>
							<span>Typography</span>
						</a>
					</li>-->

					<li <?php if($this->uri->segment(2)=='viewservicerequest') {?> class="active" <?php } ?>>
						<a href="<?=base_url('index.php/admin/viewservicerequest')?>">
							<i class="icon-desktop"></i>
							<span>Manage Request</span>
						</a>
					</li>

					<li <?php if($this->uri->segment(2)=='viewbid') {?> class="active" <?php } ?>>
						<a href="<?=base_url('index.php/admin/viewbid')?>" >
							<i class="icon-desktop"></i>
							<span>Manage BID</span>							
						</a>
					</li>
                    
                    <li <?php if($this->uri->segment(2)=='viewcomment') {?> class="active" <?php } ?>>
						<a href="<?=base_url('index.php/admin/viewcomment')?>" >
							<i class="icon-comment"></i>
							<span>Manage Comments</span>							
						</a>
					</li>
                    <li <?php if($this->uri->segment(2)=='viewuser') {?> class="active" <?php } ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-user"></i>
							<span>Manage Users</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
                        <li<?php if($this->uri->segment(3)=='adduser') {?> class="active" <?php } ?> >
								<a href="<?=base_url('index.php/admin/viewuser/adduser')?>">
									<i class="icon-double-angle-right"></i>
									Add User
								</a>
							</li>
							<li <?php if($this->uri->segment(2)=='viewuser' && $this->uri->segment(3)!='adduser') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewuser')?>">
									<i class="icon-double-angle-right"></i>
									View User
								</a>
							</li>
						</ul>
					</li >
                     <li <?php if($this->uri->segment(2)=='viewservicetype') {?> class="active" <?php } ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-desktop"></i>
							<span>Manage Service Type</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
                        <li <?php if($this->uri->segment(3)=='addservicetype') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewservicetype/addservicetype')?>">
									<i class="icon-double-angle-right"></i>
									Add Service Type
								</a>
							</li>
							<li <?php if($this->uri->segment(2)=='viewservicetype' && $this->uri->segment(3)!='addservicetype') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewservicetype')?>">
									<i class="icon-double-angle-right"></i>
									View Service Type
								</a>
							</li>
						</ul>
					</li>
                    <li <?php if($this->uri->segment(2)=='viewcountry') {?> class="active" <?php } ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-globe"></i>
							<span>Manage Country</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
                        <li <?php if($this->uri->segment(3)=='addcountry') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewcountry/addcountry')?>">
									<i class="icon-double-angle-right"></i>
									Add Country
								</a>
							</li>
							<li <?php if($this->uri->segment(2)=='viewcountry' && $this->uri->segment(3)!='addcountry') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewcountry')?>">
									<i class="icon-double-angle-right"></i>
									View Country
								</a>
							</li>
						</ul>
					</li>
                     <li <?php if($this->uri->segment(2)=='viewcity') {?> class="active" <?php } ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-globe"></i>
							<span>Manage City</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
                        <li <?php if($this->uri->segment(3)=='addcity') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewcity/addcity')?>">
									<i class="icon-double-angle-right"></i>
									Add City
								</a>
							</li>
							<li <?php if($this->uri->segment(2)=='viewcity' && $this->uri->segment(3)!='addcity') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewcity')?>">
									<i class="icon-double-angle-right"></i>
									View City
								</a>
							</li>
						</ul>
					</li>
                     <li <?php if($this->uri->segment(2)=='viewcms') {?> class="active" <?php } ?> >
						<a href="#" class="dropdown-toggle">
							<i class="icon-list"></i>
							<span>Manage CMS</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
                        <li <?php if($this->uri->segment(3)=='addcms') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewcms/addcms')?>">
									<i class="icon-double-angle-right"></i>
									Add CMS
								</a>
							</li>
							<li <?php if($this->uri->segment(2)=='viewcms' && $this->uri->segment(3)!='addcms') {?> class="active" <?php } ?> >
								<a href="<?=base_url('index.php/admin/viewcms')?>">
									<i class="icon-double-angle-right"></i>
									View CMS
								</a>
							</li>
						</ul>
					</li>
                    
                    <li <?php if($this->uri->segment(2)=='viewrptservicerequest' or
					$this->uri->segment(2)=='viewrptbidsplaced') {?> class="active" <?php } ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list"></i>
							<span>Reports</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
                        <li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									View Transaction
								</a>
							</li>
							<li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									View Rating
								</a>
							</li>
                            <li <?php if($this->uri->segment(2)=='viewrptservicerequest') {?> class="active" <?php } ?> >
								<a href="<?=base_url('index.php/admin/viewrptservicerequest')?>">
									<i class="icon-double-angle-right"></i>
									Total Service requested
								</a>
							</li>
                            <li <?php if($this->uri->segment(2)=='') {?> class="active" <?php } ?>>
								<a href="#">
									<i class="icon-double-angle-right"></i>
									Total Service request status
								</a>
							</li>
                            <li <?php if($this->uri->segment(2)=='viewrptbidsplaced') {?> class="active" <?php } ?>>
								<a href="<?=base_url('index.php/admin/viewrptbidsplaced')?>">
									<i class="icon-double-angle-right"></i>
									Total Placed Bid’s Report
								</a>
							</li>
                            <li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									Total Bid’s Accepted Report
								</a>
							</li>
                            <li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									View SMS Report
								</a>
							</li>
                            <li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									Email report
								</a>
							</li>
                            <li>
								<a href="elements.html">
									<i class="icon-double-angle-right"></i>
									View all push notification
								</a>
							</li>
                            
						</ul>
					</li>
                    
                     <li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-comment"></i>
							<span>Send Push Notification</span>							
						</a>
					</li>
      
				</ul><!--/.nav-list-->

				<div id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>