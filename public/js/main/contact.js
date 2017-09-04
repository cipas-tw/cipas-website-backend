jQuery(document).ready(function() {
	rules = {
		contact_mail: {
			required: true,
			email: true,
		},
		contact_telephone: {
			required: true,
		},
		contact_fax: {
			required: true,
		},
		contact_address_zh_TW: {
			required: true,
		},
		contact_address_en_US: {
			required: true,
		},
	};

	messages = {
		contact_mail:{
			required:'不能為空值',
			email:'信箱格式不正確',
		},
		contact_telephone:'不能為空值',
		contact_fax:'不能為空值',
		contact_address_zh_TW:'不能為空值',
		contact_address_en_US:'不能為空值',
	};

    FormValidation.init(rules, messages);
});