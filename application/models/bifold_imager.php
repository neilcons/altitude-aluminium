<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Imager extends CI_Model {

	const IMGPATH = 'assets/images/image_layers/';

	private $image_path;

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

	public function get_image(Bifold_Door $bifold)
	{
		$left_handle_pos = array();
		$left_handle_pos[1] = 117;
		$left_handle_pos[2] = 241;
		$left_handle_pos[3] = 365;
		$left_handle_pos[4] = 490;
		$left_handle_pos[5] = 614;
		$left_handle_pos[6] = 738;
		$left_handle_pos[7] = 861;
		$left_handle_pos[8] = 986;

		$right_handle_pos = array();
		$right_handle_pos[1] = 34;
		$right_handle_pos[2] = 158;
		$right_handle_pos[3] = 365 - 82;
		$right_handle_pos[4] = 490 - 82;
		$right_handle_pos[5] = 614 - 82;
		$right_handle_pos[6] = 738 - 82;
		$right_handle_pos[7] = 862 - 82;
		$right_handle_pos[8] = 986 - 82;

		$blind_position = array();
		$blind_position[1] = 18;
		$blind_position[2] = 142;
		$blind_position[3] = 266;
		$blind_position[4] = 391;
		$blind_position[5] = 515;
		$blind_position[6] = 639;
		$blind_position[7] = 763;
		$blind_position[8] = 887;

		$hinge_position = array();
		$hinge_position[1] = 4;
		$hinge_position[2] = 128;
		$hinge_position[3] = 252;
		$hinge_position[4] = 376;
		$hinge_position[5] = 501;
		$hinge_position[6] = 625;
		$hinge_position[7] = 749;
		$hinge_position[8] = 871;
		$hinge_position[9] = 996;

		$panel_count = $bifold->get_panel_count();
		$outer_ral = $bifold->get_outer_ral();

		$frame_filename = $panel_count . 'panel-' . $outer_ral . '.png';

		$show_ral = !file_exists($this->image_path . 'frames/' . $frame_filename);

		if($show_ral){
			$frame_filename = $panel_count . 'panel-9003.png';
			$outer_ral = '9003';
		}

		$frame = imagecreatefrompng($this->image_path . 'frames/' . $frame_filename);

		$canvas = $this->init_canvas(imagesx($frame), imagesy($frame));

		$this->add_layer($canvas, 'background.png', (imagesx($frame) - 1004) / 2, 0, 57);

		 if($bifold->has_blinds()){
		 	for($i = 1; $i <= $panel_count; $i++){
		 		$this->add_layer($canvas, 'blinds/' . $bifold->get_blinds_ral() . '.png', $blind_position[$i], 18);
		 	}
		 }


		// add tint if selected
		if( $bifold->tint_id > 1 ) {
			$sTintColour = $bifold->tint_id == 2 ? 'bronze' : 'grey';
			for( $i = 0; $i < $panel_count; $i++ ) {
				$this->add_layer($canvas, 'tints/'. $sTintColour .'.png', ( $i * 130 ));
			}
		}


		// add the frame
		$this->add_layer($canvas, 'frames/' . $frame_filename);


		// add the midrail
		if($bifold->has_midrail()){
		 	for($i = 1; $i <= $panel_count; $i++){
				$this->add_layer($canvas, 'midrail/' . $outer_ral . '.png', $blind_position[$i]-3, 184);
			}
		}


		/*
		 * if we have a handle, add it to the image layer
		 */
		$has_handle = $bifold->has_handle();
		if($has_handle) 
		{
			/*
			 * gets the initial value from the bifold_door.master_handle value and uses this to draw the image from /assets/images/images_layers/handles/
			 */
			if( $bifold->handle_position == 'left' ) {
				$iPixelOffset = $left_handle_pos[$bifold->get_panel_with_handle()] - 27;
				$this->add_layer($canvas, 'handles/' . $bifold->get_master_handle_ral_colour() . '-left.png', $iPixelOffset, 170);
			} else {
				$iPixelOffset = $right_handle_pos[$bifold->get_panel_with_handle()] - 27;
				$this->add_layer($canvas, 'handles/' . $bifold->get_master_handle_ral_colour() . '-right.png', $iPixelOffset, 170);
			}
		}

		// only show the glass options if they have been changed within the designer options
		if( $bifold->show_glass_options == 1 )
		{
			/*
			 * show the glazing type
			 */
			$glazing_icon = $bifold->triple_glazing == 1 ? 'triple.png' : 'double.png';
			$this->add_layer($canvas, 'hardware/'. $glazing_icon, 40, 250);

			/*
			 * show the self cleaning option
			 */
			$glass_icon = $bifold->glass_id == 1 ? 'cleaning-no.png' : 'cleaning-yes.png';
			$this->add_layer($canvas, 'hardware/'. $glass_icon, 40, 186);

			/*
			 * show the energy efficient option
			 */
			$energy_icon = $bifold->energy_efficient == 0 ? 'energy-no.png' : 'energy-yes.png';
			$this->add_layer($canvas, 'hardware/'. $energy_icon, 40, 122);
		}

		$open_in = $bifold->is_open_in();
		$panel_with_handle = $bifold->get_panel_with_handle();
		if($bifold->does_slide_left()){

			for($i = $open_in ? 2 : 1; $i <= $panel_count - 1; $i += 2){

				if($open_in && $i == $panel_with_handle + 1){
					$i++;
				} elseif(!$open_in && $i == $panel_with_handle+2){
					$i++;
				}
				$this->add_layer($canvas, 'hinges/hinge-' . $bifold->get_hinge_colour() . '.png', $hinge_position[$i], 0);
			}

		} else {
			for($i = $open_in ? $panel_count : $panel_count - 1; $i > 1; $i -= 2){

				if($open_in && $i == $panel_with_handle - 1){
					$i--;
				} elseif(!$open_in && $i == $panel_with_handle-2){
					$i--;
				}
				$this->add_layer($canvas, 'hinges/hinge-' . $bifold->get_hinge_colour() . '.png', $hinge_position[$i], 0);
			}
		}


		$vent_image_location  = array();
		$vent_image_location['0.5'] = 78;
		$vent_image_location['1'] = 17;
		$vent_image_location['2'] = 142;
		$vent_image_location['2.5'] = 202;
		$vent_image_location['3'] = 265;
		$vent_image_location['3.5'] = 327;
		$vent_image_location['4'] = 390;
		$vent_image_location['4.5'] = 452;
		$vent_image_location['5'] = 513;
		$vent_image_location['6'] = 638;


		if($bifold->has_trickle_vents()){
			$canvas = $this->add_add_on($canvas);
			$vent_positions = array();
			switch ($panel_count) {
				case 8:
					$vent_size = '2x';
					$vent_positions[] = '2';
					$vent_positions[] = '6';
					break;
				case 7:
					$vent_size = '2x';
					$vent_positions[] = '2';
					$vent_positions[] = '5';
					break;
				case 6:
					$vent_size = '2x';
					$vent_positions[] = '0.5';
					$vent_positions[] = '4.5';
					break;
				case 5:
					$vent_size = '1x';
					$vent_positions[] = '2';
					$vent_positions[] = '4';
					break;
				case 4:
					$vent_size = '1x';
					$vent_positions[] = '0.5';
					$vent_positions[] = '3.5';
					break;
				case 3:
					$vent_size = '1x';
					$vent_positions[] = '1';
					$vent_positions[] = '3';
					break;
				case 2:
					$vent_size = '1x';
					$vent_positions[] = '0.5';
					break;
				default:
					throw new Exception("Error Processing Request", 1);
					break;
			}

			foreach($vent_positions as $vent_position){
				$this->add_layer($canvas, 'vents/vent-' . $vent_size . ".png", $vent_image_location[$vent_position], 2);
			}

		}

		if($show_ral){
				$this->add_layer($canvas, 'colour/ral.png', imagesx($frame) - 94, 0);
		}

		ob_start();
		imagepng($canvas);
		$img = ob_get_contents();
		ob_end_clean();

		return $img;
	}

}

/* End of file bifold_imager.php */
/* Location: ./application/models/bifold_imager.php */