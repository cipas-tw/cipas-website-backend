jQuery(document).ready(function() {
	rules = {
		slider_banner_title: {
			required: true
		},
		slider_banner_url: {
			required: true,
			url: true
		}
	};

	messages = {
		slider_banner_title:'標題不能為空值',
		slider_banner_url:  {
			required: '連結不能為空值',
			url: '連結格式不正確'
		},
	};

    FormValidation.init(rules, messages);

    $('#slider_banner_type').change(function(){
    	showImgSetting($(this).val());
    });
    if(typeof($('#tmp_file').val()) != 'undefined'){
    	uploadFile.applyAjaxFileUpload('#tmp_file');
    }

});

function showImgSetting(type){
	if(type == 1){
		$('.imgSetting').show();
	} else {
		$('.imgSetting').hide();
	}
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
	$.get('/banners/sortAjax/sort/'+id+'/'+sort, function(res){});
}

$(function(){
	if( $('#lists_sort').length > 0 ){
		datatablesInit();
	}
});