/*
 * global variables
 */
var 
	price = 0
,	bifold_update_handle = null
,	hinge_warning_shown = false
,	colourmatch = true
;


/*
 * page functionality
 */
$(function () {

	// set up the option tabs
	prepare_option_tabs();

	// call handler for: hover effect for scheme thumbs
	handle_thumbnail_scheme_hover();

	// action the configuration when selected
	action_selected_configuration();

	// action the glass and technical options when selected
	action_configuration_options();

	// action any bootstrap formatted dropdown buttons
	action_dropdown_boxes();

	// handle the help area
	action_help_texts('configuration');


	/*
	 * handles the keyup action on the height field
	 */
	$('#height').keyup(function() {
		var height_str = String(this.value);

		if(height_str.length == 4) {
			validate_height();
		}
	});


	/*
	 * handles the blur action on the height field
	 */
	$('#height').change(function() {
		var height_str = String(this.value);

		if(height_str.length > 0) {
			validate_height();
		} else {
			show_input_error('height', false);
		}
	});


	/*
	 * handles the keyup action for the width field
	 */
	$('#width').keyup(function (e) {
		var width_str = String(this.value);

		if(width_str.length >= 4) {
			validate_width();
		}
	});


	/*
	 * handles the keyup action for the width field
	 */
	$('#width').change(function (e) {
		var width_str = String(this.value);

		if(width_str.length > 0) {
			validate_width();
		} else {
			show_input_error('width', false);
		}
	});


	/*
	 * action the door handle picker when a handle is selected
	 */
	$('a.picker').click(function(e) {
		e.preventDefault();
		$('a.picker').removeClass('selected');
		$(this).addClass('selected');
		$('input[name=handle_position]').val($(this).data('handle-position'));

		// update the image
		update_image_and_price(false, true);
	});


	/*
	 * action the return to configuration option
	 */
	$('a#return-to-configurations').click(function() {
		switch_back_to_configuration_picker();
	});


	/*
	 * handles the selection of chosen colour for selection : internal
	 */
	$('.help-modal-internal-colours').on('click', '.colour-thumb', function(e) {
		$('.help-modal-internal-colours').modal('hide');
		load_internal_colour($(this).data('colour-id'));
	});


	/*
	 * handles the selection of chosen colour for selection : external
	 */
	$('.help-modal-external-colours').on('click', '.colour-thumb', function(e){
		$('.help-modal-external-colours').modal('hide');
		load_external_colour($(this).data('colour-id'));
	});


	/*
	 * handle the show internal colour match tickbox
	 */
	$('div#colourbox-external').on('click', 'label', function() {
		$('input#cb-colourmatch').attr('checked', true);
		$(this).remove();
		colourmatch = false;
		$('div#colourbox-finish').animate({'left': '+=300px'}, '1000', function() {
			$('div#colourbox-internal').fadeIn('slow').removeClass('hidden');
			$(this).removeAttr('style');

			// update the colour match based on the two colour values
			$('#cb-match-external-colour').prop('checked', $('input[name="external_colour_id"]').val() == $('input[name="internal_colour_id"]').val());

			// update the title of the external colour block
			$('span#external-frame-colour-title').fadeOut('slow', function() {
				$(this).html('External Colour').fadeIn('slow');
			});

			// update the finish options
			$('span#external-finish').fadeOut('fast', function() {
				$(this).html('External Finish').fadeIn('slow');
				$('div#internal-finish').fadeIn('slow').removeClass('hidden');
			})
		});
	});


	/*
	 * handle the match external colour match tickbox
	 */
	$('div#colourbox-internal').on('click', 'label#internal-colourmatch', function() {
		var oColourMatch = $('input#cb-match-external-colour');
		if(!$('input#cb-match-external-colour').is(':checked')) {
			// get the external colour details
			var oExternalColourContainer = $('div#colourbox-external');
			var sColourName = $('span.colourname', oExternalColourContainer).html();
			var sExternalColourSource = $('img', oExternalColourContainer).attr('src');

			// set the internal colour details
			var oInternalColourContainer = $('div#colourbox-internal');
			$('span.colourname', oInternalColourContainer).html(sColourName);
			$('img', oInternalColourContainer).attr('src', sExternalColourSource);
		} else {
			// load the internal colour picker
			$('div#colourbox-internal a').click();
		}
	});


	/*
	 * handle the selection of the hardware1 handle colour picker
	 */
	$('div#hardware1 div#slave-handle-colour-picker div.col-xs-3 a').click(function(e) {
		e.preventDefault();

		// get the grandparent of this 
		var oParent = $(this).parent().parent();

		// remove all class values of 'selected' from all links within this grandparent group
		$('a', oParent).removeClass('selected');

		// add the selected class to the selected colour
		$(this).addClass('selected');

		// set the handle colour
		$('input[name=slave_handle_colour_id]').val($(this).data('ral'));
	});


	/*
	 * handle the selection of the hardware1 hinge colour picker
	 */
	$('div#hardware1 div#hinges-colour-picker div.col-xs-3 a').click(function(e) {
		e.preventDefault();

		// get selected option
		var oHingeColour = $(this);

		// set the hinge colours on both hardware areas
		set_hinge_colour(oHingeColour, oHingeColour.data('ral'), 1);

		// update the image
		update_image_and_price(false, true);
	});


	/*
	 * handle the hardware2 hinge picker
	 */
	$('div#hardware2 select[name=hinge-colour]').change(function() {
		// get selected option
		var oHingeColour = $(this).find(':selected');

		// set the hinge colours on both hardware areas
		set_hinge_colour(oHingeColour, oHingeColour.val(), 2);

		// update the image
		update_image_and_price(false, true);
	});


	/*
	 * handle the hardware2 traffic handle external colour
	 */
	$('div#hardware2 select[name=traffic-handle-external-colour]').change(function() {
		// get selected option
		var oExternalTrafficColour = $(this).find(':selected');

		// set the handle colour
		$('input[name=master_handle]').val(oExternalTrafficColour.val());

		// if the value is set to none, show warning message
		if(oExternalTrafficColour.val() == '0') {
			var message = '<small>If the option for no external handle is selected then the doors can only be opened from the inside of the room.</small>';
			$('div.modal div#warning-message').html(message);
			$('div.warning-message').modal('show');
		}

		// update the image
		update_image_and_price(false, true);
	});


	/*
	 * handle the hardware2 slave handle internal colour
	 */
	$('div#hardware2 select[name=traffic-handle-internal-colour]').change(function() {
		// get selected option
		var oInternalTrafficColour = $(this).find(':selected');

		// set the handle colour
		$('input[name=slave_handle_colour_id]').val(oInternalTrafficColour.val());
	});


	/*
	 * handles the in out options from step 2
	 */
	$('div.step1direction div.optionbtns a').click(function() {
		$('div.step1direction div.optionbtns a').removeClass('active');
		$(this).addClass('active');
		$('input[name=opening]').val($(this).data('direction'));
	});

	// action the next step button
	$('div#submit').click(function() {
		var width_ok = validate_width();
		var height_ok = validate_height();
		if(!width_ok || !height_ok) {
			e.preventDefault();
		} else {
			$('form#primaryform').submit();
		}
	});



	$('label.css-label').click(function() {
		var oContainer = $('div.type-container');
		var oType = $(this, oContainer);

		// deselect the options
		$('input[name=type]', oContainer).attr('checked', false);
		$('label', oContainer).removeClass('selected');

		// set the selected option
		$('input#'+ oType.attr('for')).attr('checked', true);
		$(this).addClass('selected');

		// set parent hidden field
		$('input[name=supply_type]').val(oType.data('value'));

		// update the image
		update_image_and_price(true, false);
	});


	// show the help file for each technical option
	$('div.more-info').click(function() {
		var help = $('div.' + $(this).data('help'));
		help.modal('show');
	});

	//$('#request-quote').on('click', function() {
	//	$('form#primaryform').submit();
	//});

	$('form#primaryform').validator().on('submit', function (e) {
	    if (e.isDefaultPrevented()) {
	      // handle the invalid form...
	    } else {
			$('#request-quote').val('Processing...');
			$('#request-quote').prop('disabled', true);
	    }
	})

});



