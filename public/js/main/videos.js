jQuery(document).ready(function() {

	rules = {
		video_title: {
			required: true,
		},
		video_url: {
			required: true,
			url: true,
		},

	};

	messages = {
		video_title:'標題不能為空值',
		video_url:{
			required:'連結不能為空值',
			url:'連結格式不正確',
		},
	};

    FormValidation.init(rules, messages);
});
