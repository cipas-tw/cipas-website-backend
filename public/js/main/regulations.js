var rules, messages ;

jQuery(document).ready(function() {
	rules = {
		law_title: {
			required: true
		},
		law_content: {
			required: true
		},
		law_chapter_title: {
			required: true
		},
		law_chapter_sort: {
			required: true
		},
		law_meta_description: {
			maxlength: 30
		},
		'law_terms_numbering[]': {
			required: true
		},
		'law_terms_content[]': {
			required: true
		}
		
	};

	messages = {
		law_title:'標題不能為空值',
		law_content:'法規沿革不能為空值',
		law_chapter_title:'標題不能為空值',
		law_chapter_sort:'排序不能為空值',
		law_meta_description:'說明分享不能超過30字',
		'law_terms_numbering[]':'條文編號不能為空值',
		'law_terms_content[]':'條文不能為空值',
	};

    FormValidation.init(rules, messages);
	$('#file_tbody').children().each(function() {
    	fileId = '#'+$(this).attr('id')+' #tmp_file';
		uploadFile.applyAjaxFileUpload(fileId);
	});

});

var addNumber = $('#tbody').children().length;
var addFileNumber = $('#file_tbody').children().length;

// 新增附件 Abby
function addRow(){

	template = $('#template').html();
	sortNumber = parseInt($($('#tbody tr')[($('#tbody tr').length-1)]).find('[id=law_terms_sort]').val())+1;
	addNumber++;

	$('#tbody').append(template);
	$("#tbody #row").attr("id","row_"+addNumber);
	$("#tbody #row_"+addNumber+" #law_terms_sort").val(sortNumber);
	$("#tbody #row_"+addNumber+" #delRow").attr("onclick","delRow("+addNumber+")");
}
// 刪除附件
function delRow(addNumber){
	//if($('#tbody tr').length >1){
		$('#row_'+addNumber).remove();
	//} else {
		//alert('至少需新增一筆條文！');
	//} 

}

// 新增附件 Abby
function addFile(){

	fileTemplate = $('#fileTemplate').html();
	addFileNumber++;
	$('#file_tbody').append(fileTemplate);
	$("#file_tbody #fileRow").attr("id","fileRow_"+addFileNumber);
	$("#file_tbody #fileRow_"+addFileNumber+" #delFile").attr("onclick","delFileRow("+addFileNumber+")");
	uploadFile.applyAjaxFileUpload('#fileRow_'+addFileNumber+' #tmp_file');

}
// 刪除附件
function delFileRow(addFileNumber){
	$('#fileRow_'+addFileNumber).remove();
}