/**
 * page functions
 */



/*
 * action the tabs for the configurator options
 */
function prepare_option_tabs() {
	$('#myTabs a').click(function (e) {
		e.preventDefault()
		// only allow a child tab to be clicked if step 1 is complete
		if($('input[name=sliding_door_scheme_id]').val()!='') {
			$(this).tab('show');
			$('div#submit').fadeIn('slow').removeClass('hidden');

			// show help section for selected tab
			var section = $(this).data('section');
			action_help_texts(section);

			// clear up the next and prev buttons
			$('div.action').removeClass('nope');
			var tab = $(this).parent().data('tab');
			switch(tab)
			{
				case 1:
					$('div.action[data-action=prev]').addClass('nope');
					break;
				case 4:
					$('div.action[data-action=next]').addClass('nope');
					break;
			}

		} else {
			if($('input#width').val() != '' && $('input#height').val() != '') {
				$('span#step3-warning').fadeIn('fast').removeClass('hidden');
			} else {
				// flash the width and height fields
				$('input#width').focus().addClass('has-error');
				$('input#height').addClass('has-error');
			}
		}
	});

	// add count to tabs
	var tab = 1;
	$('#myTabs li').each(function() {
		$(this).addClass('tab-'+ tab).attr('data-tab', tab);
		tab++;
	});


	// action the prev / next and submit buttons
	$('div.action').click(function(e) {
		e.preventDefault();
		var action = $(this).data('action');

		// ensure we can action a move
		if($('input#width').val() == '' || $('input#height').val() == '') {
			$('ul#myTabs li.tab-1 a').click();
			$('div.action[data-action=prev]').addClass('nope');
			return;
		}

		// remove any nopes
		$('div.action').removeClass('nope');

		// move to tab based on direction
		if(action == 'prev' || action == 'next') {
			var selected_tab = $('ul#myTabs li.active').data('tab');
			selected_tab = ( action == 'next' ) ? selected_tab = selected_tab + 1 : selected_tab = selected_tab - 1;
			if(selected_tab <= 1 || selected_tab >= 5) {
				$(this).addClass('nope');
			}
			$('ul#myTabs li.tab-'+ selected_tab +' a').click();
		}
	});
}


