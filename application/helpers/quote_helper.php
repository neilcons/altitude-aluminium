<?php

/*
 * works out the price for the given configuration
 *
 * for the sliding doors pricing there are six matrix sets (x2 by the type of glass), defined within the ags.sliding_door_scheme_price_type table
 * the resulting ags.sliding_door_scheme_price_matrix records need to match the price type along with the selected glass type, ie. either double_glazed or triple_glazed
 * any matrix results priced at zero mean that the size is not available for the given dimensions ( to do with the weight of the glass within the sized frame )
 */
function quote__get_basic_price($required_output = 'json', $format = true, $add_vat = true)
{
	$CI = &get_instance();

	$ret = array();
	$ret['result'] = FALSE;
	$ret['html'] = '';


// 	$ret['result'] = TRUE;
// 	$ret['html'] = 1234;
// 	$CI->output->set_content_type('application/json')->set_output(json_encode($ret));
// return;

	// var to store the build of how the total price is generated
	$build = '';

	// load constants
	if( !defined('CONST_MIN_WIDTH_FRAME') ) {
		$CI->load->model('constants');
		$CI->constants->define_constants();
	}

	// get the current bifold options selected by customer
	$oDoor = $CI->session->current_design;

	// get the required input values
	
	// the configuration id
	// $iScheme_Id = $oBifold->bifold_scheme_id; 	# $CI->input->post('bifold_scheme_id');
	$iScheme_Id = $oDoor->sliding_door_scheme_id;

	$CI = &get_instance();

/*
	// the type of configuration - supply or supply+install
	if( isset($oDoor->supply_type) ) {
		$iSupplyType = isset($oDoor->supply_type) ? $oDoor->supply_type : 1; # default to SUPPLY_ONLY
	} else {
		$CI = &get_instance();
		$iSupplyType = $CI->input->post('supply_type');
	}
*/

	// get the price scheme to use - checks for install, if not found, defaults to supply prices
	// $iDoorSchemePriceType_Id = isset($iSupplyType) && $iSupplyType == 'install' ? 2 : 1;

	// get the width and height
	$iWidth = $oDoor->width;
	$iHeight = $oDoor->height;
	$iWidthMetres = $iWidth / 1000;
	$iHeightMetres = $iHeight / 1000;
	
	// set starting basic quote price
	$dQuotePrice = 0;

	// load the bifold scheme
	$oDoorSchemeModel = new Sliding_Door_Scheme();



// rewrite

	// supply price
	define('CONST_PRICE_TYPE_SUPPLY', 1);
	define('CONST_PRICE_TYPE_INSTALL', 2);
	define('CONST_PRICE_TYPE_GLASS_CLEAR', 3);
	define('CONST_PRICE_TYPE_GLASS_TINTED', 4);
	define('CONST_PRICE_TYPE_GLASS_SELF_CLEAN', 5);
	define('CONST_PRICE_TYPE_TRICKLE_VENTS', 6);

	// set the correct value to use for the start price based on whether it's SUPPLY or INSTALL
	// $iSlidingDoorSchemePriceType = ( $oDoor-> )
	// $iSlidingDoorSchemePriceType = CONST_PRICE_TYPE_SUPPLY;


/*
	// work out what supply_type to use
	if( $CI->input->post('supply_type') != '' ) {
		// get the value from the post data
		$sSupplyType = $CI->input->post('supply_type');
	} else {
		// get the value from the door object
		$sSupplyType = 'supply';
	}

	// which basic price matrix to use - SUPPLY or INSTALL
	// $iSlidingDoorSchemePriceType = ( $sSupplyType == 'supply' ) ? CONST_PRICE_TYPE_SUPPLY : CONST_PRICE_TYPE_INSTALL;
	$iSlidingDoorSchemePriceType = CONST_PRICE_TYPE_SUPPLY;
*/

	// the type of configuration - supply or supply+install
	if( isset($oDoor->supply_type) ) {
		$sSupplyType = isset($oDoor->supply_type) ? $oDoor->supply_type : 'supply'; 
	} else {
		$CI = &get_instance();
		$sSupplyType = $CI->input->post('supply_type');
	}

	// get the price scheme to use - checks for install, if not found, defaults to supply prices
	$iSlidingDoorSchemePriceType = isset($sSupplyType) && $sSupplyType == 'install' ? CONST_PRICE_TYPE_INSTALL : CONST_PRICE_TYPE_SUPPLY;

	// if $oDoor->triple_glazing is 1 then triple glazing prices should be used, if no, use double glazing prices
	$iGlassType = ( $oDoor->triple_glazing == 0 ) ? 1 : 2;

// echo $iGlassType; exit;

	// basic standard price
	$aBasicPrice = $oDoorSchemeModel->get_basic_price($iScheme_Id, $iSlidingDoorSchemePriceType, $iWidth, $iHeight, $iGlassType);

	// increment the price
	$dQuotePrice += $aBasicPrice['price'];

// echo 'basic price = ' . $aBasicPrice['price'] .'<br />';

	// if we have a tinted glass colour selected, get the price for tinted glass
	if( $oDoor->tint_id == 1 ) {
		// get price for clear glass
		$aClearGlassPrice = $oDoorSchemeModel->get_basic_price($iScheme_Id, CONST_PRICE_TYPE_GLASS_CLEAR, $iWidth, $iHeight, $iGlassType);

		// increment price
		$dQuotePrice += $aClearGlassPrice['price'];

// echo 'clear glass price = ' . $aClearGlassPrice['price'] .'<br />';


		// also perform a check to see if self cleaning glass has been selected 
		if( $oDoor->glass_id == 2 ) {
			// get price for self cleaning
			$aSelfCleanGlassPrice = $oDoorSchemeModel->get_basic_price($iScheme_Id, CONST_PRICE_TYPE_GLASS_SELF_CLEAN, $iWidth, $iHeight, $iGlassType);

			// increment price
			$dQuotePrice += $aSelfCleanGlassPrice['price'];

// echo 'self clean glass price = ' . $aSelfCleanGlassPrice['price'] .'<br />';

		}

	// tinted glass has been selected
	} else {
		// get price for tinted glass
		$aTintedGlassPrice = $oDoorSchemeModel->get_basic_price($iScheme_Id, CONST_PRICE_TYPE_GLASS_TINTED, $iWidth, $iHeight, $iGlassType);

		// increment price
		$dQuotePrice += $aTintedGlassPrice['price'];

// echo 'tinted glass price = ' . $aTintedGlassPrice['price'] .'<br />';
	}


	// if we have trickle vents, add the price for the current config
	if( $oDoor->trickle_vent == '1' ) {
		// get price for clear glass
		$aTrickleVentPrice = $oDoorSchemeModel->get_basic_price($iScheme_Id, CONST_PRICE_TYPE_TRICKLE_VENTS, $iWidth, $iHeight, $iGlassType);

		// increment price
		$dQuotePrice += $aTrickleVentPrice['price'];

// echo 'trickel vent price = ' . $aTrickleVentPrice['price'] .'<br />';
	}

// echo 'total price = ' . $dQuotePrice .'<br />';




/*
	// get the basic price of the frame unglazed
	$aFrame = $oDoorSchemeModel->get_basic_price($iScheme_Id, $iDoorSchemePriceType_Id, $iWidth, $iHeight);
	$dQuotePrice += $aFrame['price'];


	// get the basic glass price per metre
	$aGlass = $oDoorSchemeModel->get_basic_price($iScheme_Id, 3, $iWidth, $iHeight);



	// get the glazing price per metre based on additional selected options
	$dGlazingPricePerMetre = number_format(quote__get_glazing_cost_per_metre($oDoor), 2);

	// get total price of the glazing * width
	$dGlazingPrice = number_format($dGlazingPricePerMetre * $iWidthMetres, 2);
	$dQuotePrice += $dGlazingPrice;


	// set additional options for technical

	// specification
	if( $oDoor->specification != '' ) {
		$CI->load->model('specification');
		$oSpecification = $CI->specification->get_specification_by_id($oDoor->specification);
		$dQuotePrice += $oSpecification->price;
	}

	// trickle vents
	if( $oDoor->trickle_vent == 1 ) {
		$dQuotePrice += ( CONST_TRICKLE_VENTS * $iWidthMetres );
	}
*/

    // Add 7.5% for non-standard ral colours (range id: 3)
    $CI = &get_instance();
    $colourRange = $CI->db->get_where('colour', array('id'=>$oDoor->external_colour_id))->row('colour_range_id');

    if ($colourRange == 3) {
        $dQuotePrice = $dQuotePrice*1.075;
    }


	// update the price based on vat requirement
// echo 'total price = ' . $dQuotePrice .'<br />';
	$net_price = $dQuotePrice;
	$vat_price = $net_price * 0.2;
	$ret['net'] = number_format($net_price, 2);
	$ret['vat'] = number_format($vat_price, 2);
	$dQuotePrice = isset($add_vat) && $add_vat ? $dQuotePrice + $vat_price : $dQuotePrice;

	// $dQuotePrice = isset($add_vat) && $add_vat ? $dQuotePrice * 1.2 : $dQuotePrice;
// echo 'total price = ' . $dQuotePrice .'<br />';

	// prepare final price
	$dQuotePrice = isset($format) && $format ? number_format($dQuotePrice, 2) : $dQuotePrice;

// echo("<pre>"); var_dump($oDoor);
// exit;

	// set final array data
	$ret['result'] = TRUE;
	$ret['html'] = $dQuotePrice;

	// return the data based on the type of output required
	if( $required_output == 'json') {
		// return json formatted data
		$CI->output->set_content_type('application/json')->set_output(json_encode($ret));
	} else {
		// just return the price
		return $ret['html'];
	}
}



