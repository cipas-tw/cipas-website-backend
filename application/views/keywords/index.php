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
									<a href="/ubmsys/home">Home</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span><?php echo $unit;?>-列表</span>
								</li>
							</ul>
						</div>
						<!-- END PAGE BAR -->
						<!-- BEGIN PAGE TITLE-->
						<h1 class="page-title"> <?php echo $unit;?>-列表 </h1>
						<!-- END PAGE TITLE-->
						<!-- END PAGE HEADER-->
						<?php echo $alertsHtml;?>
						<div class="row">
							<div class="col-md-12">
								<form id="formPost" action="" class="formPost form-horizontal form-bordered form-row-stripped" method="post">
								<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
								<input type="hidden" name="op" value="upd">
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
									<div class="portlet light bordered">
										<div class="portlet-title">
											<div class="caption font-dark">
												<i class="icon-settings font-dark"></i>
												<span class="caption-subject bold uppercase"><?php echo $unit;?>-列表</span>
											</div>
											<div class="tools"> </div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="lists_sort">
												<thead>
													<tr>
														<td>#</td>
														<td>關鍵字</td>
													</tr>
												</thead>
												<tbody>
													<?php
													foreach( $result as $k => $val ){
													?>
													<tr data-id="<?php echo $val[$abrv.'id'];?>">
														<td><?php echo $k + 1;?></td>
														<td>
															<input type="hidden" id="<?php echo $abrv;?>id[]" name="<?php echo $abrv;?>id[]" value="<?php echo isset($val[$abrv.'id']) ? $val[$abrv.'id'] : '';?>" />
															<input type="text" placeholder="請填寫關鍵字" class="form-control" id="<?php echo $abrv;?>title[]" name="<?php echo $abrv;?>title[]" aria-required="true" value="<?php echo isset($val[$abrv.'title']) ? stripslashes($val[$abrv.'title']) : '';?>" />
														</td>
													</tr>
													<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- END EXAMPLE TABLE PORTLET-->
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green"><i class="fa fa-check"></i> 送出</button>
										<button type="button" class="btn default" data-toggle="modal" href="#cancel">取消</button>
									</div>
								</form>
							</div>
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
		<script src="/public/assets/global/scripts/datatable.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/<?php echo $controllerName?>.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>