jQuery(document).ready(function() {
	rules = {
		commissioner_name: {
			required: true
		}
	};

	messages = {
		commissioner_name:'姓名不能為空值'
	};

    FormValidation.init(rules, messages);
    $('#note_tbody').children().each(function() {
    	noteId = '#'+$(this).attr('id')+' #tmp_note';
	});
	if(typeof($('#tmp_file').val()) != 'undefined'){
    	uploadFile.applyAjaxFileUpload('#tmp_file');
    }


	if( $('#lists_sort').length > 0 ){
		datatablesInit();
	}

});

var addExperienceNumber = $('#experience_tbody').children().length;
var addEducationNumber = $('#education_tbody').children().length;

// 新增 Abby
function addExperience(){

	template = $('#template_experience').html();
	addExperienceNumber++;
	$('#experience_tbody').append(template);
	$("#experience_tbody #row").attr("id","experienceRow_"+addExperienceNumber);
	$("#experience_tbody #experienceRow_"+addExperienceNumber+" #delRow").attr("onclick","delExperienceRow("+addExperienceNumber+")");
}
// 刪除
function delExperienceRow(addExperienceNumber){
	$('#experienceRow_'+addExperienceNumber).remove();
}


// 新增 Abby
function addEducation(){

	template = $('#template_education').html();
	addEducationNumber++;
	$('#education_tbody').append(template);
	$("#education_tbody #row").attr("id","educationRow_"+addEducationNumber);
	$("#education_tbody #educationRow_"+addEducationNumber+" #delRow").attr("onclick","delEducationRow("+addEducationNumber+")");
}

// 刪除
function delEducationRow(addNoteNumber){
	$('#educationRow_'+addNoteNumber).remove();
}

var datatablesInit = function(){
	var table = $('#lists_sort').DataTable({
		rowReorder     : true,
		searching      : false,
		iDisplayLength : 100,
		aLengthMenu    : [100],
		columns        : [
			{ orderable: false },
			{ orderable: false },
			{ orderable: false },
			{ orderable: false }
		],
		paging : false,
		bInfo  : false,
	});
	table.on('row-reorder', function (e, diff, edit) {
		for (var i = 0, ien = diff.length ; i < ien ; i++) {
			sortAjax($(diff[i].node).data('id'), diff[i].newData)
		}
	});
}
var sortAjax = function(id, sort){
	if( id == 0 ){
		return false;
	}
	$.get('/members/sortAjax/sort/'+id+'/'+sort, function(res){});
}
