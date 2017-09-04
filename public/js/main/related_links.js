jQuery(document).ready(function() {

	rules = {
		related_links_title: {
			required: true
		},
		related_links_url: {
			required: true,
			url: true
		},
		related_links_sort: {
			required: true
		},
	};

	messages = {
		related_links_title:'標題不能為空值',
		related_links_url:{
			required: '連結不能為空值',
			url: '連結格式不正確'
		},
		related_links_sort:'排序不能為空值',
	},

    FormValidation.init(rules, messages);
});
