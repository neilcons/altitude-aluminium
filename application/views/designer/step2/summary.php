<?php

if(!function_exists('show_summary_option')){

	function show_summary_option($label, $value)
	{
		if (is_negative($value)){
?>
<p class="none"><span class="text-danger"><i class="glyphicon glyphicon-remove-sign"></i></span> <span class="summary-label"><?=$label ?></span> <span><?=$value ?></span></p>
<?php
		} else {
			if (is_unsure($value)){
?>
<p class="none"><span class="text-info"><i class="glyphicon glyphicon-question-sign"></i></span> <span class="summary-label"><?=$label ?></span> <span><?=$value ?></span></p>
<?php
			} else {
?>
<p><span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span> <span class="summary-label"><?=$label ?></span> <span><?=$value ?></span></p>
<?php
			}
		}
	}

}

?>
<div class="row">
	<div class="col-xs-4">
		<label>Frame Colour</label>
		<?php echo show_summary_option('External', $door->print_string('external_colour')) ?>
		<?php echo show_summary_option('Internal', $door->print_string('internal_colour')) ?>
		<label>Hardware Colour</label>
		<?php echo show_summary_option('Master Handle', $door->print_string('master_handle')) ?>
		<?php echo show_summary_option('T Handle', $door->print_string('thandle')) ?>
	</div>
	<div class="col-xs-4">
		<label>Glass &amp; Blinds</label>
		<?php echo show_summary_option('Glass', $door->print_string('glass')) ?>
		<?php echo show_summary_option('Blinds', $door->print_string('blind')) ?>
		<label>Other</label>
		<?php echo show_summary_option('Cill', $door->print_string('cill')) ?>
		<?php echo show_summary_option('Threshold', $door->print_string('threshold')) ?>
	</div>
	<div class="col-xs-4">
		<label>Other Cont...</label>
		<?php echo show_summary_option('Trickle Vents', $door->print_string('trickle_vent')) ?>
		<?php echo show_summary_option('Drainage', $door->print_string('drainage')) ?>
		<?php //echo show_summary_option('Midrail', $door->print_string('midrail')) ?>
	</div>
</div>