jQuery(document).ready(function() {
	rules = {
		qa_question: {
			required: true
		},
		qa_answer: {
			required: true
		},
		qa_sort: {
			required: true
		},
	};

	messages = {
		qa_question:'問題不能為空值',
		qa_answer: '答案不能為空值',
		qa_sort: '排序不能為空值',
	};

    FormValidation.init(rules, messages);
});