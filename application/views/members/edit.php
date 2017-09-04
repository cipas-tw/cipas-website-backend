<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	<link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
													<label class="control-label col-md-3">姓名</label>
													<div class="col-md-9">
														<input type="text" placeholder="請填寫姓名" class="form-control" id="<?php echo $abrv;?>name" name="<?php echo $abrv;?>name" aria-required="true" value="<?php echo isset($result[$abrv.'name']) ? stripslashes($result[$abrv.'name']) : '';?>" />
													</div>
												</div>
												<?php if(isset($result[$abrv.'filename'])){?>
                                                <div class="form-group">
													<label class="control-label col-md-3">委員照片</label>
													<div class="col-md-9">
														<img src="/<?php echo $imagePath.$result[$abrv.'filename'];?>" width="104">
													</div>
												</div>
												<?php }?>
                                                <div class="form-group">
													<label class="control-label col-md-3">上傳委員照片(416x480)</label>
													<div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <span class="btn green btn-file">
                                                                <span class="fileinput-new"> 請選擇檔案 </span>
                                                                <span class="fileinput-exists"> 重選 </span>
                                                                <input type="file" id="tmp_file" name="tmp_img_file" accept="image/*">
                                                                <input type="hidden" name="tmp_img_filename" id="tmp_filename">
                                    							<input type="hidden" name="tmp_img_file_url" id="tmp_file_url">
                                    							<input type="hidden" class="fileinput-name" name="<?php echo $abrv;?>filename" value="<?php echo isset($result[$abrv.'filename']) ? $result[$abrv.'filename'] : '';?>">
                                                            </span>
                                                            <span class="fileinput-filename"><?php echo isset($result[$abrv.'orig_filename']) ? $result[$abrv.'orig_filename'] : '';?></span>
                                                            <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                        </div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">學歷</label>
													<div class="col-md-9">
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr role="row">
																	<th width="90%">學歷</th>
																	<th width="10%">刪除</th>
																</tr>
																<tbody id="education_tbody">
																<?php
																if($result[$abrv.'education']){
																	foreach($result[$abrv.'education'] as $i=>$value){
																?>
																	<tr id="educationRow_<?php echo $i+1?>">
																		<td>
																			<input type="text" placeholder="請填寫學歷" class="form-control" id="<?php echo $abrv;?>education[]" name="<?php echo $abrv;?>education[]" aria-required="true" value="<?php echo stripslashes($value)?>" />
																		</td>
																		<td width="10%">
																			<a class="btn red delete" onclick="delEducationRow(<?php echo $i+1?>)">
								                                                <i class="fa fa-trash"></i>
								                                                <span> 刪除 </span>
																			</a>
																		</td>
																	</tr>
																<?php }}?>
																</tbody>
															</thead>
														</table>
														<a onclick="addEducation()"  class="btn green"></i> 新增學歷</a>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">經歷</label>
													<div class="col-md-9">
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr role="row">
																	<th width="90%">經歷</th>
																	<th width="10%">刪除</th>
																</tr>
																<tbody id="experience_tbody">
																<?php
																if($result[$abrv.'experience']){
																	foreach($result[$abrv.'experience'] as $i=>$value){
																?>
																	<tr id="experienceRow_<?php echo $i+1?>">
																		<td>
																			<input type="text" placeholder="請填寫經歷" class="form-control" id="<?php echo $abrv;?>experience[]" name="<?php echo $abrv;?>experience[]" aria-required="true" value="<?php echo stripslashes($value)?>" />
																		</td>
																		<td width="10%">
																			<a class="btn red delete" onclick="delExperienceRow(<?php echo $i+1?>)">
								                                                <i class="fa fa-trash"></i>
								                                                <span> 刪除 </span>
																			</a>
																		</td>
																	</tr>
																<?php }}?>
																</tbody>
															</thead>
														</table>
														<a onclick="addExperience()"  class="btn green"></i> 新增學歷</a>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">是否為主任委員</label>
												<div class="col-md-9 mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="<?php echo $abrv;?>is_leader" value="1" <?php echo $result[$abrv.'is_leader']==1? 'checked' : ''?>/> 是
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="<?php echo $abrv;?>is_leader" value="0" <?php echo $result[$abrv.'is_leader']==0? 'checked' : ''?>/> 否
                                                        <span></span>
                                                    </label>

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