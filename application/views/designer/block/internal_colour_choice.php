<span class="title">Internal Colour</span>

<!-- internal colour -->
<span class="colourname">
	<?=$colour->name ?>
	<?php if($colour->colour_range_id == 3): ?> RAL Code: <?=$colour->RAL ?><?php endif ?>
</span>
<a data-toggle="modal" href="<?=site_url('designer/internal_colour_popup') ?>" data-target=".help-modal-internal-colours">
	<img id="internal-colour" data-colour-id="<?=$colour->id ?>" src="<?=base_url('assets/images/thumbs/colours/' . $colour->RAL . '-1.png') ?>" alt="">
	<span class="span1"><span>Choose Colour</span></span>
</a>

<!-- button to set internal colour same as external colour -->
<span class="colourmatch">
	<input type="checkbox" name="type" value="colourmatch" id="cb-match-external-colour" class="css-checkbox" />
	<label id="internal-colourmatch" class="css-label" for="cb-match-external-colour">Colour match to external</label>
</span>