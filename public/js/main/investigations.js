jQuery(document).ready(function() {
	
	rules = {
		survey_title: {
			required: true
		},
		'survey_note_date[]': {
			required: true
		},
		'survey_note_title[]': {
			required: true
		},
		'survey_note_content[]': {
			required: function() {
				for(var i in CKEDITOR.instances) {
					CKEDITOR.instances[i].updateElement();
				}
			}
		},
		'survey_note_hyperlinks[]': {
			url: true
		},
		survey_meta_description: {
			maxlength: 30
		}
	};

	messages = {
		survey_title:'標題不能為空值',
		'survey_note_date[]':'日期不能為空值',
		'survey_note_title[]':'標題不能為空值',
		'survey_note_content[]':'內文不能為空值',
		'survey_note_hyperlinks[]':  {
			url: '連結格式不正確'
		},
		survey_meta_description:'說明分享不能超過30字',
	};

	FormValidation.init(rules, messages);
    $('#note_tbody').children().each(function() {
    	noteId = '#'+$(this).attr('id')+' #tmp_note';
	});
	uploadFile.applyAjaxFileUpload('#tmp_file');
});

var addNoteNumber = $('#note_tbody').children().length;

// 新增附件 Abby
function addNote(){

	template = $('#template').html();
	addNoteNumber++;
	$('#note_tbody').append(template);
	$("#note_tbody #row").attr("id","noteRow_"+addNoteNumber);
	$("#note_tbody #noteRow_"+addNoteNumber+" #delRow").attr("onclick","delRow("+addNoteNumber+")");

	$('#note_tbody #noteRow_'+addNoteNumber+' .date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });
    $('#noteRow_'+addNoteNumber+ ' td').first().children().last().children().last().children().attr("id", "survey_note_content["+addNoteNumber+"]");
    CKEDITOR.replace("survey_note_content["+addNoteNumber+"]");

}
// 刪除附件
function delRow(addNoteNumber){
	if($('#note_tbody tr').length >1){
		$('#noteRow_'+addNoteNumber).remove();
	} else {
		alert('至少需新增一筆記事！');
	}
}
