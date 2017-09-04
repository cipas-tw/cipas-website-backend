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
	<body class="login">
		<!-- BEGIN LOGO -->
		<div class="logo">
			<a href="javascript:void(0);">
				<img src="/public/images/cipas.png" alt="" />
			</a>
		</div>
		<!-- END LOGO -->
		<?php echo $alertsHtml;?>
		<!-- BEGIN LOGIN -->
		<div class="content">
			<!-- BEGIN LOGIN FORM -->
			<form class="login-form" action="" method="post">
				<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
				<h3 class="form-title font-green">Sign In</h3>
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<span> Enter any username and password. </span>
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Username</label>
					<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="請填寫帳號(E-mail)" name="users_account" value="<?php echo isset($_COOKIE['ubmsys_users_account']) ? $_COOKIE['ubmsys_users_account'] : '';?>" />
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="請填寫密碼" name="users_password" value="<?php echo isset($_COOKIE['ubmsys_users_password']) ? $_COOKIE['ubmsys_users_password'] : '';?>" />
				</div>
				<div class="form-actions">
					<button type="submit" class="btn green uppercase">Login</button>
					<label class="rememberme check mt-checkbox mt-checkbox-outline">
						<input type="checkbox" name="remember" value="1" />Remember
						<span></span>
					</label>
				</div>
				<input type="hidden" name="op" value="<?php echo $op?>">
			</form>
			<!-- END LOGIN FORM -->
		</div>
		<div class="copyright"> <?php echo FOOTER_YEAR;?> © <?php echo FOOTER_COMPANY;?> </div>
		<?php echo $scriptsHtml;?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="/public/assets/pages/scripts/login.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
	</body>