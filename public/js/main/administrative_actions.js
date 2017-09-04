jQuery(document).ready(function() {
	rules = {
		adm_act_title: {
			required: true
		},
		'adm_act_note_date[]': {
			required: true
		},
		'adm_act_note_title[]': {
			required: true
		},
		'adm_act_note_content[]': {
			required: function() {
				for(var i in CKEDITOR.instances) {
					CKEDITOR.instances[i].updateElement();
				}
			}
		},
		'adm_act_note_hyperlinks[]': {
			url: true
		},
		adm_act_meta_description: {
			maxlength: 30
		}
	};

	messages = {
		adm_act_title:'標題不能為空值',
		'adm_act_note_date[]':'日期不能為空值',
		'adm_act_note_title[]':'標題不能為空值',
		'adm_act_note_content[]':'內文不能為空值',
		'adm_act_note_hyperlinks[]':  {
			url: '連結格式不正確'
		},
		adm_act_meta_description:'說明分享不能超過30字',
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
	$('#noteRow_'+addNoteNumber+ ' td').first().children().last().children().last().children().attr("id", "adm_act_note_content["+addNoteNumber+"]");
    CKEDITOR.replace("adm_act_note_content["+addNoteNumber+"]");
}
// 刪除附件
function delRow(addNoteNumber){
	if($('#note_tbody tr').length >1){
		$('#noteRow_'+addNoteNumber).remove();
	} else {
		alert('至少需新增一筆記事！');
	}
}
