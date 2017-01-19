/*
 * page functionality
 */
$(function () {
	// add a focus background to the row clicked
	$('table.admin tbody tr td a').click(function() {
		$('table.admin tbody tr').removeClass('focus');
		$(this).closest('tr').addClass('focus');
	});

	// draws the email sent to customer for this order in the screen modal
	$('a.view-quote-email').click(function() {
		var order = $(this).data('bifold-id');
		$('input[name=order-id]').val(order);
		$.get(site_url + 'ajax/get_quote_email/'+ order +'?PHPSESSID='+ $('table.admin').data('sid'), function(response) {
			var oPopup = $('div#popup');
			$('div.popup-content', oPopup).html(response);
			oPopup.modal('show');
		});
	});

	// set up datatables functionality
	$('.datatable').dataTable({"sPaginationType": "bs_normal",bLengthChange : false, "bSort": false, "iDisplayLength": 50});
	$('.datatable').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
	});

	// print the email
	$('button.print-email').click(function() {
		var table = $('table.admin');
		var order = $('input[name=order-id]').val();
		// window.open('/index.php/ajax/get_quote_email/'+ order +'?PHPSESSID='+ table.data('sid'), 'Print Order', 'width=600,height=800');
		var myWindow=window.open(base_url + 'index.php/ajax/get_quote_email/'+ order +'?PHPSESSID='+ table.data('sid'), 'Print Order', 'width=600,height=800');
		myWindow.document.close();
		myWindow.focus();
		myWindow.print();
	});
});