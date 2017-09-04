			<!-- BEGIN HEADER -->
			<div class="page-header navbar navbar-fixed-top">
				<!-- BEGIN HEADER INNER -->
				<div class="page-header-inner ">
					<!-- BEGIN LOGO -->
					<div class="page-logo">
						<a href="/">
							<img src="/public/images/cipas.png" width="86" height="14" alt="logo" class="logo-default" style="display: none;" /> </a>
						<div class="menu-toggler sidebar-toggler">
							<span></span>
						</div>
					</div>
					<!-- END LOGO -->
					<!-- BEGIN RESPONSIVE MENU TOGGLER -->
					<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
						<span></span>
					</a>
					<!-- END RESPONSIVE MENU TOGGLER -->
					<!-- BEGIN TOP NAVIGATION MENU -->
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-user">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('ubmsys_users_name');?> </span>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-default">
									<li>
										<a href="/home/logout">
											<i class="icon-key"></i> Log Out </a>
									</li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->
						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
				</div>
				<!-- END HEADER INNER -->
			</div>
			<!-- END HEADER -->
