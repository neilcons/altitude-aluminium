<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imager extends CI_Model {

	private 
		$image_path

	// panel sizes
	,	$panel_width = 300

	// optional settings - if these are flagged as true - the application will try and load these options onto the image preview
	,	$allow_blinds = false
	,	$allow_tint = true
	,	$allow_midrail = false
	,	$allow_handle = true
	,	$allow_trickle_vents = true
	,	$allow_inside_handle = false
	;

	public function __construct()
	{
		parent::__construct();
		$this->image_path = FCPATH . 'assets/images/image_layers/';
	}

	public function init_canvas($width, $height)
	{
		$canvas = imagecreatetruecolor($width, $height);
		$white = imagecolorallocate($canvas, 255, 255, 255);
		imagefill($canvas, 0, 0, $white);
		return $canvas;
	}

	public function add_layer($dest, $src_filename, $x = 0, $y = 0, $alpha = 100)
	{
		if(file_exists($this->image_path . $src_filename)){
			$src = imagecreatefrompng($this->image_path . $src_filename);
			$width = min(imagesx($src), imagesx($dest) - $x);
			$height = min(imagesy($src), imagesy($dest) - $y);

			if($alpha != 100){
				imagecopymerge($dest, $src, $x, $y, 0, 0, $width, $height, $alpha);
			} else {
				imagecopy($dest, $src, $x, $y, 0, 0, $width, $height);
			}
		}
	}

	public function add_add_on($image)
	{
		$width = imagesx($image);
		$height = imagesy($image);

		$canvas = imagecreatetruecolor($width, $height+7);
		$white = imagecolorallocate($canvas, 255, 255, 255);
		imagefill($canvas, 0, 0, $white);

		imagecopy($canvas, $image, 0, 0, 0, 0, $width, 2);
		imagecopy($canvas, $image, 0, 7, 0, 0, $width, $height);

		imagecopyresampled($canvas, $image, 0, 2, 0, 2, $width, 10, $width, 3);
  		return $canvas;
	}

	public function get_image(Sliding_Door $oDoor)
	{
		// get the number of panels for selected door
		$panel_count = $oDoor->get_panel_count();

		// get the outer ral colour code
		$outer_ral = $oDoor->get_outer_ral();

		// get the initial frame file to use
		$frame_filename = $panel_count . 'panel-' . $outer_ral . '.png';

		// do we have a ral colour to show and the file exists
		$show_ral = !file_exists($this->image_path . 'frames/' . $frame_filename);
		if($show_ral){
			$frame_filename = $panel_count . 'panel-1000.png';
			$outer_ral = '1000';
		}


		// load the frame
		$frame = imagecreatefrompng($this->image_path . 'frames/' . $frame_filename);


		// create the main image canvas layer
		$canvas = $this->init_canvas(imagesx($frame), imagesy($frame));


		// get the scheme
		$oScheme = new Sliding_Door_Scheme();
		$oScheme->load($oDoor->sliding_door_scheme_id);

		// get the number of panels for this configuration
		if( isset($oDoor->number_panels) ) {
			$iNumberOfPanels = $oDoor->number_panels;
		} else {
			$iNumberOfPanels = $oScheme->number_panels;
		}

		// get the panel with the handle on it
		$aStyle = explode('-', $oScheme->style);
		$sHandle = $aStyle[1];


		/*
		 * draw the inside handle on the canvas
		 */
		if( $this->allow_inside_handle )
		{
			$this->draw_handle($canvas, $oDoor, $sHandle, $iNumberOfPanels, 180); 
		}
			


		// add the background
		if( $oScheme->number_panels < 6 ) {
			// set values for normal background image
			$sBackgroundImage = 'background.png';
			$iBackgroundOffset = 1004;

		// set values for large background image
		} else {
			$sBackgroundImage = 'background-large.png';
			$iBackgroundOffset = 1495;
		}

		// add the background image
		$this->add_layer($canvas, $sBackgroundImage, (imagesx($frame) - $iBackgroundOffset) / 2, 0, 57);

		// if we have blinds, place them on the image
		if( $this->allow_blinds && $oDoor->has_blinds() ) {
			for($i = 1; $i <= $panel_count; $i++) {
		 		$this->add_layer($canvas, 'blinds/' . $oDoor->get_blinds_ral() . '.png', $blind_position[$i], 18);
			}
		}


		// add tint if selected
		if( $this->allow_tint && $oDoor->tint_id > 1 ) {
			$sTintColour = $oDoor->tint_id == 2 ? 'bronze' : 'grey';
			for( $i = 0; $i < $panel_count; $i++ ) {
				$this->add_layer($canvas, 'tints/'. $sTintColour .'.png', ( $i * $this->panel_width ));
			}
		}


		// add the frame
		$this->add_layer($canvas, 'frames/' . $frame_filename);


		// add the midrail
		if( $this->allow_midrail && $oDoor->has_midrail() ){
		 	for($i = 1; $i <= $panel_count; $i++){
				$this->add_layer($canvas, 'midrail/' . $outer_ral . '.png', $blind_position[$i]-3, 184);
			}
		}

		// explode the scheme style, ie. convert 3-1-2L-3 into an array and for passing through as the door handle options on the draW_handle method
		$aHandles = explode('-', $oScheme->style);

		// draw the outside selected handle on the frame
		$this->draw_handle($canvas, $oDoor, $aHandles);

		// only show the glass options if they have been changed within the designer options
		if( $oDoor->show_glass_options == 1 )
		{
			/*
			 * show the glazing type
			 */
			$glazing_icon = $oDoor->triple_glazing == 1 ? 'triple.png' : 'double.png';
			$this->add_layer($canvas, 'hardware/'. $glazing_icon, 40, 250);

			/*
			 * show the self cleaning option
			 */
			//$glass_icon = $oDoor->glass_id == 1 ? 'cleaning-no.png' : 'cleaning-yes.png';
			//$this->add_layer($canvas, 'hardware/'. $glass_icon, 40, 186);
		}


		// if we can process trickle vents, do so...
		if( $this->allow_trickle_vents ) {
			// loop through each panel and assign a trickle vent to each panel if the option is selected selected
			if($oDoor->has_trickle_vents()) {
				// expand the frame to provide room for the trickle vents
				$canvas = $this->add_add_on($canvas);

				// prep the loop to add the trickle vents to each panel
				$vent_x = 77;
				$vent_size = '1x';
				for( $i = 1; $i <= $panel_count; $i++ ) {
					//$this->add_layer($canvas, 'vents/vent-' . $vent_size . ".png", $vent_x, 2);
					//$vent_x += 251;
				}
			}
		}


		// show the ral icon on the bottom right hand side of the image
		if($show_ral){
			$this->add_layer($canvas, 'colour/ral.png', imagesx($frame) - 120, 210);
		}


		// store the image
		ob_start();
		imagepng($canvas);
		$oImage = ob_get_contents();
		ob_end_clean();

		// spit out the image
		return $oImage;
	}


	/*
	 * draw the handles on the image
	 */
	private function draw_handle($canvas, $oDoor, $aHandles)
	{
		// get the number of panels from the count of the handle array
		$iNumberOfPanels = count($aHandles);

		// set the end point of the handle file to use
		$sHandleType = $oDoor->specification == 1 ? '-pull' : '-handle';

		// loop through the handles and place them on the canvas
		foreach( $aHandles as $sHandle ) {

			// only process this handle if it has a direction
			if( strlen($sHandle) > 1 && $oDoor->specification != 3 ) {

				// split the handle into panel and direction
				$iPanel = substr($sHandle, 0, 1);
				$sDirection = substr($sHandle, 1, 1);
				$sHandlePosition = ( $sDirection == 'R' ) ? 'L' : 'R';

				// add the handle to the image based on the initial handle position
				$sDoorHandleColour = $oDoor->get_master_handle_ral_colour();

				// place the handle on the left
				if( $sHandlePosition == 'L' ) {

					// default starting position of handle on first panel
					$iStartX = 8;

					// get the x offset for the current panel
					$iOffsetX = $iStartX + ( 247 * ( $iPanel - 1 ) );

					// add the handle to the canvas
					$this->add_layer($canvas, 'handles/'. $sDoorHandleColour . $sHandleType .'-right.png', $iOffsetX, 149);

				// place the handle on the right
				} else {

					// get the starting position of the handle for the first panel from the right hand side of the door
					switch( $iPanel ) {
						case 2:
							$iStartX = 462;
							break;
						default:
							$iStartX = 462 + ( 247 * ( $iPanel - 2 ) );
							break;
					}

					// get the x offset for the current panel
					$iOffsetX = $iStartX; # - ( 234 * ( $iPanel - 1 ) );

					// add the handle to the canvas
					$this->add_layer($canvas, 'handles/'. $sDoorHandleColour . $sHandleType .'-left.png', $iOffsetX, 149);

				}
			}
		}
	}

}

/* End of file imager.php */
/* Location: ./application/models/imager.php */