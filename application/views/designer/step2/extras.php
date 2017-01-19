<?php $CI =& get_instance() ?>
<!-- <a data-toggle="modal" href="<?=site_url('help/extras') ?>" data-target=".help-modal-extras" class="helpbox">help <img src="<?=base_url('assets/images/helpbtn.jpg') ?>" alt="" /></a> -->
<p class="optiontitle">Choose from our most popular extras below</p>
<div class="step2extrasinner">

    <div class="optionsleft">
    
    	<div class="midrailbox">
            <div class="midrailboxl">
            	Midrail
            </div>
            <div class="midrailboxr">
            	<a href="#" data-midrail="1"<?php if($bifold->has_midrail()): ?> class="active"<?php endif ?>><span>Yes</span></a>
            	<a href="#" data-midrail="0"<?php if(!$bifold->has_midrail()): ?> class="active"<?php endif ?>><span>No</span></a>
            </div>
        </div>
    
    	<div class="trickleventbox">
            <div class="trickleventboxl">
            	Trickle Vents
            </div>
            <div class="trickleventboxr">
            	<a href="#" data-trickle-vent="1"<?php if($bifold->has_trickle_vents()): ?> class="active"<?php endif ?>><span>Yes</span></a>
            	<a href="#" data-trickle-vent="0"<?php if(!$bifold->has_trickle_vents()): ?> class="active"<?php endif ?>><span>No</span></a>
            </div>
        </div>
    
    </div>
    
    <div class="optionsright">
    
    	<div class="hingeoption">
        	<div class="hingename">
            	Hinge
            </div>
            <div class="hingebox">
                <a href="#" class="active" data-hinge-colour-id="2"><img src="<?=base_url('assets/images/hinge-black.png') ?>" alt="" /> <span>Black</span></a>
            </div>
            <div class="hingebox">
                <a href="#" data-hinge-colour-id="1"><img src="<?=base_url('assets/images/hinge-white.png') ?>" alt="" /> <span>White</span></a>
            </div>
        </div>

        <div class="cilloption">
            <div class="cillname">
                Cill
            </div>
            <div class="cillbox">
                <a href="#" class="active" data-bifold-cill-id="0"><span>None</span></a>
            </div>
            <div class="cillbox">
                <a href="#" data-bifold-cill-id="1"><span>150 mm</span></a>
            </div>
            <div class="cillbox">
                <a href="#" data-bifold-cill-id="2"><span>190 mm</span></a>
            </div>
            <div class="cillbox">
                <a href="#" data-bifold-cill-id="3"><span>225 mm</span></a>
            </div>
        </div>

        
    </div>

</div>