/*
 * handles the error class for the given field
 * @param field		the name of the field being targeted
 * @param boolyn	true/false value for the action to perform
 */
function show_input_error (field, boolyn) {
	var element = $('#'+ field);
	if(boolyn) {
		// add class to highlight the field with the error
		element.addClass('has-error');
	} else {
		// remove any error class from the field
		element.removeClass('has-error');

		// get the available configurations from the width and height input
		get_configurations();
	}
}


/*
 * validates the given height
 */
function validate_height() {
	var height_input = $('#height');
	var height_val = parseInt(height_input.val());
	if(isNaN(height_val)) {
		height_val = 0;
	}

	if(height_val < height_input.data('min') || height_val > height_input.data('max')) {
		show_input_error('height', true);
        var oConfig = $('div.configoption');
        oConfig.html('<div class="config-waiting"><p>Enter your sizes to view further options</p></div>');
        reset_selected_options();
		return false;
	} else {
		show_input_error('height', false);
		return true;
	}
}


/*
 * validates the given width
 */
function validate_width() {
	var width_input = $('#width');
	var width_val = parseInt(width_input.val());
	if(isNaN(width_val)) {
		width_val = 0;
	}

	if(width_val < width_input.data('min') || width_val > width_input.data('max')) {
		show_input_error('width', true);
        var oConfig = $('div.configoption');
        oConfig.html('<div class="config-waiting"><p>Enter your sizes to view further options</p></div>');
        reset_selected_options();
		return false;
	} else {
		show_input_error('width', false);
		return true;
	}
}


