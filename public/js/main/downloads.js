jQuery(document).ready(function() {

	rules = {
		files_title: {
			required: true
		},
		tmp_file: {
			fileCheck: true
		}
	};

	messages = {
		files_title:'標題不能為空值',
		tmp_file:'請選擇檔案'
	};

    FormValidation.init(rules, messages);
    uploadFile.applyAjaxFileUpload('#tmp_file');
});