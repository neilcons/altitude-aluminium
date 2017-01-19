<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Click to set your internal colour<br/><small>Colours shown give an indication of shade, no guarantee can be given that they will exactly match the powder product.</small></h4>
</div>
<div class="modal-body">
  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<?php foreach($colour_ranges as $colour_range): ?>
	<li<?php if($bifold->internal_colour->colour_range_id == $colour_range->id): ?> class="active"<?php endif ?>><a href="#int_<?=$colour_range->slug ?>" role="tab" data-toggle="tab"><?=$colour_range->name ?></a></li>
<?php endforeach; ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<p></p>
<?php foreach($colour_ranges as $colour_range): ?>
  <div class="tab-pane fade<?php if($bifold->internal_colour->colour_range_id == $colour_range->id): ?> in active<?php endif ?>" id="int_<?=$colour_range->slug ?>">

<?php $count = 0; foreach($colour_range->get_all_colours() as $colour): $count++;?>
	<div class="col-xs-3">
		<div class="text-center"><img class="colour-thumb" data-colour-id="<?=$colour->id ?>" src="<?=base_url('assets/images/thumbs/colours/' . $colour->RAL . '-1.png') ?>" alt=""></div>
		<p class="text-center"><?=$colour->name?><?php if($colour->colour_range_id == 3): ?><br/>RAL Code: <?=$colour->RAL ?><?php endif ?></p>
	</div>
<?php
if($count == 4){
  $count = 0;
  echo '<div class="clearfix"></div>';
}
?>
<?php endforeach ?>
<?php if($count > 0): ?>
<div class="clearfix"></div>
<?php endif ?>
  </div>
<?php endforeach; ?>
</div>
</div>