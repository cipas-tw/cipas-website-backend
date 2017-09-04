<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
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
										<!-- BEGIN FORM-->
										<form id="formPost" action="" class="formPost form-horizontal form-bordered form-row-stripped" method="post">
											<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
											<input type="hidden" name="op" value="add">
											<input type="hidden" name="HTTP_REFERER" value="<?php echo $httpGetParams;?>">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">案由</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫案由" class="form-control" id="<?php echo $abrv;?>title" name="<?php echo $abrv;?>title" aria-required="true" value="" />
													</div>
												</div>
                                                <div class="form-group">
													<label class="control-label col-md-3">上傳封面圖(800x540)</label>
													<div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <span class="btn green btn-file">
                                                                <span class="fileinput-new"> 請選擇檔案 </span>
                                                                <span class="fileinput-exists"> 重選 </span>
                                                                <input type="file" id="tmp_file" name="tmp_img_file" accept="image/*">
                                                                <input type="hidden" name="tmp_img_filename" id="tmp_filename">
                                    							<input type="hidden" name="tmp_img_file_url" id="tmp_file_url">
                                                            </span>
                                                            <span class="fileinput-filename"></span>
                                                            <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                        </div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">記事</label>
													<div class="col-md-9">
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr role="row">
																	<th width="90%">記事</th>
																	<th width="10%">刪除</th>
																</tr>
																<tbody id="note_tbody">
																	<tr id="noteRow_1">
																		<td>
																			<div class="form-group">
																				<label class="control-label col-md-3">日期</label>
																				<div class="col-md-9">
																					<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
							                                                            <input type="text" class="form-control" id="<?php echo $abrv;?>note_date" name="<?php echo $abrv;?>note_date[]" readonly>
							                                                            <span class="input-group-btn">
							                                                                <button class="btn default" type="button">
							                                                                    <i class="fa fa-calendar"></i>
							                                                                </button>
							                                                            </span>
							                                                        </div>
						                                                        </div>
						                                                    </div>
																			<div class="form-group">
						                                                        <label class="control-label col-md-3">標題</label>
						                                                        <div class="col-md-9">
																					<input type="text" placeholder="請填寫標題" class="form-control" id="<?php echo $abrv;?>note_title[]" name="<?php echo $abrv;?>note_title[]" aria-required="true" value="" />
																				</div>
																			</div>
																			<div class="form-group">
																				<label class="control-label col-md-3">連結</label>
																				<div class="col-md-9">
																					<input type="text" placeholder="請填寫連結" class="form-control" id="<?php echo $abrv;?>note_hyperlinks[]" name="<?php echo $abrv;?>note_hyperlinks[]" aria-required="true" value="" />
																				</div>
																			</div>
																			<div class="form-group">
																				<label class="control-label col-md-3">內文</label>
																				<div class="col-md-9">
							                                                        <textarea class="ckeditor form-control" id="content" name="<?php echo $abrv;?>note_content[]" aria-required="true" rows="6"></textarea>
							                                                        <div id="<?php echo $abrv;?>note_content[]"></div>
																				</div>
																			</div>
																		</td>
																		<td width="10%">
																			<a class="btn red delete" onclick="delRow(1)">
								                                                <i class="fa fa-trash"></i>
								                                                <span> 刪除 </span>
																			</a>
																		</td>
																	</tr>
																</tbody>
															</thead>
														</table>
														<a onclick="addNote()"  class="btn green"></i> 新增記事</a>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">分享說明</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫分享說明" class="form-control" id="<?php echo $abrv;?>meta_description" name="<?php echo $abrv;?>meta_description" aria-required="true" value="" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">狀態</label>
													<div class="col-md-9 mt-radio-inline">
	                                                    <label class="mt-radio">
	                                                        <input type="radio" name="<?php echo $abrv;?>status" value="1" checked /> 啟用
	                                                        <span></span>
	                                                    </label>
	                                                    <label class="mt-radio">
	                                                        <input type="radio" name="<?php echo $abrv;?>status" value="0" /> 不啟用
	                                                        <span></span>
	                                                    </label>
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
		<script src="/public/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script src="/public/ckfinder/ckfinder.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/js/main/<?php echo $controllerName;?>.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
		
	</body>