<?php $this->load->view('structure/header/designer.php') ?>

<div id="centerbox">
    <?php echo form_open('/quote/submit', array('id'=>'primaryform', 'method'=>'post', 'data-toggle'=>'validator', 'role'=>'form')); ?>

        <?php
            // draw hidden field for type
            echo form_hidden('supply_type', 'supply');

            // load url helper
            $this->load->helper('url');
        ?>

        <div id="designer" class="summary row">

            <!-- image preview and summary -->
            <div class="col-xs-8">

                <h1 class="title">
                    <img src="<?php echo base_url(); ?>/assets/images/altalum.png" alt="" align="left" style="margin-right: 15px" />
                    <span style="padding-top:6px; padding-bottom:15px;">Your New Reynaers Aluminium <br> CP130 Lift and Slide Door</span>
                </h1>

                <!-- the door image -->
                <div class="image-preview">
                    <img src="data:image/jpeg;base64,<?php echo $base64_image; ?>" alt="" />
                </div>

                <!-- the options -->
                <div class="options">
                    <h1>Summary</h1>

                    <div class="row">

                        <!-- configuration left hand side -->
                        <div class="col-xs-6">
                            <h2>Frame Options</h2>
                            <p><strong>Colour</strong><p>
                            <p style="margin-bottom:10px">
                                <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                <?php echo $door->print_string('external_colour'); ?> RAL<?php echo $external_ral; ?>
                            </p>

                            <p><strong>Finish</strong><p>
                            <p style="margin-bottom:10px">
                                <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                <?php echo ucfirst($door->external_colour_finish); ?>
                            </p>

                            <h2>Glass</h2>
                            <p style="margin-bottom:10px">
                                <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                Glazing type: <?php echo $glazing_type; ?>
                            </p>

                        </div>

                        <!-- configuration right hand side -->
                        <div class="col-xs-6">

                            <h2>Hardware Options</h2>
                            <p>
                                <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                Specification: <?php echo ucfirst($door->print_string('specification')); ?><br />
                            </p>

                            <?php if( 1 == 2 ) : ?>
                                <?php if( $show_external_handle_options ) : ?>
                                    <p>
                                        <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                        External handle: <?php echo ucfirst($door->print_string('master_handle')); ?><br />
                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <p>
                                <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                Handle colour: <?php echo ucfirst($door->print_string('main_handle_external_colour_id')); ?>
                            </p>

                            <h2>Dimensions</h2>
                            <p>
                                <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                Width: <?php echo $door->print_string('width'); ?>mm<br />
                            </p>
                                    <p>
                                        <span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>
                                        Height: <?php echo $door->print_string('height'); ?>mm<br />
                                    </p>
                        </div>
                    </div>
                </div>

            </div>



<?php
    $dPrice = str_replace(',', '', $price);
    $dNet = $dPrice / 1.2;
    $dVAT = $dPrice - $dNet;
?>
            <div class="col-xs-4">
                <!--
                <h1 class="center">Your Basic Quote</h1>
                <h1 class="center">&pound;<span id="price"><?php echo $price; ?></span></h1>
                <h3 class="center">
                    Net &pound;<span id="net"><?php echo number_format($dNet, 2); ?></span>
                    &nbsp;+&nbsp;
                    VAT &pound;<span id="vat"><?php echo number_format($dVAT, 2); ?></span>
                </h3>
                -->
                <div class="row type-container">
                    <br><br>
                </div>
                <div class="row type-container">
                    <div class="col-xs-5">
                        <p>
                            <input type="radio" class="css-checkbox" id="cb-supply" value="supply" name="supply-type-picker" checked="checked">
                            <label for="cb-supply" data-value="supply" class="css-label selected"><nobr>Supply Only</nobr></label>
                        </p>
                    </div>
                    <div class="col-xs-7">
                        <p>
                            <input type="radio" class="css-checkbox" id="cb-install" checked="checked" value="install" name="supply-type-picker">
                            <label for="cb-install" data-value="install" class="css-label">Fully Installed</label>
                        </p>
                    </div>
                </div>
                <div class="contact-details-container">

                    <div class="form-group">
                        <p>
                            <label for="enq_your_name" class="label-left control-label">Name</label>
                            <input type="text" required placeholder="Your name" class="form-control medium" id="enq_your_name" value="" name="your_name">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="enq_address" class="label-left">Address:</label><br />
                            <textarea placeholder="Your address" class="form-control medium" id="enq_address" value="" name="your_address"></textarea>
                        </p>
                    </div>
                    <div class="" style="float:left;width:50%">
                        <p>
                            <label for="enq_postcode" class="label-left">Postcode:</label>
                            <input type="text" placeholder="Your postcode" class="form-control small" style="width:95%" id="enq_postcode" value="" name="your_postcode">
                        </p>
                    </div>
                    <div class="" style="float:left;width:50%">
                        <p>
                            <label for="enq_telephone" class="label-left control-label">Telephone:</label>
                            <input type="text" required placeholder="Your contact number" class="form-control small" style="width:95%" id="enq_telephone" value="" name="your_tel">
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            <label for="enq_email" class="label-left control-label">Email:</label>
                            <input type="text" required placeholder="Your email address" class="form-control medium" id="enq_email" value="" name="your_email">
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            <label for="enq_notes" class="label-left" style="width:120px">Additional Notes:</label><br />
                            <textarea placeholder="Notes" class="form-control medium" id="enq_notes" value="" name="notes"></textarea>
                        </p>
                    </div>
                </div>
                <p style="font-size:0.8em">We aim to contact you within 48 hours to discuss your interest. We will <strong>never</strong> pass your details onto any 3rd party.</p>
                <p class="submit-button"><input type="submit" value="Request a Quote" class="btn btn-block btn-success btn-lg" id="request-quote"></p>
                <p id="info"></p>

            </div>
        </div>
    </form>
</div>


<!-- modals -->
<div class="modal fade colour-modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"></div></div></div>

<?php $this->load->view('structure/footer/designer.php') ?>