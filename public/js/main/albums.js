jQuery(document).ready(function() {
	rules = {
		photo_title: {
			required: true
		}
	};

	messages = {
		photo_title:'標題不能為空值'
	};

    FormValidation.init(rules, messages);
    uploadFile.applyAjaxFileUpload('#tmp_file');
});