/*
 * gets the available configurations based on the given width and height
 */
function get_configurations() {
	// get the width and height fields
	var oWidth = $('#width');
	var oHeight = $('#height');

	// ensure both fields pass the rules for getting configuration data
	// if( oWidth.hasClass('has-error') || oHeight.hasClass('has-error') || oWidth.val().length != 4 || oHeight.val().length != 4 || isNaN(oWidth.val()) || isNaN(oHeight.val()) ) {
	if( oWidth.hasClass('has-error') || oHeight.hasClass('has-error') || oHeight.val().length != 4 || isNaN(oWidth.val()) || isNaN(oHeight.val()) ) {
		return false;

	// both fields pass rules, get the configurations
	} else {
		// update_price_and_image_step1();
		
		var iWidth = parseInt(oWidth.val());
		var iHeight = parseInt(oHeight.val());

		// get the configurations
		scheme_lookup_handle = $.post(site_url + 'ajax/get_scheme_choices', $('#primaryform').serialize(), function (e) {

			// if the styles returned are not already loaded, then update the options

			var oConfig = $('div.configoption');

			if (e.status == false) {

				oConfig.html('<div class="config-waiting"><p>Enter your sizes to view further options</p></div>');
				oConfig.attr('data-loaded-configurations', e.styles);
				reset_selected_options();

			} else {
				//if (oConfig.attr('data-loaded-configurations') != e.styles) {
					// draw configurations
					oConfig.html(e.html);

					// set the styles returned
					oConfig.attr('data-loaded-configurations', e.styles);

					// clear previous settings
					reset_selected_options();
				//}
			}
		});
	}
}


/*
 * handles the hover effect for the scheme thumbs
 */
function handle_thumbnail_scheme_hover() {
	// show the thumbnail hover icon when cursor moves over target scheme
	$('div.configoption').on('mouseenter', 'div.configoptionbox', function(e) {
		// if the hovered over option is not already selected, then show the hover image
		if(!$('a', $(this)).hasClass('active')) {
			// show the hover image
			$('img.normal', $(this)).addClass('hidden');
			$('img.hover', $(this)).removeClass('hidden');
		}
	}).on('mouseleave', 'div.configoptionbox', function(e) {
		if(!$('a', $(this)).hasClass('active')) {
			// hide the hover image
			$('img.normal', $(this)).removeClass('hidden');
			$('img.hover', $(this)).addClass('hidden');
		}
	});
}


/*
 * handles actions when a configuration is selected from those displayed
 */
