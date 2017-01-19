<?php $this->load->view('structure/header/designer.php') ?>

<div id="centerbox">
    <?php echo form_open('/quote', array('id'=>'primaryform', 'method'=>'post')); ?>

        <?php
            // load url helper
            $this->load->helper('url');

            // hidden fields
            echo form_hidden('sliding_door_scheme_id', null);

            // the direction of the slide of the door
            // echo form_hidden('sliding_direction', null);

            // whether the handle is on the 'left' or 'right' hand side of the door
            echo form_hidden('handle_position', null);

            // hold number of panels
            echo form_hidden('number_panels', 2);

            // stores the direction
            echo form_hidden('opening', 'in');

            // the external colour code of the frame
            echo form_hidden('external_colour_id', $door->external_colour_id);
            // echo form_hidden('external_colour_id', 343);    // default colour of signal white - ral = 9003

            // the internal colour code of the frame
            echo form_hidden('internal_colour_id', $door->internal_colour_id);
            // echo form_hidden('internal_colour_id', 343);    // default colour of signal white - ral = 9003

            // main_handle_internal_colour_id
            echo form_hidden('main_handle_internal_colour_id', '8');

            // trickle vent value
            echo form_hidden('trickle_vent', '0');

            // flag to store whether the hinge warning message has been shown
            echo form_hidden('cill', '0');

            // flag to store whether the hinge warning message has been shown
            echo form_hidden('threshold_id', '1');

            // flag to store whether to show the glass options
            echo form_hidden('show_glass_options', '0');
        ?>

        <div id="designer">

            <div class="step1top">

                <div class="step1buttons">
                    <div id="submit" class="action hidden">Get Quote</div>
                    <div class="action nope" data-action="prev">&lt; Prev</div>
                    <div class="action" data-action="next">Next &gt;</div>
                    <!-- <div id="submit" class="action nextbtn hidden">Request Quote</div> -->
                </div>

                <div class="step1door">
                    <h1 class="title"><img src="<?php echo base_url(); ?>/assets/images/altalum.png" alt="" align="left" style="margin-right: 10px" /> Slide Door Designer <br> <span style="font-size:0.7em">Altitude Aluminium Reynars CP130 Sliding Door</span></h1>
                    <div class="step1doorimg">
                        <img id="door-preview" src="<?php echo base_url(); ?>/assets/images/slider-preview.png" alt="" />           
                    </div>
                </div>
                <div class="step1details">
                    <div class="step1total">
                        <h2>Your Total</h2>
                        <p class="total-price">&pound;<span id="price">0.00</span> <span class="vat">inc. VAT</span></p>

                        <!-- tips for each section -->
                        <div id="sideinfo-configuration" class="tips">
                            <h3>Size &amp; Configuration Tips</h3>
                            <!-- <p>When selecting your sliding preference, consider whether you would prefer the sliding door to slide on the inside or outside of the frame as shown below.</p> -->
                            <p>First enter your required size by filling in the Width and Height fields below.  Once both are entered, select the type of door you require from the configurations list.</p>
                        </div>
                        <div id="sideinfo-colours" class="tips" style="display: none;">
                            <h3>Colours</h3>
                            <p>We have a huge range of colours to suit modern or traditional homes.<br><br></p>
                            <p><img src="../assets/images/help/colours.png" alt="" /></p>
                        </div>
                        <div id="sideinfo-hardware" class="tips" style="display: none;">
                            <h3>Hardware</h3>
                            <p>We can offer a stunning range of breathtaking hardware to add that stunning finishing touch to your sliding door.</p>
                        </div>
                        <div id="sideinfo-glass" class="tips" style="display: none;">
                            <h3>Glass</h3>
                            <p>Tailor your sliding door by selecting from Double Glazing or Triple Glazing.</p>
                        </div>
                        <div id="sideinfo-technical" class="tips" style="display: none;">
                            <h3>Technical</h3>
                            <p>Set any additional options for your sliding door by selecting from the options below.</p>
                            <p>Click on the 'more information' links to read more about the option you are interested in.</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- designer options -->
        	<div class="step1bot">
                <ul class="nav nav-pills nav-stacked" id="myTabs">
                    <li class="active"><a data-section="configuration" href="#size">Size &amp; Configuration</a></li>
                    <li><a data-section="colours" href="#colours">Colours</a></li>
                    <li><a data-section="hardware" href="#hardware">Hardware</a></li>
                    <li><a data-section="glass" href="#glass">Glass</a></li>
                    <!--<li><a data-section="technical" href="#technical">Technical</a></li>-->
                </ul>

                <div class="tab-content">

                    <!-- configurations -->
                	<div class="tab-pane step1sizetab active" id="size">
                    	<div class="step1sizetabl">

                        	<div class="step1size">
                            	<h2 class="optiontitle">1. Enter your frame size</h2>
                                <table>
                                	<tr>
                                    	<td>Width</td>
                                    	<td><input id="width" name="width" type="text" data-min="<?php echo $minmax['min_width']; ?>" data-max="<?php echo $minmax['max_width']; ?>" placeholder="between <?php echo $minmax['min_width']; ?> and <?php echo $minmax['max_width']; ?>" required="" autocomplete="off" /></td>
                                    </tr>
                                	<tr>
                                    	<td>Height</td>
                                    	<td><input id="height" name="height" type="text" data-min="<?php echo $minmax['min_height']; ?>" data-max="<?php echo $minmax['max_height']; ?>" placeholder="between <?php echo $minmax['min_height']; ?> and <?php echo $minmax['max_height']; ?>" required="" autocomplete="off" /></td>
                                    </tr>
                                </table>
                            </div>
                            <!--
                        	<div class="step1direction">
                            	<h2 class="optiontitle">2. Select your sliding preference</h2>
                                <div class="optionbtns">
                                    <a href="#" data-direction="in" class="active"><span>Slide Inside</span></a>
                                    <a href="#" data-direction="out"><span>Slide Outside</span></a>
                                </div>
                            </div>
                            -->
                        </div>
                        <div id="step1-1" class="step1configuration ">
                            <h2 class="optiontitle">2. Configurations <span id="step3-warning" class="hidden">- select an option from below</span></h2>
                            <div class="configoption" data-loaded-configurations="">
                                <div class="config-waiting">
                                    <p>Enter your sizes to view further options</p>
                                </div>
                            </div>
                        </div>
                        <?php if( 1 == 2 ) : ?>
                        <div id="step1-2" class="step1configuration hidden">
                            <h2 class="optiontitle">3. Configurations - Choose your Master Door ( <a id="return-to-configurations">&lt; Return to configuration list</a> )</h2>
                            <h3>
                                The Master Door will be used for access in and out of the room without the need to fully open all the doors. Please select which door you want to use for this access.
                            </h3>
                            <div class="handle-picker-container" data-configuration="">
                                <a class="picker left" data-handle-position="left">
                                    <img id="left-partial" class="handle-picker left" src="<?php echo base_url(); ?>/assets/images/partials/blank.png" />
                                    <br /><span>Left hand side</span>
                                </a>
                                <a class="picker right" data-handle-position="right">
                                    <img id="right-partial" class="handle-picker right" src="<?php echo base_url(); ?>/assets/images/partials/blank.png" />
                                    <br /><span>Right hand side</span>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>


                    <!-- colours -->
                    <div class="tab-pane step1colourstab" id="colours">
                        <div class="step2coloursinner">

                            <!-- external colour -->
                            <div id="colourbox-external" class="colourbox cb-loaded">
                                <div id="colourbox-external-container">
                                <?php $this->load->view('designer/block/external_colour_choice', array('colour'=>$door->external_colour, 'checked'=>$door->external_colour_id == $door->internal_colour_id)) ?>
                                </div>

                                <!-- button to set internal colour same as external colour -->
                                <!--
                                <span id="show-internal-colour-option" class="colourmatch">
                                    <input type="checkbox" name="type" value="colourmatch" id="cb-colourmatch" class="css-checkbox" />
                                    <label id="colour-match" class="css-label" for="cb-colourmatch">Choose different Internal Colour</label>
                                </span>
                                -->
                            </div>

                            <!-- internal colour -->
                            <!--
                            <div id="colourbox-internal" class="colourbox hidden">
                                <?php // $this->load->view('designer/block/internal_colour_choice', array('colour'=>$door->internal_colour, 'checked'=>$door->external_colour_id == $door->internal_colour_id)) ?>
                            </div>
                            -->

                            <!-- finish -->
                            <div id="colourbox-finish" class="">
                                <input type="hidden" name="external_colour_finish" value="matt">
                                <!-- external colour finish -->
                                <!--
                                <span id="external-finish" class="title">Finish</span>
                                <select name="external_colour_finish" class="form-control">
                                    <option value="matt">Matt Finish</option>
                                    <option value="satin">Satin Finish</option>
                                    <option value="gloss">Gloss Finish</option>
                                </select>
                                -->

                                <!-- internal colour finish -->
                                <!--
                                <div id="internal-finish" class="hidden">
                                    <span class="title">Internal Colour Finish</span>
                                    <select name="internal_colour_finish" class="form-control">
                                        <option value="matt">Matt Finish</option>
                                        <option value="satin">Satin Finish</option>
                                        <option value="gloss">Gloss Finish</option>
                                    </select>
                                </div>
                                -->
                            </div>

                        </div>
                    </div>


                    <!-- hardware -->
                    <div class="tab-pane step1hardwaretab" id="hardware">
                        <div id="hardware-content" class="group">

                            <!-- lock options for specification -->
                            <div id="specification" class="block">
                                <p>Specification</p>
                                <div class="container" style="height: 140px; overflow: auto">

                                    <ul class="specification click-options" data-target="specification" data-update-image="false">
                                        <li data-value="1" class="selected">
                                            <ul>
                                                <li>
                                                    <img src="<?php echo base_url(); ?>/assets/images/icons/option-door-handle.png" alt="" />
                                                    Inside Lock Handle<br />
                                                </li>
                                                <li>
                                                    <img src="<?php echo base_url(); ?>/assets/images/icons/option-finger-pull.png" alt="" />
                                                    Outside Finger Pull
                                                </li>
                                            </ul>
                                        </li>
                                        <li data-value="2">
                                            <ul>
                                                <li>
                                                    <img src="<?php echo base_url(); ?>/assets/images/icons/option-door-handle.png" alt="" />
                                                    Inside Lock Handle<br />
                                                </li>
                                                <li>
                                                    <img src="<?php echo base_url(); ?>/assets/images/icons/option-door-handle.png" alt="" />
                                                    Outside Lock Handle
                                                </li>
                                            </ul>
                                        </li>
                                        <li data-value="3">
                                            <ul>
                                                <li>
                                                    <img src="<?php echo base_url(); ?>/assets/images/icons/option-door-handle.png" alt="" />
                                                    Inside Lock Handle<br />
                                                </li>
                                                <li>
                                                    <img src="<?php echo base_url(); ?>/assets/images/icons/option-no-handle.png" alt="" />
                                                    Nothing On Outside
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <?php echo form_hidden('specification', 1); ?>
                                </div>
                            </div>

                            <!-- lock options for specification -->
                            <div id="handle-colour" class="block">
                                <p>Handle Colour</p>
                                <div class="container">
                                    <ul class="click-options" data-target="main_handle_external_colour_id" data-update-image="true">
                                    <?php foreach( $slidingdoorcolours as $key => $colour ) : ?>
                                        <?php if( $key == 0 ) { $starting_value = $colour->bifold_hardware_colour_id; } ?>
                                        <li class="main_handle_external_colour_id <?php echo ( $key == 0 ) ? 'selected' : ''; ?>" data-value="<?php echo $colour->bifold_hardware_colour_id; ?>" data-value-field="main_handle_external_colour_id">
                                            <div class="tiny-box" style="background: <?php echo $colour->hex_code; ?>"></div>
                                            <?php echo $colour->name; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </div>
                                <?php echo form_hidden('main_handle_external_colour_id', $starting_value); ?>
                            </div>

                        </div>
                    </div>


                    <!-- glass -->
                    <div class="tab-pane step1glasstab" id="glass">

                        <div class="row">&nbsp;</div>

                        <!-- top row -->
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="row"> 

                                    <div class="col-xs-4">
                                        <p>Glazing Type</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <?php
                                            $aOptions = array(
                                                array('value' => '0', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/double.png" /> Double Glazing'),
                                                array('value' => '1', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/triple.png" /> Triple Glazing'),
                                            );
                                            $this->load->view('designer/block/dropdown', array('target'=>'triple_glazing', 'id'=>'glazing-dropdown', 'update_image'=>'true', 'skip_fade'=>'true', 'options'=>$aOptions));
                                            echo form_hidden('triple_glazing', 0);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <!--<p>Glazing Tint</p>-->
                                    </div>
                                    <div class="col-xs-8">
                                        <?php
                                            //$aOptions = array(
                                            //    array('value' => '1', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/clear.png" /> Clear'),
                                            //    array('value' => '2', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/bronze.png" /> Bronze'),
                                            //    array('value' => '3', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/grey.png" /> Grey'),
                                            //);
                                            //$this->load->view('designer/block/dropdown', array('target'=>'tint_id', 'id'=>'tint-dropdown', 'update_image'=>'true', 'options'=>$aOptions));
                                            echo form_hidden('tint_id', 1);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>

                        <!-- bottom row -->
                        <div class="row">
                            <div id="self-cleaning" class="box-options col-xs-6">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <!--<p>Self Cleaning</p>-->
                                    </div>
                                    <div class="col-xs-8">
                                        <?php
                                            //$aOptions = array(
                                            //    array('value' => '1', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/cleaning-no.png" /> No'),
                                            //    array('value' => '2', 'text' => '<img src="'. base_url() .'/assets/images/image_layers/hardware/dropdowns/cleaning-yes.png" /> Yes'),
                                            //);
                                            //$this->load->view('designer/block/dropdown', array('target'=>'glass_id', 'id'=>'cleaning-dropdown', 'update_image'=>'true', 'options'=>$aOptions));
                                            echo form_hidden('glass_id', 1);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php # empty block ?>
                            <div id="energy-efficient" class="col-xs-6"></div>
                            <?php echo form_hidden('trickle_vent', 0); ?>
                        </div>
                    </div>


                    <!-- technical -->
                    <!--
                    <div class="tab-pane step1technicaltab" id="technical">
                    	<div class="row technical-container">

                            <div class="empty-block">
                                <img src="<?php echo base_url(); ?>/assets/images/trickle-vents.png" alt="Trickle Vents" />
                                <p>Trickle vents are small openings above the doors that allow small amounts of ventilation through the outer frame of the sliding folding doors. These trickle vents can be opened and closed manually to regulate ventilation accordingly.</p>
                            </div>

                            <div class="vents block">
                                <p>Trickle Vents Required</p>
                                <ul data-update-image="true" data-target="trickle_vent" class="click-options">
                                    <li data-value="1">Yes</li>
                                    <li data-value="0" class="selected">No</li>
                                </ul>
                            </div>

                        </div>

                    </div>
                    -->

                </div>
            </div>
        </div>
    </form>
</div>


<!-- colour picker modals -->
<div class="modal fade help-modal-external-colours colour-modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"></div></div></div>
<div class="modal fade help-modal-internal-colours colour-modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"></div></div></div>


<!-- general modal box -->
<div id="general-warning-message" class="modal fade warning-message" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Please note!</h4>
            </div>
            <div id="warning-message" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('structure/footer/designer.php') ?>