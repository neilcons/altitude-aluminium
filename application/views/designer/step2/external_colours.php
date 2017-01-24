<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Click to set your colour<br/><small>Colours shown give an indication of shade, no guarantee can be given that they will exactly match the powder product.</small></h4>
</div>

<div class="modal-body">

  <?php if( isset($colour_ranges) && count($colour_ranges) > 1 ) : ?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <?php foreach($colour_ranges as $colour_range): ?>
    <li<?php if($colour_range->id == 1): ?> class="active"<?php endif ?>><a href="#ext_<?=$colour_range->slug ?>" role="tab" data-toggle="tab"><?=$colour_range->name ?></a></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>

  <!-- Tab panes -->
  <div class="tab-content">
    <p></p>

    <?php foreach($colour_ranges as $colour_range): ?>
    <div class="tab-pane fade<?php if($colour_range->id == 1): ?> in active<?php endif ?>" id="ext_<?=$colour_range->slug ?>">

        <h4 class="modal-title" id="myModalLabel"><small>
            <div style="text-align:center; padding:8px 0 16px 0">
                <?php if($colour_range->id == 3): ?>
                    <?=$colour_range->name ?> take 40 Working Days from order
                <?php endif ?>
                <?php if($colour_range->id == 1): ?>
                    <?=$colour_range->name ?> take 20 Working Days from order
                <?php endif ?>
            </div>
        </small></h4>

      <?php 
      $count = 0; 
      foreach($colour_range->get_all_colours() as $colour): 
        $count++;
      ?>
    	<div class="col-xs-3">
    		<div class="text-center"><img class="colour-thumb" data-colour-id="<?=$colour->id ?>" src="<?=base_url('assets/images/thumbs/colours/' . $colour->RAL . '-1.png') ?>" alt=""></div>
    		<p class="text-center"><?=$colour->name?><?php if($colour->colour_range_id == 3 || $colour->colour_range_id == 1): ?><br/>RAL Code: <?=$colour->RAL ?><?php endif ?></p>
    	</div>

      <?php
      if($count == 4) {
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