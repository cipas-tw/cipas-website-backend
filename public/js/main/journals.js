jQuery(document).ready(function() {

	rules = {
		journal_title: {
			required: true
		},
		journal_show_date: {
			required: true
		},
		journal_content: {
			required: function() {
				CKEDITOR.instances.content.updateElement();
			}
		},
		journal_meta_description: {
			maxlength: 30
		}
	};

	messages = {
		journal_title:'標題不能為空值',
		journal_show_date:'發佈日期不能為空值',
		journal_content:'內文不能為空值',
		journal_meta_description:'說明分享不能超過30字',
	};

    FormValidation.init(rules, messages);
    $('#file_tbody').children().each(function() {
    	fileId = '#'+$(this).attr('id')+' #tmp_file';
		uploadFile.applyAjaxFileUpload(fileId);
	});
	uploadFile.applyAjaxFileUpload('#tmp_file');
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
