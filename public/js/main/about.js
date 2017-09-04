jQuery(document).ready(function() {
	rules = {
		about_responsibility_descriptionl: {
			required: true,
		},
		about_organization_descriptionl: {
			required: true,
		},
	};

	messages = {
		about_responsibility_descriptionl:'執掌說明不能為空值',
		about_organization_descriptionl:'組織說明不能為空值',
	};

    FormValidation.init(rules, messages);
    $('#image_tbody').children().each(function() {
    	fileId = '#'+$(this).attr('id')+' #tmp_file';
		uploadFile.applyAjaxFileUpload(fileId);
	});
    $('#file_tbody').children().each(function() {
    	fileId = '#'+$(this).attr('id')+' #tmp_file';
		uploadFile.applyAjaxFileUpload(fileId);
	});
});
