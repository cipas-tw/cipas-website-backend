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
															<input type="text" name="keyword" class="form-control" placeholder="請填寫關鍵字">
															<span class="help-block"> 關鍵字：帳號、信箱、姓名 </span>
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
													<th>#</th>
													<th>帳號</th>
													<th>姓名</th>
													<th>權限</th>
													<th>信箱</th>
													<th>管理</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach( $result as $k => $val ){
												?>
												<tr>
													<td><?php echo $k + 1;?></td>
													<td><?php echo $val[$abrv.'account'];?></td>
													<td><?php echo stripslashes($val[$abrv.'name']);?></td>
													<td><?php echo $val['backend_menu_permission_name'];?></td>
													<td><?php echo $val[$abrv.'email'];?></td>
													<td>
														<a href="/<?php echo $controllerName?>/edit/<?php echo $val[$abrv.'id'];?>" class="btn btn-xs green" id="editBtn"> 修改 <i class="fa fa-edit"></i></a>
														<a class="btn btn-xs red" data-toggle="modal" href="#draggable" onclick="$('#deleteForm [name=id]').val(<?php echo $val[$abrv.'id']?>)" id="delBtn"> 刪除 <i class="fa fa-times"></i></a>
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
		<?php echo $blockAlertsHtml;?>
	</body>