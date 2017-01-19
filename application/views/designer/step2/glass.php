<?php $CI =& get_instance(); ?>
<!-- <a data-toggle="modal" href="<?=site_url('help/glass') ?>" data-target=".help-modal-glass" class="helpbox">help <img src="<?=base_url('assets/images/helpbtn.jpg') ?>" alt="" /></a> -->
<p class="optiontitle">Choose your glazing from our options below</p>
                            
                            <div class="glassoption">
                                <div class="tripleglazingbox">
                                    <div class="tripleglazingboxl">
                                        <img src="<?=base_url('assets/images/glasstype-tripleglazing.png') ?>" alt="" /> <span>Triple Glazing</span>
                                    </div>
                                    <div class="tripleglazingboxr">
                                        <a href="#" data-triple-glazing="1" class="<?php if($bifold->has_triple_glazing()): ?>active<?php endif ?>"><span>Yes</span></a>
                                        <a href="#" data-triple-glazing="0" class="<?php if(!$bifold->has_triple_glazing()): ?>active<?php endif ?>"><span>No</span></a>
                                    </div>
                                </div>
                                <div class="antisunbox">
                                    <div class="antisunboxl">
                                        <img src="<?=base_url('assets/images/glasstype-antisun.png') ?>" alt="" /> <span>Anti Sun</span></a>
                                    </div>
                                    <div class="antisunboxr">
                                        <a href="#" data-anti-sun="1" class="<?php if($bifold->has_anti_sun()): ?>active<?php endif ?>"><span>Yes</span></a>
                                        <a href="#" data-anti-sun="0" class="<?php if(!$bifold->has_anti_sun()): ?>active<?php endif ?>"><span>No</span></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="blindsoption">
                                <p>Glazing with Blinds</p>
                                

<div class="blindsbox<?php if($bifold->has_triple_glazing()): ?> disabled<?php endif ?>">
    <a href="#" class="<?php if(!$bifold->has_blinds()): ?>active<?php endif ?>" data-blind-id="0"><img src="<?=base_url('assets/images/thumbs/blinds/none.png') ?>" class="img-responsive" alt="" /></a>
</div>

<?php foreach($CI->bifold_designer_interface->get_blind_colours() as $colour): ?>
    <div class="blindsbox">
        <a href="#" class="<?php if($colour->id == $bifold->blind_id): ?>active<?php endif ?>" data-blind-id="<?=$colour->id ?>"><img title="<?=$colour->friendly_name?>" src="<?=base_url('assets/images/thumbs/blinds/' . make_slug($colour->name) . '.png') ?>" class="img-responsive" alt="" /></a>
    </div>
<?php endforeach ?>

</div>
