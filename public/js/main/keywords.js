jQuery(document).ready(function() {
	rules = {};
	messages = {};

    FormValidation.init(rules, messages);
});

var datatablesInit = function(){
	var table = $('#lists_sort').DataTable({
		rowReorder     : true,
		searching      : false,
		iDisplayLength : 4,
		aLengthMenu    : [4],
		columns        : [
			{ orderable: false },
			{ orderable: false }
		]
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
	$.get('/keywords/sortAjax/sort/'+id+'/'+sort, function(res){});
}

$(function(){

	if( $('#lists_sort').length > 0 ){
		datatablesInit();

		//關閉分頁
		$('#lists_sort_wrapper .row').css('display', 'none');
	}
});