function action_selected_configuration() {
	$('div.configoption').on('click', 'a[data-scheme-id]', function(e) {
		e.preventDefault();
		var oForm = $('form#primaryform');
		var oDoor = $(this);
		var oDoorOptions = oDoor.parent('div.configoptionbox');

		// remove pick warning
		$('span#step3-warning').fadeOut('fast');

		// get the configuration data
		var iScheme = oDoor.data('scheme-id');
		var sConfiguration = oDoor.data('configuration');
		var bUpdateHandlePosition = ( $('input[name=configuration]').val() != sConfiguration ) ? true : false;
		var sHardwareOptionGroup = $(this).parent().data('hardware-picker');

		// set initial handle position
		var sHandlePosition = oDoor.data('handle-on');
		// var sSlidingPosition = oDoor.data('slide-to');

		// set the required fields based on the selected door type
		$('input[name=sliding_door_scheme_id]', oForm).val(iScheme);

		// set the number of panels
		$('input[name=number_panels]').val(oDoor.data('panels'));

		// set the sliding position
		// $('input[name=sliding_direction]').val(sSlidingPosition);

		// set the handle position
		$('input[name=handle_position]').val(sHandlePosition);

		// set the required data for the selected configuration
		$('.step1configuration .configoption a.active').removeClass('active');
		$(this).addClass('active');

		/*
		// show the hover image for the selected scheme
		$('.step1configuration .configoption a img.normal').removeClass('hidden');
		$('.step1configuration .configoption a img.hover').addClass('hidden');
		$('img.hover', $(this)).removeClass('hidden');
		$('img.normal', $(this)).addClass('hidden');
		*/

		// show tick on the option selected
		$('.step1configuration .configoption a img.normal').removeClass('hidden');
		$('.step1configuration .configoption a img.hover').addClass('hidden');
		$('img.hover', $(this)).addClass('hidden');
		$('img.normal', $(this)).removeClass('hidden');

		/*
		// if we have a handle to choose, get it - not needed for the sliding doors
		if(typeof $(this).parent('div.configoptionbox').attr('data-handle') !== 'undefined') {
			// prepare the doors to be picked
			$('a.picker.left img').attr('src', base_url+'/assets/images/partials/left-'+ oDoorOptions.data('panels-left') +'.png');
			$('a.picker.right img').attr('src', base_url+'/assets/images/partials/right-'+ oDoorOptions.data('panels-right') +'.png');

			// set the handle back to default position if required
			if( bUpdateHandlePosition ) {
				$('input[name=handle_position]').val(sHandlePosition);
			}

			// return false;
			$('div#step1-1').fadeOut('fast', function() {
				// load in the step 1-2 layout
				$('div#step1-2').removeClass('hidden').fadeIn('fast', function() {
					// check if we need to clear the existing door handle selected
					if($('div.handle-picker-container').attr('data-configuration') != sConfiguration) {
						// clear the selected handle visual
						$('div.handle-picker-container a').removeClass('selected');
					}

					// assign selected configuration to the handle container
					$('div.handle-picker-container').attr('data-configuration', sConfiguration);
				});
			});
		} else {
			// set the handle back to default position if required
			if( bUpdateHandlePosition ) {
				$('input[name=handle_position]').val(sHandlePosition);
			}
		}
		*/

		// show the appropriate hardware options
		$('div#hardware div.group').addClass('hidden');
		$('div#hardware div#hardware-content').removeClass('hidden');
		$('div#hardware div#'+sHardwareOptionGroup).removeClass('hidden');

		// get the price for this configuration
		update_image_and_price();
	});
}


/*
 * resets all user set options when the configurations are reset
 */
function reset_selected_options() {
	// clear input fields
	$('input[name=sliding_door_scheme_id]').val('');

	// clear dom triggers
	$('div.handle-picker-container a').removeClass('selected');

	// hide the next step button - user should select required config after scheme change
	$('div#submit').addClass('hidden');

	// switch back to main configuration step
	switch_back_to_configuration_picker();
}


/*
 * switch back to main configuration step
 */
function switch_back_to_configuration_picker() {
	// $('tr#return-to-step-1-1').fadeOut('fast');
	$('div#step1-2').fadeOut('fast', function() {
		$('div#step1-1').fadeIn('fast');
	});
}


/*
 * updates the image and price but allow the skipping of either the image update or the price update
 */