/*
 * returns the cost per metre of the glass based on the selected glass options
 */
function quote__get_glazing_cost_per_metre($oDoor)
{
	// get the glazing type
	$iGlazingType_Id = isset($oDoor->triple_glazing) ? $oDoor->triple_glazing : 0;	# default to double glazing

	// if we have triple glazing
	if( $oDoor->triple_glazing == 1 ) {

		// basic price per metre for this group
		$dGlazingPricePerMetre = CONST_TRIPLE_GLAZED__CLEAR_PLANITHERM_1;

		// if self cleaning glass option
		if( $oDoor->glass_id == 2 ) {
			$dGlazingPricePerMetre = CONST_TRIPLE_GLAZED__SELF_CLEAN_PLANITHERM_1;
		}

		// if the tint is anything other than clear, this takes preference over the self clean as colour tints cannot have self clean option enabled
		if( $oDoor->tint_id == 2 || $oDoor->tint_id == 3 ) {
			$dGlazingPricePerMetre = CONST_TRIPLE_GLAZED__TINTED_PLANITHERM_1;
		}

	// options for normal double glazing
	} else {

		// basic price per metre for this group
		$dGlazingPricePerMetre = CONST_DOUBLE_GLAZED__CLEAR_PLANITHERM_TOTAL;

		// base conditions off the energy efficient option
		if( $oDoor->energy_efficient == 0 ) {  // not energy efficient selected

			// if self cleaning glass option
			if( $oDoor->glass_id == 2 ) {
				$dGlazingPricePerMetre = CONST_DOUBLE_GLAZED__SELF_CLEAN_PLANITHERM_TOTAL;
			}

			// if the tint is anything other than clear, this takes preference over the self clean as colour tints cannot have self clean option enabled
			if( $oDoor->tint_id == 2 || $oDoor->tint_id == 3 ) {
				$dGlazingPricePerMetre = CONST_DOUBLE_GLAZED__TINTED_PLANITHERM_TOTAL;
			}

		// values for energy efficient options
		} else {

			// if self cleaning glass option
			if( $oDoor->glass_id == 2 ) {
				$dGlazingPricePerMetre = CONST_DOUBLE_GLAZED__SELF_CLEAN_PLANITHERM_1;
			}

			// if the tint is anything other than clear, this takes preference over the self clean as colour tints cannot have self clean option enabled
			if( $oDoor->tint_id == 2 || $oDoor->tint_id == 3 ) {
				$dGlazingPricePerMetre = CONST_DOUBLE_GLAZED__TINTED_PLANITHERM_1;
			}

		}

	}

	// return the price per metre
	return $dGlazingPricePerMetre;
}



