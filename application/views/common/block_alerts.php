		<script>
		</script>
		<div class="modal fade draggable-modal" id="cancel" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">警告</h4>
					</div>
					<div class="modal-body"> 請問是否確定放棄本次修改 </div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">取消</button>
						<button type="button" class="btn red" onclick="location.replace('<?php echo isset($prevPage)? $prevPage : $_SERVER['HTTP_REFERER']?>')">確定</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">人員驗證</h4>
					</div>
					<div class="modal-body">
						請輸入密碼
						<p><input type="password" placeholder="請填寫密碼" class="form-control" id="chk_password" name="chk_password" value="" /></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">取消</button>
						<button type="button" class="btn red" onclick="delCheckPassword()">刪除</button>
					</div>
					<form action="/<?php echo $controllerName?>/deleteAction" id="deleteForm" method="post">
						<input type="hidden" id="<?php echo $this->security->get_csrf_token_name()?>" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
						<input type="hidden" name="op" value="del">
						<input type="hidden" name="id" value="">
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<div class="modal fade draggable-modal" id="check_password" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">人員驗證</h4>
					</div>
					<div class="modal-body">
						請輸入密碼
						<p><input type="password" placeholder="請填寫密碼" class="form-control" id="chk_password" name="chk_password" value="" /></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">取消</button>
						<button type="button" class="btn red" onclick="checkPassword()">確定</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<script>
			var postStatus = false;
			function checkPassword(){

				if($('#check_password #chk_password').val() !=''){
					var post = {};
					post.chk_password=$('#check_password #chk_password').val();
					post.csrf_cipas = $.cookie('csrf_cipas_name');
					$.post('/ajax/checkPassword', post, function(data, textStatus, xhr) {
				    	if(data.result == 'YES'){
				    		postStatus = true;
				    		$('#formPost #csrf_cipas').val($.cookie('csrf_cipas_name'));
							$('#formPost').append( $('#check_password #chk_password') );
				    		$('#formPost').submit();
				    	}else{
				    		alert('密碼輸入錯誤，請重新輸入！');
				    	}
				    },"json");
				} else {
					alert('請輸入密碼！');
				}
			}

			function delCheckPassword(){

				if($('#draggable #chk_password').val() !=''){
					var post = {};
					post.chk_password=$('#draggable #chk_password').val();
					post.csrf_cipas = $.cookie('csrf_cipas_name');
					$.post('/ajax/checkPassword', post, function(data, textStatus, xhr) {
				    	if(data.result == 'YES'){
				    		postStatus = true;
				    		$('#deleteForm #csrf_cipas').val($.cookie('csrf_cipas_name'));
							$('#deleteForm').append( $('#draggable #chk_password') );
				    		$('#deleteForm').submit();
				    	}else{
				    		alert('密碼輸入錯誤，請重新輸入！');
				    	}
				    },"json");
				} else {
					alert('請輸入密碼！');
				}
			}

		</script>