function update_image_and_price(skip_image, skip_price) {
	skip_image = ( skip_image == undefined ) ? false : skip_image;
	skip_price = ( skip_price == undefined ) ? false : skip_price;

	if(bifold_update_handle != null){
		bifold_update_handle.abort();
	}

	// if both skips are true, what's the point ?
	if(skip_image && skip_price) return;

	// if we have to skip the image, we'll only need to update the price
	if(skip_image) {
		// perform call to get the price
		$.post(site_url + 'ajax/get_basic_price', $('#primaryform').serialize(), function (e) {
			price = ( e.result ? e.html : '----' );
			$('span#price').html(price);
			set_net_and_vat(e.net, e.vat);
		});

	} else {

		// show the overlay
		var oConfigOverlay = $('div.step1doorimg div.overlay');
		oConfigOverlay.removeClass('hidden');

		// update the preview image
		bifold_update_handle = $.post(site_url + 'ajax/update_bifold', $('#primaryform').serialize(), function() {
			// get the url of the updated image
			var url = site_url + 'ajax/get_current_image?'+MBF_SID+'#' + new Date().getTime();

			// set the image src
			$('div.step1doorimg img#door-preview').attr('src', url);

			// get the price
			if( !skip_price ) {
				$.post(site_url + 'ajax/get_basic_price', $('form').serialize(), function(e) {
					price = ( e.result ? e.html : '----' );
					$('span#price').html(price);
					set_net_and_vat(e.net, e.vat);
					
					// hide the overlay
					oConfigOverlay.addClass('hidden');
				});
			} else {
				// just hide the overlay
				oConfigOverlay.addClass('hidden');
			}
		});
	}
}


/*
 * displays the net and vat on the final summary page
 */
function set_net_and_vat(net, vat) {
	if($('h3 span#net').length > 0) {
		$('span#net', 'h3').html(net);
		$('span#vat', 'h3').html(vat);
	}
}


/*
 * loads the colour picker for : internal selection
 */
function load_internal_colour(id) {
	$('input[name="internal_colour_id"]').val(id);
	$('#colourbox-internal').addClass('cb-loading').removeClass('cb-loaded');

	$('#colourbox-internal').load(site_url + 'ajax/get_colour_box/internal/' + id + '/' + ($('input[name="external_colour_id"]').val() == $('input[name="internal_colour_id"]').val() ? 1 : 0), function(){
		$('#colourbox-internal').addClass('cb-loaded').removeClass('cb-loading');

		// update the colour match based on the two colour values
		$('#cb-match-external-colour').prop('checked', $('input[name="external_colour_id"]').val() == $('input[name="internal_colour_id"]').val());
	});
}


/*
 * actions the selected colour from the colour picker for : external selection
 */
function load_external_colour(id) {
	$('input[name="external_colour_id"]').val(id);
	$('#colourbox-external').addClass('cb-loading').removeClass('cb-loaded');

	// get the updated colour and set the response to the container
	$('#colourbox-external-container').load(site_url + 'ajax/get_colour_box/external/' + id, function() {
		$('#cb-colourmatch').prop('checked', $('input[name="external_colour_id"]').val() == $('input[name="internal_colour_id"]').val());
		$('#colourbox-external').addClass('cb-loaded').removeClass('cb-loading');

		// if customer has not displayed the internal colour, then set internal to match external
		if(colourmatch) {
			// get the external colour details
			var oExternalColourContainer = $('div#colourbox-external');
			var sColourName = $('span.colourname', oExternalColourContainer).html();
			var sExternalColourSource = $('img', oExternalColourContainer).attr('src');

			// update the internal colour options
			var oInternalColourContainer = $('div#colourbox-internal');
			$('input[name="internal_colour_id"]').val(id);
			$('span.colourname', oInternalColourContainer).html(sColourName);
			$('img', oInternalColourContainer).attr('src', sExternalColourSource);
		}

		// update the colour match based on the two colour values
		$('#cb-match-external-colour').prop('checked', $('input[name="external_colour_id"]').val() == $('input[name="internal_colour_id"]').val());
	});

	// update image
	update_image_and_price();
}


/*
 * sets the related hinge options on the hardware1 and hardware2 options
 */
