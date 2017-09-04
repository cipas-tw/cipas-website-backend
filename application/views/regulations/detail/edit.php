<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	<link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<link href="/public/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
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
									<a href="/<?php echo $controllerName;?>"><?php echo $unit;?>-列表</a>
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
														<input type="text" placeholder="請填寫標題" class="form-control" id="<?php echo $abrv;?>chapter_title" name="<?php echo $abrv;?>chapter_title" aria-required="true" value="<?php echo isset($result[$abrv.'chapter_title']) ? stripslashes($result[$abrv.'chapter_title']) : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">排序</label>
													<div class="col-md-9">
														<input type="number" placeholder="請填寫排序" class="form-control" id="<?php echo $abrv;?>chapter_sort" name="<?php echo $abrv;?>chapter_sort" aria-required="true" value="<?php echo isset($result[$abrv.'chapter_sort']) ? stripslashes($result[$abrv.'chapter_sort']) : '';?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">條文</label>
													<div class="col-md-9">
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr role="row">
																	<th width="70%">條文</th>
																	<th width="10%">條文編號</th>
																	<th width="10%">條文順序</th>
																	<th width="10%">刪除</th>
																</tr>
																<tbody id="tbody">
																<?php foreach($resultTerms as $i=>$terms){?>
																	<input type="hidden" id="<?php echo $abrv;?>terms_id" name="<?php echo $abrv;?>terms_id[]" aria-required="true" value="<?php echo isset($terms[$abrv.'terms_id']) ? $terms[$abrv.'terms_id'] : '';?>" />
																	<tr id="row_<?php echo $i+1?>">
																		<td class="form-group">
																			<textarea class="form-control" id="<?php echo $abrv;?>terms_content" name="<?php echo $abrv;?>terms_content[]"><?php echo isset($terms[$abrv.'terms_content']) ? stripslashes($terms[$abrv.'terms_content']) : '';?></textarea>
																		</td>
																		<td class="form-group">
																			<input type="text" placeholder="" class="form-control" id="<?php echo $abrv;?>terms_numbering" name="<?php echo $abrv;?>terms_numbering[]" aria-required="true" value="<?php echo isset($terms[$abrv.'terms_numbering']) ? $terms[$abrv.'terms_numbering'] : '';?>" />
																		</td>
																		<td>
																			<input type="number" placeholder="排序號碼" class="form-control" id="<?php echo $abrv;?>terms_sort" name="<?php echo $abrv;?>terms_sort[]" aria-required="true" value="<?php echo isset($terms[$abrv.'terms_sort']) ? $terms[$abrv.'terms_sort'] : '';?>" />
																		</td>
																		<td width="10%">
																			<a class="btn red delete" onclick="delRow(<?php echo $i+1?>)">
								                                                <i class="fa fa-trash"></i>
								                                                <span> 刪除 </span>
																			</a>
																		</td>
																	</tr>
																<?php }?>
																</tbody>
															</thead>
														</table>
														<a onclick="addRow()"  class="btn green"></i> 新增條文</a>
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
		<?php echo $templateHtml;?>
		<?php echo $scriptsHtml;?>
		<script src="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="/public/assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
		<script src="/public/js/jquery.ajaxfileupload.js" type="text/javascript" ></script>
		<script src="/public/js/jquery.blockUI.js" type="text/javascript"></script>
		<script src="/public/js/uploadFile.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/<?php echo $controllerName;?>.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>