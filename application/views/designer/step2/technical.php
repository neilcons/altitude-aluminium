<?php $CI =& get_instance() ?>
<!-- <a data-toggle="modal" href="<?=site_url('help/technical') ?>" data-target=".help-modal-technical" class="helpbox">help <img src="<?=base_url('assets/images/helpbtn.jpg') ?>" alt="" /></a> -->
<p class="optiontitle">Choose from our technical options below</p>
<div class="step2technicalinner">

    <div class="optionsleft">
    
        <div class="magnetsbox">
            <div class="magnetsboxl">
                Magnets
            </div>
            <div class="magnetsboxr">
                <a href="#" data-magnets="1"<?php if($bifold->has_magnets()): ?> class="active"<?php endif ?>><span>Yes</span></a>
                <a href="#" data-magnets="0"<?php if(!$bifold->has_magnets()): ?> class="active"<?php endif ?>><span>No</span></a>
            </div>
        </div>

        <div class="thresholdbox">
            <div class="thresholdboxl">
                Threshold
            </div>
            <div class="thresholdboxr">
<?php foreach($CI->bifold_designer_interface->get_threshold_options() as $threshold): ?>
                <a href="#" data-threshold="<?=$threshold->id ?>"<?php if($bifold->threshold_id == $threshold->id): ?> class="active"<?php endif ?>><span><?=$threshold->name ?></span></a>
<?php endforeach ?>
            </div>
        </div>
    
    </div>
    

</div>