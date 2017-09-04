jQuery(document).ready(function() {
	rules = {
		repo_list_title: {
			required: true
		},
		repo_list_content: {
			required: true
		},
		repo_list_chapter_title: {
			required: true
		},
		'repo_list_terms_content[]': {
			required: true
		}
	};

	messages = {
		repo_list_title:'標題不能為空值',
		repo_list_content:'法規沿革不能為空值',
		repo_list_chapter_title:'標題不能為空值',
		'repo_list_terms_content[]':'條文不能為空值'
	};

    FormValidation.init(rules, messages);
});

var addNumber = $('#tbody').children().length;

// 新增附件 Abby
function addRow(){

	template = $('#template').html();
	addNumber++;
	sortNumber = parseInt($($('#tbody tr')[($('#tbody tr').length-1)]).find('[id=repo_list_terms_sort]').val())+1;

	$('#tbody').append(template);
	$("#tbody #row").attr("id","row_"+addNumber);
	$("#tbody #row_"+addNumber+" #repo_list_terms_sort").val(sortNumber);
	$("#tbody #row_"+addNumber+" #delRow").attr("onclick","delRow("+addNumber+")");


}
// 刪除附件
function delRow(addNumber){
	if($('#tbody tr').length >1){
		$('#row_'+addNumber).remove();
	} else {
		alert('至少需新增一筆條文！');
	}
}
