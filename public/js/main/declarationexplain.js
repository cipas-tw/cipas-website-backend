jQuery(document).ready(function() {
	rules = {
		declaration_explain_title: {
			required: true
		},
		declaration_explain_content: {
			required: function() {
				CKEDITOR.instances.content.updateElement();
			}
		}
	};

	messages = {
		declaration_explain_title:'標題不能為空值',
		declaration_explain_content:'內文不能為空值'
	};

    FormValidation.init(rules, messages);
});