function set_hinge_colour(obj, colour, group) {
	var recommended = false;
	if(group == 1) {
		// action for hardware group 1
		var oHardware1HingePicker = $('div#hinges-colour-picker');

		// remove all class values of 'selected' from all links within this grandparent group
		$('a', oHardware1HingePicker).removeClass('selected').each(function() {
			if($(this).attr('data-ral') == colour) {
				$(this).addClass('selected');
			}
		});

		// get the recommended value
		if( obj.parent().attr('data-recommended') == 'true' ) {
			recommended = true;
		}
	} else {
		// action for hardware group 2
		$('div#hardware2 select[name=hinge-colour] option').each(function() {
			if($(this).val() == colour) {
				$(this).parent().val(colour);
			}
		});

		// get the recommended value
		if(obj.attr('data-recommended') == 'true') {
			recommended = true;
		}
	}

	// set the value field
	$('input[name=hinge_colour_id]').val(colour);
}


/*
 * handle any clicks to options within a ul.click-options list
 */
function action_configuration_options() {
	$('ul.click-options > li').click(function() {
		var oSelectedOption = $(this);
		var oContainer = oSelectedOption.parent();
		var sTarget = oSelectedOption.parent().data('target');
		var message = '';

		// if this option cannot be clicked, do not process the click
		if(oSelectedOption.hasClass('unclickable')) return;

		// clear selected option from this group and add selected to the chosen option
		$('li', oContainer).removeClass('selected');
		oSelectedOption.addClass('selected');

		// set the value of the selected to option to the bound field
		$('input[name='+ sTarget +']').val(oSelectedOption.data('value'));


		// -- rules

		// check if we need to show the threshold warning message
		if(oContainer.attr('data-target') == 'threshold_id' && oContainer.data('warning-shown') == false && oSelectedOption.data('value') == '2') {
			oContainer.data('warning-shown', true);
			message = '<small>Whilst a low threshold is available we highly recommend choosing a standard threshold for various technical and relevant reasons.</small>';
			$('div.modal div#warning-message').html(message);
			$('div.warning-message').modal('show');
		}

		// rules for the cill option
		if(oContainer.attr('data-target') == 'cill') {
			if(oSelectedOption.data('value') == '1' || oSelectedOption.data('value') == '2') {
				$('div.threshold ul li').removeClass('selected');
				$('div.threshold ul li[data-value=1]').addClass('selected');
				$('div.threshold ul li[data-value=2]').addClass('faded').addClass('unclickable');
				$('input[name=threshold_id]').val('1');
			} else {
				$('div.threshold ul li[data-value=2]').removeClass('faded').removeClass('unclickable');
			}
		}


		// update the image and price
		update_image_and_price();
	});
}


/*
 * handle any bootstrap formatted dropdowns
 */
function action_dropdown_boxes() {
	$('div.dropdown ul li a').click(function() {
		// get the selected dropdown option
		var oOption = $(this);

		// get the containing div for the dropdown
		var oContainer = oOption.closest('div.dropdown');

		// get the selected value of the option
		var selected_value = oOption.data('value');

		// replace the text within the parent button to reflect the selected option
		$('button span.title', oContainer).html(oOption.html());

		// update the target field with the value IF the target field exists
		if($('input[name='+ oContainer.data('target') +']').length > 0) {
			$('input[name='+ oContainer.data('target') +']').val(oOption.data('value'));
		}

		// show the glass options on the image preview
		$('input[name=show_glass_options]').val('1');

		// -- rules

		// if the customer has selected a tint, set the self cleaning option to no - self cleaning only available on clear glass
		if($('input[name=tint_id]').val() != '1') {
			// get the second option from the self cleaning option
			var self_cleaning = $('div.dropdown[data-target=glass_id] li:nth-child(1) a');

			// set the default option to no
			$('div.dropdown[data-target=glass_id] button span.title').html(self_cleaning.html() +' ( Only available on Clear Tint )');

			// set the target field 
			$('input[name=glass_id]').val(self_cleaning.data('value'));
		}

		// action any additional calls
		if(oContainer.data('update-image') == true) {
			update_image_and_price();
		}
	});
}


/*
 * handle the help texts
 */
function action_help_texts(section) {
	$('div.step1details div.tips').hide();
	var open_section = $('div#sideinfo-'+ section);
	open_section.show();
}