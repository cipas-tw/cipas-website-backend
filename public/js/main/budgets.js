jQuery(document).ready(function() {

	rules = {
		budget_title: {
			required: true
		},
		tmp_file: {
			fileCheck: true
		}
	};

	messages = {
		budget_title:'標題不能為空值',
		tmp_file:'請選擇檔案'
	};

    FormValidation.init(rules, messages);
    uploadFile.applyAjaxFileUpload('#tmp_file');
});