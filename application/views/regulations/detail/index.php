<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	<link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
											<i class="icon-note font-blue-hoki"></i>
											<span class="caption-subject font-blue-hoki bold uppercase">本會主管法規編輯</span>
											<span class="caption-helper"></span>
										</div>
										<div class="tools">
											<a href="" class="collapse"> </a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form id="formPost" action="" class="formPost form-horizontal form-bordered form-row-stripped" method="post">
											<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
											<input type="hidden" name="op" value="upd">
											<input type="hidden" name="HTTP_REFERER" value="<?php echo $httpGetParams;?>">
											<div class="form-body">
												<div class="row">
													<div class="form-group col-md-12">
														<label class="control-label col-md-3">標題</label>
														<div class="col-md-9">
															<input type="text" placeholder="請填寫標題" class="form-control" id="<?php echo $abrv;?>title" name="<?php echo $abrv;?>title" aria-required="true" value="<?php echo isset($result[$abrv.'title']) ? stripslashes($result[$abrv.'title']) : '';?>" />
														</div>
													</div>
													<div class="form-group col-md-12">
														<label class="control-label col-md-3">法規沿革</label>
														<div class="col-md-9">
	                                                        <textarea class="form-control" rows="6" name="<?php echo $abrv;?>content"><?php echo isset($result[$abrv.'content']) ? stripslashes($result[$abrv.'content']) : '';?></textarea>
														</div>
													</div>
													<div class="form-group col-md-12">
													<label class="control-label col-md-3">上傳附件</label>
													<div class="col-md-9">
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr role="row">
																	<th width="50%">檔案標題</th>
																	<th width="30%">檔案</th>
																	<th width="20%">刪除</th>
																</tr>
																<tbody id="file_tbody">
																<?php foreach($resultFile as $i=>$file){?>
																	<tr id="fileRow_<?php echo $i+1?>">
																		<input type="hidden" id="<?php echo $abrv;?>file_id[]" name="<?php echo $abrv;?>file_id[]" aria-required="true" value="<?php echo isset($file[$abrv.'file_id']) ? $file[$abrv.'file_id'] : '';?>" />
																		<td width="50%">
																			<input type="text" placeholder="請填寫檔案標題" class="form-control" id="<?php echo $abrv;?>file_title[]" name="<?php echo $abrv;?>file_title[]" aria-required="true" value="<?php echo isset($file[$abrv.'file_title']) ? stripslashes($file[$abrv.'file_title']) : '';?>" />
																		</td>
																		<td width="30%">
					                                                        <div class="fileinput fileinput-new" id="file" data-provides="fileinput">
					                                                            <span class="btn green btn-file">
					                                                                <span class="fileinput-new"> 請選擇檔案 </span>
					                                                                <span class="fileinput-exists"> 重選 </span>
					                                                                <input type="file" name="tmp_file" id="tmp_file">
					                                                                <input type="hidden" name="tmp_filename[]" id="tmp_filename">
                                                                					<input type="hidden" name="tmp_file_url[]" id="tmp_file_url">
					                                                                <input type="hidden" class="fileinput-name" name="<?php echo $abrv;?>file_name[]" value="<?php echo isset($file[$abrv.'file_name']) ? $file[$abrv.'file_name'] : '';?>">
					                                                            </span>
					                                                            <span class="fileinput-filename"><?php echo isset($file[$abrv.'file_orig_name']) ? $file[$abrv.'file_orig_name'] : '';?></span>
					                                                        </div>
																		</td>
																		<td width="20%">
																			<a class="btn red delete" onclick="delFileRow(<?php echo $i+1?>)">
								                                                <i class="fa fa-trash"></i>
								                                                <span> 刪除 </span>
																			</a>
																		</td>
																	</tr>
																<?php }?>
																</tbody>
															</thead>
														</table>
														<a onclick="addFile()"  class="btn green"></i> 新增附件</a>
													</div>
												</div>
													<div class="form-group col-md-12">
														<label class="control-label col-md-3">分享說明</label>
														<div class="col-md-9">
															<input type="text" placeholder="請填寫分享說明" class="form-control" id="<?php echo $abrv;?>meta_description" name="<?php echo $abrv;?>meta_description" aria-required="true" value="<?php echo isset($result[$abrv.'meta_description']) ? stripslashes($result[$abrv.'meta_description']) : '';?>" />
														</div>
													</div>
													<div class="form-group col-md-12">
														<label class="control-label col-md-3">排序</label>
														<div class="col-md-9">
															<input type="number" placeholder="" class="form-control" id="<?php echo $abrv;?>sort" name="<?php echo $abrv;?>sort" aria-required="true" value="<?php echo isset($result[$abrv.'sort']) ? $result[$abrv.'sort'] : '0';?>" />
														</div>
													</div>
													<div class="form-group col-md-12">
														<label class="control-label col-md-3">狀態</label>
														<div class="col-md-9 mt-radio-inline">
		                                                    <label class="mt-radio">
		                                                        <input type="radio" name="<?php echo $abrv;?>status" value="1" <?php echo $result[$abrv.'status']==1? 'checked' : ''?> /> 啟用
		                                                        <span></span>
		                                                    </label>
		                                                    <label class="mt-radio">
		                                                        <input type="radio" name="<?php echo $abrv;?>status" value="0" <?php echo $result[$abrv.'status']==0? 'checked' : ''?> /> 不啟用
		                                                        <span></span>
		                                                    </label>
		                                                </div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
											</div>
											<div class="form-actions right" id="editBtn">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> 送出</button>
												<button type="button" class="btn default" data-toggle="modal" href="#cancel">取消</button>
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
									<a href="/<?php echo $controllerName?>/create/<?php echo $id;?>" class="btn blue"><i class="fa fa-plus"></i> 新增 </a>
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
													<th>章節標題</th>
													<th>最後更新時間</th>
													<th>排序</th>
													<th>管理</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach( $chapterList as $k => $val ){
												?>
												<tr>
													<td><?php echo $k + 1;?></td>
													<td><?php echo stripslashes($val[$abrv.'chapter_title']);?></td>
													<td><?php echo $val[$abrv.'chapter_edited_date'];?></td>
													<td><?php echo $val[$abrv.'chapter_sort'];?></td>
													<td>
														<a href="/<?php echo $controllerName?>/edit/<?php echo $val[$abrv.'chapter_id'];?>" class="btn btn-xs green"> 修改 <i class="fa fa-edit"></i></a>
														<a class="btn btn-xs red" data-toggle="modal" href="#draggable" onclick="$('#deleteForm [name=id]').val(<?php echo $val[$abrv.'chapter_id']?>);" id="delBtn"> 刪除 <i class="fa fa-times"></i></a>
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
		<?php echo $templateHtml;?>
		<?php echo $scriptsHtml;?>


		<script src="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="/public/assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
		<script src="/public/js/jquery.ajaxfileupload.js" type="text/javascript" ></script>
		<script src="/public/js/jquery.blockUI.js" type="text/javascript"></script>
		<script src="/public/js/uploadFile.js" type="text/javascript"></script>


		<script src="/public/js/main/<?php echo $controllerName;?>.js" type="text/javascript"></script>
		<?php echo $blockAlertsHtml;?>
		<script>
			$('#draggable #deleteForm').attr('action', '/<?php echo $controllerName?>/deleteDetailAction');
		</script>
	</body>