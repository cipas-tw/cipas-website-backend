var uploadFile = {};
uploadFile.applyAjaxFileUpload = function(element){
	if(typeof(controllerName) == 'undefined'){
		controllerName = '';
	}
	$(element).AjaxFileUpload({
		action: '/ajaxupload/uploadFile/'+controllerName,
		onChange: function(filename) {
			uploadFile.openLoading();
		},
		onComplete: function(filename, data) {

			if(data.status ==1 && data.file_orig_name!=''){
				$(element).parent().find('[id="tmp_file_url"]').val(data.file_url);
				$(element).parent().find('[id="tmp_filename"]').val(data.file_orig_name);
				$(element).parent().parent().find('[class="fileinput-filename"]').html(data.file_orig_name);
				$(element).parent().parent().addClass('fileinput-exists').removeClass('fileinput-new')
			} else {
				$(element).parent().find('[id="tmp_file_url"]').val('');
				$(element).parent().find('[id="tmp_filename"]').val('');
				$(element).parent().parent().find('[class="fileinput-filename"]').html('');
				$(element).parent().parent().addClass('fileinput-new').removeClass('fileinput-exists')
				alert(data.message);
			}
			uploadFile.closeLoading();
		}
	});
}

uploadFile.openLoading = function(){
	if($(window).data()['blockUI.isBlocked'] !=1){
		$.blockUI({ message: '檔案上傳中，請稍候 <img src="/public/assets/layouts/layout/img/loading.gif">' });
	}
}

uploadFile.closeLoading = function(){
	$.unblockUI();
}