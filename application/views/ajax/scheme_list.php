<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="#left" data-bifold-direction="left" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-arrow-left"></i> Slide Left</a></li>
<li><a href="#right" data-bifold-direction="right" role="tab" data-toggle="tab">Slide Right <i class="glyphicon glyphicon-arrow-right"></i></a></li>
</ul>

<div class="tab-content">

<div class="tab-pane fade in active" id="left">

<?php $num_panels = 1; ?>
<div class="rodw">
<?php foreach($schemes as $scheme): ?>

<?php if($scheme->number_panels != $num_panels): ?>

<?php if($num_panels != 1): ?>
</div>
</div>
<?php endif ?>

<?php if($scheme->number_panels == 2): ?>
<div class="col-xs-5">
<?php else: ?>
	<?php if($scheme->number_panels == 3 && $min_number_panels == 2): ?>
<div class="col-xs-7">
	<?php else: ?>
<div class="col-xs-12">
	<?php endif ?>
<?php endif ?>
<h3><?=$num_panels = $scheme->number_panels ?> Panes</h3>
<div class="row">
<?php endif ?>
<?php if($scheme->number_panels == 2): ?>
<div class="col-xs-12">
<?php else: ?>
<div class="col-xs-6">
<?php endif ?>
<p class="text-center" style="margin-bottom:3px;"><strong style="color:#000"><?=$scheme->name ?></strong></p>
<a href="#" data-scheme-id="<?=$scheme->id ?>"><img class="center-block img-responsive" src="<?=base_url('assets/images/thumbs/configurations/' . $scheme->get_thumb_img()) ?>" alt=""></a>
</div>
<?php endforeach ?>
</div>
</div>
</div>

</div>




<div class="tab-pane fade" id="right">

<?php $num_panels = 1; ?>
<div class="rodw">
<?php foreach($schemes as $scheme): ?>

<?php if($scheme->number_panels != $num_panels): ?>

<?php if($num_panels != 1): ?>
</div>
</div>
<?php endif ?>

<?php if($scheme->number_panels == 2): ?>
<div class="col-xs-5">
<?php else: ?>
	<?php if($scheme->number_panels == 3 && $min_number_panels == 2): ?>
<div class="col-xs-7">
	<?php else: ?>
<div class="col-xs-12">
	<?php endif ?>
<?php endif ?>
<h3><?=$num_panels = $scheme->number_panels ?> Panes</h3>
<div class="row">
<?php endif ?>
<?php if($scheme->number_panels == 2): ?>
<div class="col-xs-12">
<?php else: ?>
<div class="col-xs-6">
<?php endif ?>
<p class="text-center" style="margin-bottom:3px;"><strong style="color:#000"><?=$scheme->name_left ?></strong></p>
<a href="#" data-scheme-id="<?=$scheme->id ?>"><img class="center-block img-responsive" src="<?=base_url('assets/images/thumbs/configurations/' . $scheme->get_thumb_img_left()) ?>" alt=""></a>
</div>
<?php endforeach ?>
</div>
</div>
</div>

</div>



</div>