<?php
$CI =& get_instance();
?>

<!-- <a data-toggle="modal" href="<?=site_url('help/hardware') ?>" data-target=".help-modal-hardware" class="helpbox">help <img src="<?=base_url('assets/images/helpbtn.jpg') ?>" alt="" /></a> -->
<p class="optiontitle">Choose from our most popular finishes below</p>
                            
<div class="step2hardwareinner">
<?php foreach($CI->bifold_designer_interface->get_master_handle_colours() as $colour): ?>
    <div class="hardwarebox">
        <a href="#" class="<?php if($colour->id == $bifold->master_handle): ?>active<?php endif ?>" data-master-handle="<?=$colour->id ?>"><img src="<?=base_url('assets/images/thumbs/hardware/handle/' . make_slug($colour->name)) . '.png' ?>" title="<?=$colour->name ?>" /> <span><?=$colour->name ?></span></a>
    </div>
<?php endforeach ?>
</div>