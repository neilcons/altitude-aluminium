<table style="width:100%;background:#ebebeb;" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table style="width:700px;background:#ffffff;border-left:1px solid #bcbcbc;border-right:1px solid #bcbcbc;" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table style="width: 650px; border-bottom: 1px solid #bcbcbc; font-family: Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-left:6px;"><a href="http://www.altitudealuminium.co.uk/"><img src="<?php echo $image_url; ?>assets/images/email/altalum.png" height="34" width="70" alt="" border="0" /></a></td>
                                <td>
                                    <table style="width:350px; font-family: Arial, Helvetica, sans-serif; text-align:right;" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="font-size: 35px; color: #00C0D7; font-weight: bold;">Your Sliding Door Enquiry</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 15px; color: #656565;">Date: <?php echo Date('d/m/Y'); ?> &nbsp; Order Ref: <?php echo $door->reference(); ?> </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>

                <!-- bifold image -->
                <tr>
                    <td>
                        <table style="width:650px; font-family: Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 600px; padding-bottom: 30px; background: #F3F3F3; border: 1px solid #D9D9D9; text-align: center; overflow: hidden;">
                                    <p style="padding-top: 20px; color: #00C0D7; font-weight: bold; text-align: center;">Your Sliding Door</p>
                                    <img width="<?php echo ( $image_width > 600 ) ? 600 : $image_width; ?>" style="margin: 0 auto; border: 0; padding: 0; display: block; width: <?php echo ( $image_width > 600 ) ? 600 : $image_width; ?>px" src="<?php echo $image_source; ?>">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>



                <!-- separator -->
                <?php $this->load->view('email/blocks/separator'); ?>



                <!-- bifold and price summary -->
                <tr>
                    <td>
                        <table style="width:650px; font-family: Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table style="width: 100%; font-family: Arial, Helvetica, sans-serif;" align="left" cellpadding="0" cellspacing="0">
                                        <tr style="vertical-align: top;">
                                            <td style="width: 370px; max-width: 370px; vertial-align: top; color: #333;">
                                                <span style="font-size: 29px; color: #00C0D7;">Hi <?=$first_name ?></span><br />
                                                <p>Thank you for requesting a quote, your price breakdown is shown here.</p>
                                                <p>You can contact us regarding your quote by using any of the methods shown below.</p>
                                            </td>
                                            
                                            <td valign="top" style="vertial-align: top; padding: 0 20px; font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #818181; line-height: 21px;">
                                                <div style="padding: 10px 10px 20px 10px; width: 100%; border: 1px solid #D9D9D9; background: #F3F3F3;">
                                                    <table style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">
                                                        <tr>
                                                            <td style="padding-bottom: 10px; font-size: 20px; color: #00C0D7;" colspan="2">TOTAL PRICE</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 14px; padding-bottom: 10px;">TOTAL exc VAT</td>
                                                            <td style="font-size: 14px; padding-bottom: 10px;">&pound;<?php echo $quote_price; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 14px;">VAT</td>
                                                            <td style="font-size: 14px;">&pound;<?php echo $quote_vat; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 4px 0; font-size: 14px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-weight: bold;">TOTAL inc VAT</td>
                                                            <td style="padding: 4px 0; font-size: 14px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-weight: bold;">&pound;<?php echo $quote_total; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>



                <!-- separator -->
                <?php $this->load->view('email/blocks/separator'); ?>



                <!-- how to order cta's -->
                <tr>
                    <td>
                        <table style="width: 650px; background: #F3F3F3; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 134px;">
                                    <img src="<?php echo $image_url; ?>assets/images/email/how-to-order.png" />
                                </td>
                                <td>
                                    <table style="width: 250px; background: #FFF; border: 1px solid #00C0D7; font-family: Arial, Helvetica, sans-serif; box-shadow: 0px 3px 0px #CCC;" align="left" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding: 10px;"><img src="<?php echo $image_url; ?>assets/images/email/icon-telephone.png" /></td>
                                            <td style="padding-right: 10px;">
                                                <p style="padding: 0px; margin: 0px 0px 6px 0px; color: #00C0D7;">By Telephone</p>
                                                <p style="padding: 0px; margin: 0px; font-size: 12px; color: #666;">Call <span style="font-weight: bold; color: #000;"><?php echo $aa_telephone_number; ?></span> and quote your reference number</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 250px; background: #FFF; border: 1px solid #00C0D7; font-family: Arial, Helvetica, sans-serif; box-shadow: 0px 3px 0px #CCC;" align="left" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding: 10px;"><img src="<?php echo $image_url; ?>assets/images/email/icon-email.png" /></td>
                                            <td style="padding-right: 10px;">
                                                <p style="padding: 0px; margin: 0px 0px 6px 0px; color: #00C0D7;">By Email</p>
                                                <p style="padding: 0px; margin: 0px; font-size: 12px; color: #666;"><a style="text-decoration: none; font-weight: bold; color: #000;" href="mailto:<?php echo $aa_email_address; ?>?subject=Quote%20reference%20<?php echo $door->reference(); ?>">Click here</a> to email a member of our team quoting your ref number</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>



                <!-- separator -->
                <?php $this->load->view('email/blocks/separator'); ?>



                <!-- how to order cta's -->
                <tr>
                    <td>
                        <table style="width: 650px; font-family: Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                            <!-- header -->
                            <tr>
                                <td style="padding-bottom: 10px; font-size: 26px; color: #00C0D7;">Summary</td>
                            </tr>

                            <!-- options & content -->
                            <tr style="vertical-align: top;">
                                <td style="width: 50%;">

                                    <!-- supply type -->
                                    <table style="width: 100%; font-size: 12px; color: #333; font-family: Arial, Helvetica, sans-serif;">
                                        <tr>
                                            <td colspan="2" style="font-weight: bold; font-size: 14px; color: #333;">Installation</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">Supply Type</td>
                                            <td style="width: 50%"><?php echo $supply_type; ?></td>
                                        </tr>
                                    </table>

                                    <!-- frame options -->
                                    <table style="padding-top: 10px; width: 100%; font-size: 12px; color: #333; font-family: Arial, Helvetica, sans-serif;">
                                        <tr>
                                            <td colspan="2" style="font-weight: bold; font-size: 14px; color: #333;">Frame Options</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%; vertical-align: top;">Colour</td>
                                            <td style="width: 50%; vertical-align: top;">
                                                <?php echo $door->print_string('external_colour'); ?> (RAL<?php echo $external_ral; ?>)<br />
                                                <?php echo $door->external_colour_finish; ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <!-- glass -->
                                    <table style="width: 100%; font-size: 12px; color: #333; font-family: Arial, Helvetica, sans-serif;">
                                        <tr>
                                            <td colspan="2" style="font-weight: bold; font-size: 14px; color: #333;">Glass</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">Glazing Type</td>
                                            <td style="width: 50%"><?php echo $glazing_type; ?></td>
                                        </tr>
                                    </table>

                                </td>


                                <td style="width: 50%;">

                                    <!-- hardware colour -->
                                    <table style="padding-top: 10px; width: 100%; font-size: 12px; color: #333; font-family: Arial, Helvetica, sans-serif;">
                                        <tr>
                                            <td colspan="2" style="font-weight: bold; font-size: 14px; color: #333;">Hardware Options</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">External Handle</td>
                                            <td style="width: 50%"><?php echo ucfirst($door->print_string('specification')); ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">External Handle</td>
                                            <td style="width: 50%"><?php echo ucfirst($door->print_string('master_handle')); ?></td>
                                        </tr>
                                        <?php if( 1 == 2 ) : ?>
                                            <tr>
                                                <td style="width: 50%">Internal Handle</td>
                                                <td style="width: 50%"><?php echo ucfirst($door->print_string('slave_handle_colour_id')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>

                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>



                <!-- separator -->
                <?php $this->load->view('email/blocks/separator'); ?>



                <!-- how to order cta's -->
                <tr>
                    <td>
                        <table style="width: 650px; padding: 20px; background: #00C0D7; font-family: Arial, Helvetica, sans-serif; color: #FFF;" align="center" cellpadding="0" cellspacing="0">
                            <tr style="vertical-align: bottom;">
                                <!-- links and copyright -->
                                <td style="width: 50%;">
                                    <p style="margin: 0px; font-size: 12px;"><?php echo $aa_footer_copyright; ?></p>
                                </td>

                                <!-- contact details -->
                                <td style="width: 50%;">
                                    <p style="margin: 0px; font-size: 30px; text-align: right;"><?php echo $aa_freephone_telephone; ?></p>
                                    <p style="margin: 0px; font-size: 12px; text-align: right;"><a style="text-decoration: none; color: #FFF;" href="mailto:<?php echo $aa_email_address; ?>"><?php echo $aa_email_address; ?></a></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>



            </table>
        </td>
    </tr>
</table>