<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	<link href="/public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
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
								<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-magnifier font-blue-hoki"></i>
											<span class="caption-subject font-blue-hoki bold uppercase">搜尋</span>
											<span class="caption-helper"></span>
										</div>
										<div class="tools">
											<a href="" class="collapse"> </a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="" class="horizontal-form" method="get">
										<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
											<div class="form-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">關鍵字</label>
															<input type="text" name="keyword" class="form-control" placeholder="請填寫關鍵字" value="<?php echo isset($queryData['keyword'])? $queryData['keyword'] : ''?>">
															<span class="help-block"> 關鍵字：標題</span>
														</div>
													</div>

													<!--/span-->
												</div>
												<!--/row-->
											</div>
											<div class="form-actions right">
												<button type="submit" class="btn blue"> <i class="fa fa-search"></i> 查詢</button>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<div class="row" id="addBtn">
							<div class="col-md-12">
								<div class="form-group">
									<a href="/<?php echo $controllerName?>/create" class="btn blue"><i class="fa fa-plus"></i> 新增 </a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
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
										<table class="table table-striped table-bordered table-hover" id="sample_1">
											<thead>
												<tr>
													<td>#</td>
													<th>標題</th>
													<th>最後更新時間</th>
													<th>狀態</th>
													<th>管理</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach( $result as $k => $val ){
												?>
												<tr>
													<td><?php echo $k + 1;?></td>
													<td><?php echo stripslashes($val[$abrv.'title']);?></td>
													<td><?php echo $val[$abrv.'edited_date'];?></td>
													<td><?php echo $status[$val[$abrv.'status']];?></td>
													<td>
														<a href="/<?php echo $controllerName?>/edit/<?php echo $val[$abrv.'id'];?>" class="btn btn-xs green" id="editBtn"> 修改 <i class="fa fa-edit"></i></a>
														<a class="btn btn-xs red" data-toggle="modal" href="#draggable" onclick="$('#deleteForm [name=id]').val(<?php echo $val[$abrv.'id']?>)" id="delBtn"> 刪除 <i class="fa fa-times"></i></a>
														<a href="<?php echo $this->config->item('frontEndUrl').$frontEndUrl."/".$val[$abrv.'id']; ?>" class="btn btn-xs yellow"> 預覽</a>
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

        <script src="/public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="/public/assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
	</body>