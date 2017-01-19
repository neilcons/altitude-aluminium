<p>Select your options below</p>

<div class="row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6"><label for="cill_option">Cill</label></div>
			<div class="col-xs-6"><p><?=form_dropdown('cill', $CI->bifold_designer_interface->get_cill_dropdown(), $door->cill, ' id="cill_option" class="form-control"'); ?></p></div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6"><label for="trickle_vent_option">Trickle Vents</label></div>
			<div class="col-xs-6"><p><?=form_dropdown('trickle_vent', $CI->bifold_designer_interface->get_tricklevent_dropdown(), $door->trickle_vent, ' id="trickle_vent_option" class="form-control"'); ?></p></div>
		</div>
	</div>
	<div class="clearfix"></div>
<!-- 	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6"><label for="midrail_option">Midrail</label></div>
			<div class="col-xs-6"><p><?=form_dropdown('midrail', $CI->bifold_designer_interface->get_midrail_dropdown(), $door->midrail, ' id="midrail_option" class="form-control"'); ?></p></div>
		</div>
	</div>
 -->	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6"><label for="threshold_option">Threshold</label></div>
			<div class="col-xs-6"><p><?=form_dropdown('threshold_id', $CI->bifold_designer_interface->get_threshold_dropdown(), $door->threshold_id, ' id="threshold_option" class="form-control"'); ?></p></div>
		</div>
	</div>

<div class="col-xs-6">
	<p class="text-success"><strong>Please note:</strong> Only doors with the standard threshold are accredited to Secured By Design</p>
</div>


<!-- 	<div class="col-xs-4">
		<div class="row">
			<div class="col-xs-6"><label for="drainage_option">Drainage</label></div>
			<div class="col-xs-6"><p><?=form_dropdown('drainage', $CI->bifold_designer_interface->get_drainage_dropdown(), $door->drainage, ' id="drainage_option" class="form-control"'); ?></p></div>
		</div>
	</div>
 --></div>