/*
 * get the html content for the email when given a bifold door id
 */
function quote__get_email_html($bifold_door_id)
{
	// load codeigniter instance
	$CI = &get_instance();

	// get the bifold door record
	$oDoor = new Sliding_Door();
	$oDoor = $oDoor->get_door($bifold_door_id);

	// view data storage array
	$data = array(
		'aa_telephone_number'		=> ''
	,	'aa_email_address'			=> SITE_EMAIL_ADDRESS
	,	'aa_freephone_telephone'	=> ''
	,	'aa_footer_copyright'		=> '&copy; '. Date('Y') .' Altitude Aluminium, all rights reserved.'
	);

	// set the url to use for images in the email
	$data['image_url'] = 'http://slidingdoor.ags-doorsandwindows.co.uk/';

	// get true image width - damn IE!
	$sImageURL = base_url() .'index.php/ajax/image/'. $oDoor->id;
	$sImageString = file_get_contents($sImageURL);
	$oImage = imagecreatefromstring($sImageString);

	// prepare final price and pass to the view
	$dBasicPrice = $oDoor->quote_price;
	$dVat = $dBasicPrice * 0.2;
	$dTotalPrice = $oDoor->quote_price_with_vat;
	$data['quote_price'] = number_format($dBasicPrice, 2);
	$data['quote_vat'] = number_format($dVat, 2);
	$data['quote_total'] = number_format($dTotalPrice, 2);

	// set image data for view
	$data['image_source'] = $sImageURL;
	$data['image_width'] =  imagesx($oImage);

	// assign the bifold to the view
	$data['door'] = $oDoor;

	// explode the name and get the first part
	$aName = explode(' ', $oDoor->your_name);
	$data['first_name'] = is_array($aName) && count($aName) > 1 ? $aName[0] : $oDoor->your_name;

	// set alternative glazing type
	$data['glazing_type'] = $oDoor->triple_glazing == 1 ? 'Triple Glazed' : 'Double Glazed';

	// set the tint
	switch($oDoor->tint_id) {
		case 1:
			$data['tint'] = 'Clear';
			break;
		case 2:
			$data['tint'] = 'Bronze';
			break;
		case 3:
			$data['tint'] = 'Gray';
			break;
	}

	// get the specification
	$CI->load->model('specification');
	$oSpecificationModel = new Specification();
	$oSpecification = $oSpecificationModel->get_specification_by_id($oDoor->specification);
	$data['specification'] = $oSpecification->specification;

	// set the external handle colour
	$data['external_handle_colour'] = $oDoor->external_handle_colour;

	// set the full supply type description
	$data['supply_type'] = $oDoor->supply_type == 'supply' ? 'Supply Only' : 'Supply &amp; Install';

	// return the email
	return $CI->load->view('admin/email', $data, TRUE);
}