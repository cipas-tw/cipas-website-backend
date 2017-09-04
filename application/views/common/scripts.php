		<!--[if lt IE 9]>
		<script src="/public/assets/global/plugins/respond.min.js"></script>
		<script src="/public/assets/global/plugins/excanvas.min.js"></script>
		<![endif]-->
		<!-- BEGIN CORE PLUGINS -->
		<script src="/public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
		<script src="/public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL SCRIPTS -->
		<script src="/public/assets/global/scripts/app.js" type="text/javascript"></script>
		<!-- END THEME GLOBAL SCRIPTS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/public/assets/pages/scripts/components-select2.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN THEME LAYOUT SCRIPTS -->
		<script src="/public/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
		<script src="/public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
		<script src="/public/js/formValidation.js" type="text/javascript"></script>
		<script src="/public/js/jquery.cookie.js"></script>
		<!-- END THEME LAYOUT SCRIPTS -->
		<script>
			var controllerName = '<?php echo $controllerName?>';
			var permission = <?php echo json_encode($permission)?>;
			if(!permission['create']){
				$.each(document.querySelectorAll('[id^="addBtn"]'), function() {
					$(this).remove();
				});
			}
			if(!permission['edit']){
				$.each(document.querySelectorAll('[id^="editBtn"]'), function() {
					$(this).remove();
				});
			}
			if(!permission['deleteAction']){
				$.each(document.querySelectorAll('[id^="delBtn"]'), function() {
					$(this).remove();
				});
			}
		</script>