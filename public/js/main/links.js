jQuery(document).ready(function() {
	rules = {
		hist_link_title: {
			required: true
		},
		hist_link_url: {
			required: true,
			url: true
		}
	};

	messages = {
		hist_link_title:'標題不能為空值',
		hist_link_url:  {
			required: '外部連結不能為空值',
			url: '外部連結格式不正確'
		},
	};

    FormValidation.init(rules, messages);
});