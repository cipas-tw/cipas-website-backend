<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	</head>
	<!-- END HEAD -->
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
		<div class="page-wrapper">
			<?php echo $headerHtml;?>
			<!-- BEGIN HEADER & CONTENT DIVIDER -->
			<div class="clearfix"> </div>
			<!-- END HEADER & CONTENT DIVIDER -->
			<!-- BEGIN CONTAINER -->
			<div class="page-container">
				<?php echo $sidebarHtml;?>
				<!-- BEGIN CONTENT -->
				<div class="page-content-wrapper">
					<!-- BEGIN CONTENT BODY -->
					<div class="page-content">
						<!-- BEGIN PAGE HEADER-->
						<!-- BEGIN PAGE BAR -->
						<div class="page-bar">
							<ul class="page-breadcrumb">
								<li>
									<a href="/home">Home</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<a href="/users"><?php echo $unit;?>-列表</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span><?php echo $unit;?>-修改</span>
								</li>
							</ul>
						</div>
						<!-- END PAGE BAR -->
						<!-- BEGIN PAGE TITLE-->
						<h1 class="page-title"> <?php echo $unit;?>-修改 </h1>
						<!-- END PAGE TITLE-->
						<!-- END PAGE HEADER-->
						<?php echo $alertsHtml;?>
						<div class="row">
							<div class="col-md-12">
								<!-- BEGIN EXAMPLE TABLE PORTLET-->
								<div class="portlet light bordered form-fit">
									<div class="portlet-title">
										<div class="caption">
											<span class="caption-subject font-blue-hoki bold uppercase"><?php echo $unit;?>-修改</span>
											<span class="caption-helper"><?php echo isset($result[$abrv.'account']) ? $result[$abrv.'account'] : '';?></span>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form id="formPost" action="" class="formPost form-horizontal form-bordered form-row-stripped" method="post">
											<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
											<input type="hidden" name="op" value="upd">
											<input type="hidden" name="<?php echo $abrv;?>id" value="<?php echo isset($result[$abrv.'id']) ? $result[$abrv.'id'] : 0;?>">
											<input type="hidden" name="HTTP_REFERER" value="<?php echo $_SERVER['HTTP_REFERER'];?>">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">帳號</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫帳號" class="form-control" disabled id="<?php echo $abrv;?>account" name="<?php echo $abrv;?>account" value="<?php echo isset($result[$abrv.'account']) ? $result[$abrv.'account'] : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">姓名</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫姓名" class="form-control" id="<?php echo $abrv;?>name" name="<?php echo $abrv;?>name" value="<?php echo isset($result[$abrv.'name']) ? stripslashes($result[$abrv.'name']) : '';?>" />
													</div>
												</div>
												<div class="form-group">
                                                    <label for="news_type_id" class="control-label col-md-3">權限</label>
                                                    <div class="col-md-9">
	                                                    <select class="form-control select2" id="backend_menu_permission_id" name="backend_menu_permission_id">
	                                                    <?php foreach($permissionList as $data){?>
	                                                        <option value="<?php echo $data['backend_menu_permission_id']?>" <?php echo isset($result['backend_menu_permission_id']) && $result['backend_menu_permission_id'] == $data['backend_menu_permission_id'] ? 'selected' : ''?>><?php echo $data['backend_menu_permission_name']?></option>
	                                                    <?php }?>
	                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
													<label class="control-label col-md-3">信箱</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫信箱" class="form-control" id="<?php echo $abrv;?>email" name="<?php echo $abrv;?>email" value="<?php echo isset($result[$abrv.'email']) ? $result[$abrv.'email'] : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">密碼</label>
													<div class="col-md-9">
														<input type="password" placeholder="請填寫密碼" class="form-control" id="<?php echo $abrv;?>password" name="<?php echo $abrv;?>password" value="" />
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3">確認密碼</label>
													<div class="col-md-9">
														<input type="password" placeholder="請填寫確認密碼" class="form-control" id="<?php echo $abrv;?>password_again" name="<?php echo $abrv;?>password_again" value="" />
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn green"><i class="fa fa-check"></i> 送出</button>
														<button type="button" class="btn default" data-toggle="modal" href="#cancel">取消</button>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
								<!-- END EXAMPLE TABLE PORTLET-->
							</div>
						</div>
						<div class="row">
							<?php echo $this->pagination->create_links();?>
						</div>
					</div>
					<!-- END CONTENT BODY -->
				</div>
				<!-- END CONTENT -->
			</div>
			<!-- END CONTAINER -->
			<!-- BEGIN FOOTER -->
			<?php echo $footerHtml;?>
			<!-- END FOOTER -->
		</div>
		<?php echo $scriptsHtml;?>

		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/users.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
		<?php echo $blockAlertsHtml;?>
	</body>