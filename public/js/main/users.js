jQuery(document).ready(function() {
	rules = {
		users_account: {
			required: true,
			email: true
		},
		users_email: {
			required: true,
			email: true
		},
		users_name: {
			required: true
		},
		users_phone: {
			required: true
		},
		users_password: {
			required: false
		},
		users_password_again: {
			equalTo: '#users_password'
		}
	};

	messages = { // custom messages for radio buttons and checkboxes
		users_account: {
			required: '帳號不能為空值',
			email: '信箱格式不正確'
		},
		users_email: {
			required: '信箱不能為空值',
			email: '信箱格式不正確'
		},
		users_name: '姓名不能為空值',
		users_phone: '電話不能為空值',
		users_password: {
			required: '密碼不能為空值'
		},
		users_password_again: {
			equalTo: '密碼與確認密碼不同'
		}
	};

    FormValidation.init(rules, messages);
});