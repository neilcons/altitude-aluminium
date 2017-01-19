<span id="external-frame-colour-title" class="title">Colour</span>
<span class="colourname">
	<?=$colour->name ?>
	<?php if($colour->colour_range_id == 3): ?> RAL Code: <?=$colour->RAL ?><?php endif ?>
</span>

<a data-toggle="modal" href="<?=site_url('designer/external_colour_popup') ?>" data-target=".help-modal-external-colours">
	<img id="external-colour" data-colour-id="<?=$colour->id ?>" src="<?=base_url('/assets/images/thumbs/colours/' . $colour->RAL . '-1.png') ?>" alt="">
    <span class="span1"><span>Choose Colour</span></span>
</a>

