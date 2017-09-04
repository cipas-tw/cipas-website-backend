jQuery(document).ready(function() {
	rules = {
		notes_publish_title: {
			required: true
		},
		notes_publish_content: {
			required: function() {
				CKEDITOR.instances.content.updateElement();
			}
		},
	};

	messages = {
		notes_publish_title:'標題不能為空值',
		notes_publish_content:'內文不能為空值',
	};

    FormValidation.init(rules, messages);
    $('#file_tbody').children().each(function() {
    	fileId = '#'+$(this).attr('id')+' #tmp_file';
		uploadFile.applyAjaxFileUpload(fileId);
	});
	//uploadFile.applyAjaxFileUpload('#tmp_file');
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
