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
			<link href="/public/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
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
											<input type="hidden" name="HTTP_REFERER" value="<?php echo $httpGetParams;?>">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">標題</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫標題" class="form-control" id="<?php echo $abrv;?>name" name="<?php echo $abrv;?>name" aria-required="true" value="<?php echo isset($result[$abrv.'name']) ? stripslashes($result[$abrv.'name']) : '';?>" readonly/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">說明</label>
													<div class="col-md-9">
														<textarea class="form-control" name="<?php echo $abrv;?>content" aria-required="true" data-error-container="#<?php echo $abrv;?>content" rows="6"><?php echo isset($result[$abrv.'content']) ? stripslashes($result[$abrv.'content']) : '';?></textarea>
                                                        
                                                       
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-xs-6 col-sm-4">
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
		<script src="/public/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script src="/public/ckfinder/ckfinder.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/<?php echo $controllerName?>_type.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>