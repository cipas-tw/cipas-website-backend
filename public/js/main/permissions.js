jQuery(document).ready(function() {

	rules = {
		backend_menu_permission_name: {
			required: true
		}
	};

	messages = {
		backend_menu_permission_name:'權限名稱不能為空值'
	};

    FormValidation.init(rules, messages);
});