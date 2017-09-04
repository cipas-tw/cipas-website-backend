		<meta charset="utf-8" />
		<title><?php echo (isset($title)? $title.'-' : '').HEAD_TITLE;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="/public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="/public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
		<link href="/public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="/public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<?php
		if( isset($includeCss) && strstr($includeCss, 'datatables') ){
		?>
		<link href="/public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
		<link href="/public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
		<?php
		}
		?>
		<link href="/public/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
		<link href="/public/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL STYLES -->
		<link href="/public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
		<link href="/public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
		<!-- END THEME GLOBAL STYLES -->
		<!-- BEGIN THEME LAYOUT STYLES -->
		<link href="/public/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
		<link href="/public/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
		<link href="/public/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
		<!-- END THEME LAYOUT STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<?php
		if( isset($includeCss) && strstr($includeCss, 'error') ){
		?>
        <link href="/public/assets/pages/css/error.min.css" rel="stylesheet" type="text/css" />
		<?php
		}
		?>
		<?php
		if( isset($includeCss) && strstr($includeCss, 'login') ){
		?>
		<link href="/public/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
		<?php
		}
		?>
		<!-- END PAGE LEVEL STYLES -->
		<link rel="shortcut icon" href="favicon.ico" />
