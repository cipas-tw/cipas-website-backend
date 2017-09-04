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
											<input type="hidden" name="contact_id" value="<?php echo $result['contact_id']; ?>">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">意見信箱</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫信箱" class="form-control" id="<?php echo $abrv;?>mail" name="<?php echo $abrv;?>mail" aria-required="true" value="<?php echo isset($result[$abrv.'mail']) ? $result[$abrv.'mail'] : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">聯絡電話</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫電話" class="form-control" id="<?php echo $abrv;?>telephone" name="<?php echo $abrv;?>telephone" aria-required="true" value="<?php echo isset($result[$abrv.'telephone']) ? $result[$abrv.'telephone'] : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">傳真號碼</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫傳真號碼" class="form-control" id="<?php echo $abrv;?>fax" name="<?php echo $abrv;?>fax" aria-required="true" value="<?php echo isset($result[$abrv.'fax']) ? $result[$abrv.'fax'] : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">聯絡地址</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫聯絡地址" class="form-control" id="<?php echo $abrv;?>address_zh_TW" name="<?php echo $abrv;?>address_zh_TW" aria-required="true" value="<?php echo isset($result[$abrv.'address_zh_TW']) ? $result[$abrv.'address_zh_TW'] : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">聯絡地址-英</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫聯絡地址-英" class="form-control" id="<?php echo $abrv;?>address_en_US" name="<?php echo $abrv;?>address_en_US" aria-required="true" value="<?php echo isset($result[$abrv.'address_en_US']) ? $result[$abrv.'address_en_US'] : '';?>" />
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
		<?php echo $blockAlertsHtml;?>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/<?php echo $controllerName?>.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>