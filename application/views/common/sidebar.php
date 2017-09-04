				<!-- BEGIN SIDEBAR -->
				<div class="page-sidebar-wrapper">
					<!-- BEGIN SIDEBAR -->
					<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
					<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
					<div class="page-sidebar navbar-collapse collapse">
						<!-- BEGIN SIDEBAR MENU -->
						<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
						<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
						<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
						<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
						<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
						<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
						<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
							<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
							<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							<!-- END SIDEBAR TOGGLER BUTTON -->
							<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
							<?php foreach ($sidebarMenu as $key => $value) {
							?>
							<li class="nav-item <?php echo isset($value['mainMenus']['active'])? 'active open' : ''?>">
								<a href="/<?php echo $value['mainMenus']['backend_menu_controller'];?>/" class="nav-link nav-toggle">
									<i class="<?php echo $value['mainMenus']['backend_menu_icon'];?>"></i>
									<span class="title"><?php echo $value['mainMenus']['backend_menu_name'];?></span>
									<?php if(isset($value['subMenus'])){ ?><span class="arrow"></span><?php } ?>
								</a>
								<?php if(isset($value['subMenus'])){ ?>
								<ul class="sub-menu">
									<?php foreach ($value['subMenus'] as $key2 => $value2) { ?>
											<li class="nav-item <?php echo isset($value2['active'])? 'active open' : ''?>">
												<a href="/<?php echo $value2['backend_menu_controller'];?>/" class="nav-link">
												<i class="<?php echo $value2['backend_menu_name'];?>"></i>
												<span class="title"><?php echo $value2['backend_menu_name'];?></span>
												</a>
											</li>
									<?php } ?>
								</ul>
								<?php } ?>
							</li>
							<?php } ?>
						</ul>
						<!-- END SIDEBAR MENU -->
					</div>
					<!-- END SIDEBAR -->
				</div>
				<!-- END SIDEBAR -->
