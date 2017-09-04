jQuery(document).ready(function() {
	rules = {
		files_title: {
			required: true
		},
		collect_plan_title: {
			required: true
		},
		collect_plan_content: {
			required: function() {
				CKEDITOR.instances.content.updateElement();
			}
		},
		collect_plan_meta_description: {
			maxlength: 30
		},
	};

	messages = {
		files_title:'標題不能為空值',
		collect_plan_title:'標題不能為空值',
		collect_plan_content:'內文不能為空值',
		collect_plan_meta_description:'說明分享不能超過30字',
	};

    FormValidation.init(rules, messages);
    $('#file_tbody').children().each(function() {
    	fileId = '#'+$(this).attr('id')+' #tmp_file';
		uploadFile.applyAjaxFileUpload(fileId);
	});
});

var addFileNumber = $('#file_tbody').children().length;

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
