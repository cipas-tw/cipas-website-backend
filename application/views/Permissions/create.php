<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	<link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	.mt-checkbox{
		padding-right: 10px;
	}
	</style>
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
									<a href="/<?php echo $controllerName;?>"><?php echo $unit;?>-列表</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span><?php echo $unit;?>-新增</span>
								</li>
							</ul>
						</div>
						<!-- END PAGE BAR -->
						<!-- BEGIN PAGE TITLE-->
						<h1 class="page-title"> <?php echo $unit;?>-新增 </h1>
						<!-- END PAGE TITLE-->
						<!-- END PAGE HEADER-->
						<?php echo $alertsHtml;?>
						<div class="row">
							<!-- BEGIN FORM-->
							<form id="formPost" action="" class="formPost form-horizontal form-bordered form-row-stripped" method="post">
								<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
								<input type="hidden" name="op" value="add">
								<input type="hidden" name="HTTP_REFERER" value="<?php echo $httpGetParams;?>">
								<div class="col-md-12">
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
									<div class="portlet light bordered form-fit">
										<div class="portlet-title">
											<div class="caption">
												<span class="caption-subject font-blue-hoki bold uppercase"><?php echo $unit;?>-新增</span>
												<span class="caption-helper"></span>
											</div>
										</div>
										<div class="portlet-body form">
											<div class="form-body form-horizontal form-bordered form-row-stripped">
												<div class="form-group">
													<label class="control-label col-md-3">權限名稱</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫權限名稱" class="form-control" id="<?php echo $abrv;?>name" name="<?php echo $abrv;?>name" aria-required="true" value="" />
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- END EXAMPLE TABLE PORTLET-->
								</div>

								<div class="col-md-12 ">
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
									<div class="portlet light bordered form-fit">
										<div class="portlet-title">
											<div class="caption">
												<span class="caption-subject font-blue-hoki bold uppercase">單元權限設置</span>
												<span class="caption-helper"></span>
											</div>
										</div>
										<div class="portlet-body form">
											<div class="form-body form-horizontal form-bordered form-row-stripped">
											<?php foreach($sidebarList as $val){?>
												<div class="form-group">
													<label class="control-label col-md-3"><?php echo $val['mainMenus']['backend_menu_name']?></label>
													<div class="col-md-9">
													<?php if(isset($val['subMenus'])){?>

														<?php foreach($val['subMenus'] as $v){?>
															<div class="form-group">
																<label class="control-label col-md-3"><?php echo $v['backend_menu_name']?></label>
																<div class="col-md-9">
																	<?php foreach($sidebarPermissionType as $k=>$type){?>
																		<label class="mt-checkbox">
																			<input type="checkbox" class="backend_menu_permission<?php echo $k;?>" name="<?php echo $abrv;?>lists[]" value="<?php echo $v['backend_menu_id'],$k;?>"><?php echo $type;?><span></span>
																		</label>
																	<?php }?>
																</div>
															</div>
														<?php }?>

													<?php } else {?>

														<?php foreach($sidebarPermissionType as $k=>$type){?>
															<label class="mt-checkbox">
																<input type="checkbox" class="backend_menu_permission<?php echo $k;?>" name="<?php echo $abrv;?>lists[]" value="<?php echo $val['mainMenus']['backend_menu_id'],$k;?>"><?php echo $type;?><span></span>
															</label>
														<?php }?>

													<?php }?>
													</div>
												</div>
											<?php }?>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn green"><i class="fa fa-check"></i> 送出</button>
														<button type="button" class="btn default" data-toggle="modal" href="#cancel">取消</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- END EXAMPLE TABLE PORTLET-->
								</div>
							</form>
							<!-- END FORM-->
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
		<script src="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
		<script src="/public/js/jquery.ajaxfileupload.js" type="text/javascript" ></script>
		<script src="/public/js/jquery.blockUI.js" type="text/javascript"></script>
		<script src="/public/js/uploadFile.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/<?php echo $controllerName;?>.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>