<!DOCTYPE html>
<!--[if IE 9]> <html lang="zh-tw" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-tw">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<?php echo $headHtml;?>
	<link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
														<input type="text" placeholder="請填寫標題" class="form-control" id="<?php echo $abrv;?>title" name="<?php echo $abrv;?>title" aria-required="true" value="<?php echo isset($result[$abrv.'title']) ? stripslashes($result[$abrv.'title']) : '';?>" />
													</div>
												</div>
												<div class="form-group">
                                                    <label for="<?php echo $abrv;?>type" class="control-label col-md-3">輪播類型</label>
                                                    <div class="col-md-9">
	                                                    <select class="form-control select2" id="<?php echo $abrv;?>type" name="<?php echo $abrv;?>type">
	                                                    <?php foreach($typeList as $i=>$type){?>
	                                                        <option value="<?php echo $i?>" <?php echo isset($result[$abrv.'type']) && $result[$abrv.'type'] == $i ? 'selected' : ''?>><?php echo $type?></option>
	                                                    <?php }?>
	                                                    </select>
                                                    </div>
                                                </div>
                                                <?php if(isset($result[$abrv.'filename']) && $result[$abrv.'filename'] !=''){?>
                                                <div class="form-group">
													<label class="control-label col-md-3">輪播圖</label>
													<div class="col-md-9">
														<img src="/<?php echo $imagePath.$result[$abrv.'filename'];?>" width="104">
													</div>
												</div>
												<?php }?>
												<div class="form-group imgSetting">
													<label class="control-label col-md-3">
														上傳附件<br/>
														(圖片尺寸建議<br/>
														800x450以上)
													</label>
													<div class="col-md-9">
                                                        <div class="fileinput fileinput-new" id="file" data-provides="fileinput">
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
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">連結</label>
												<div class="col-md-9">
													<input type="text" placeholder="請填寫連結" class="form-control" id="<?php echo $abrv;?>url" name="<?php echo $abrv;?>url" aria-required="true" value="<?php echo isset($result[$abrv.'url']) ? $result[$abrv.'url'] : '';?>" />
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
		<script>
			showImgSetting(<?php echo $result[$abrv.'type']?>);
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>