<table style="width:100%;background:#ebebeb;" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table style="width:700px;background:#ffffff;border-left:1px solid #bcbcbc;border-right:1px solid #bcbcbc;" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table style="width:650px;border-bottom:1px solid #bcbcbc;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-left:6px;"><a href="http://mybifold.co.uk"><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/logo.jpg" height="67" width="161" alt="" border="0" /></a></td>
                                <td>
                                    <table style="width:350px;font-family:Arial, Helvetica, sans-serif;text-align:right;" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="font-size:35px;color:#6ebbe6;font-weight:bold;">Your Bi Fold Enquiry</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:15px;color:#656565;">Date: <?=$order->date->format('d/m/Y'); ?> &nbsp; Order Ref: <?=$order->reference(); ?> </td>
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
                <tr>
                    <td>
                        <table style="width:650px;font-family:Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table style="width:100%" align="left" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="width:420px;font-size:29px;color:#6ebbe6;padding-bottom:10px;">Hi <?=$order->first_name ?>...</td>
                                            <td rowspan="2" valign="top" style="vertial-align:top;text-align:right;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#818181;line-height:21px;"><span style="font-size:15px;color:#454545;font-weight:bold;">Delivery Address</span><br />
                                    <?=$order->first_name ?> <?=$order->surname ?><br />
                                    <?=$order->address1 ?><br />
                                    <?=$order->address2 ?><br />
                                    <?=$order->address3 ?><br />
                                    <?=$order->postcode ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width:420px;font-size:21px;color:#818181;line-height:27px;">Thank you for your enquiry, please see your bifold summary below!
                                                <p>We will soon be offering an online ordering facility.  In the meantime if you wish to purchase this door please phone the office on<br/>01522 512 525.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                   <!-- <table style="width:257px;background:#f3f3f3;border:1px solid #dbdbdb;" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding:15px 20px 18px 22px;">
                                                <table style="width:100%;font-family:Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td colspan="2" style="font-size:21px;color:#6ebbe6;padding-bottom:5px;">TOTAL PRICE</td>
                                                    </tr>
                                                    <tr style="font-size:15px;color:#454545;line-height:19px;">
                                                        <td>Price</td>
                                                        <td>&pound;000000.00</td>
                                                    </tr>
                                                    <tr style="font-size:15px;color:#454545;line-height:19px;">
                                                        <td style="padding-bottom:5px;">Installation</td>
                                                        <td style="padding-bottom:5px;">&pound;000000.00</td>
                                                    </tr>
                                                    <tr style="font-size:15px;font-weight:bold;">
                                                        <td style="color:#454545;padding:5px 0px;border-top:1px solid #808080;border-bottom:1px solid #808080;">TOTAL COST</td>
                                                        <td style="color:#6ebbe6;padding:5px 0px;border-top:1px solid #808080;border-bottom:1px solid #808080;">&pound;000000.00</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table> -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
<?php foreach($order->get_products() as $product): ?>
<?php $this->load->view('email/email-summary.php', array('bifold'=>$product));?>
<?php endforeach ?>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table style="width:663px;background:#111a1d;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table align="center" cellpadding="0" cellspacing="0">
                                        <tr style="vertical-align:top;">
                                            <td style="width:200px;padding: 0px 10px;">
                                                <table style="width:180px;font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#ffffff;line-height:15px;" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="font-size:13px;font-weight:bold;">Our Company</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/about-us" style="color:#88969e;text-decoration:none;">About Us</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/privacy-policy" style="color:#88969e;text-decoration:none;">Privacy Policy</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/terms-of-use" style="color:#88969e;text-decoration:none;">Terms of Use</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/contact-us" style="color:#88969e;text-decoration:none;">Contact Us</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/testimonials" style="color:#88969e;text-decoration:none;">Testimonials</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="width:209px;padding: 0px 10px;border-right:2px solid #53595c;border-left:2px solid #53595c;">
                                                <table style="width:180px;font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#ffffff;line-height:15px;" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="font-size:13px;font-weight:bold;">Need Help?</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/faqs" style="color:#88969e;text-decoration:none;">FAQs</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/our-guarantee" style="color:#88969e;text-decoration:none;">Our Guarantee</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/technical-information" style="color:#88969e;text-decoration:none;">Technical Information</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="http://mybifold.co.uk/links" style="color:#88969e;text-decoration:none;">Links</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="width:200px;padding: 0px 10px;">
                                                <table style="width:180px;font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#ffffff;line-height:15px;" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="font-size:13px;font-weight:bold;">Get in Touch</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color:#88969e;"><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> 01522 512 252</td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlink.jpg" height="4" width="2" alt="" style="vertical-align:middle;" /> <a href="mailto:enquiries@mybifold.co.uk" style="color:#88969e;text-decoration:none;">enquiries@mybifold.co.uk</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width:633px;" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footerlogo.jpg" height="41" width="96" alt="" /></td>
                                            <td style="text-align:right;padding-right:62px;">
                                                <a href="http://mybifold.co.uk/"><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footer-home.jpg" height="14" width="15" alt="" border="0" /></a> &nbsp;&nbsp;&nbsp;
                                                <a href="http://twitter.com/mybifold"><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footer-twitter.jpg" height="14" width="18" alt="" border="0" /></a> &nbsp;&nbsp;&nbsp;
                                                <a href="http://facebook.com/mybifold"><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footer-facebook.jpg" height="14" width="8" alt="" border="0" /></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><img src="http://dev.beta.echodigitalmedia.co.uk/mybifold-static/email/confirmation/footer.jpg" alt="" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>