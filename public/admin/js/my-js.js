$(document).ready(function() {
	let $btnSearch        = $("button#btn-search");
	let $btnClearSearch	  = $("button#btn-clear-search");

	let $inputSearchField = $("input[name  = search_field]");
	let $inputSearchValue = $("input[name  = search_value]");
	let $selectChangeAttr = $("select[name = select_change_attr]");

	$("a.select-field").click(function(e) {
		e.preventDefault();

		let field 		= $(this).data('field');
		let fieldName 	= $(this).html();
		$("button.btn-active-field").html(fieldName + ' <span class="caret"></span>');
    	$inputSearchField.val(field);
	});

	$btnSearch.click(function() {

		var pathname	= window.location.pathname;
		let params 		= ['filter_status'];
		let searchParams= new URLSearchParams(window.location.search);	// ?filter_status=active

		let link		= "";
		$.each( params, function( key, param ) { // filter_status
			if (searchParams.has(param) ) {
				link += param + "=" + searchParams.get(param) + "&" // filter_status=active
			}
		});
		
		let search_field = $inputSearchField.val();
		let search_value = $inputSearchValue.val();

		if(search_value.replace(/\s/g,"") == ""){
			alert("Nhập vào giá trị cần tìm !!");
		} else {
			window.location.href = pathname + "?" + link + 'search_field='+ search_field + '&search_value=' + search_value;
		}
	});

	$btnClearSearch.click(function() {
		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);

		params 			= ['filter_status'];

		let link		= "";
		$.each( params, function( key, param ) {
			if (searchParams.has(param) ) {
				link += param + "=" + searchParams.get(param) + "&"
			}
		});

		window.location.href = pathname + "?" + link.slice(0,-1);
	});

	$('.btn-delete').on('click', function() {
		if(!confirm('Bạn có chắc muốn xóa phần tử?'))
			return false;
	});

	$selectChangeAttr.on('change', function() {
		let selectValue = $(this).val();
		let url = $(this).data('url');
		console.log(url.replace('value_new', selectValue));
		window.location.href = url.replace('value_new', selectValue);
	});
});