jQuery(document).ready(function() {

	rules = {
		journal_type_name: {
			required: true
		},
		journal_type_content: {
			required: true
		}
	};

	messages = {
		journal_type_name:'標題不能為空值',
		journal_type_content:'內文不能為空值',
	};

    FormValidation.init(rules, messages);
    
});