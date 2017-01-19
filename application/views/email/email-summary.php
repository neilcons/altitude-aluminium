    <tr>
        <td>
            <table style="width:649px;background:#f3f3f3;border:1px solid #d9d9d9;" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="padding:15px 0px 10px 0px;">
                        <table style="width:100%;font-family:Arial, Helvetica, sans-serif;font-size:23px;color:#6ebbe6;text-align:center;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>Bi Fold Door (<?=$bifold->bifold_scheme->name ?>)</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0px;"><img src="<?=site_url('ajax/order_image/' . $bifold->id . '?' . SID, FALSE) ?>" height="158" alt="" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="font-family:Arial, Helvetica, sans-serif;font-size:17px;font-weight:bold;background:#ffffff;border:1px solid #d9d9d9;" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="color:#454545;padding:10px 5px 10px 15px;">PRICE</td>
                                            <td style="color:#6ebbe6;padding:10px 15px 10px 5px;">&pound;<?=number_format($bifold->get_total(), 2) ?></td>
                                        </tr>
<?php if($bifold->voucher_code != ''): ?>
                                        <tr>
                                            <td style="color:#454545;padding:10px 5px 10px 15px;">VOUCHER CODE</td>
                                            <td style="color:#6ebbe6;padding:10px 15px 10px 5px;"><?=strtoupper($bifold->voucher_code) ?></td>
                                        </tr>
<?php endif ?>
                                    </table>
                                </td>
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
            <table style="width:650px;font-family:Arial, Helvetica, sans-serif" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3" style="font-size:23px;color:#6ebbe6;padding-bottom:10px;">Summary</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width:232px;padding:5px 0px;">
                        <table style="width:205px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#454545;line-height:21px;" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2" style="font-size:15px;font-weight:bold;">Frame Colour</td>
                            </tr>
                            <tr>
                                <td>External</td>
                                <td style="color:#818181;"><?=$bifold->print_string('external_colour') ?></td>
                            </tr>
                            <tr>
                                <td>Internal</td>
                                <td style="color:#818181;"><?=$bifold->print_string('internal_colour') ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-size:15px;font-weight:bold;">Hardware Colour</td>
                            </tr>
                            <tr>
                                <td>Handle</td>
                                <td style="color:#818181;"><?=$bifold->print_string('master_handle') ?></td>
                            </tr>
                            <tr>
                                <td>Hinge</td>
                                <td style="color:#818181;"><?=$bifold->print_string('hinge_colour') ?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align: top;width:218px;border-left:1px solid #e7e7e7;border-right:1px solid #e7e7e7;padding:5px 0px;">
                        <table style="width:180px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#454545;line-height:21px;" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2" style="font-size:15px;font-weight:bold;">Technical Options</td>
                            </tr>
                            <tr>
                                <td>Width</td>
                                <td style="color:#818181;"><?=$bifold->width ?>mm</td>
                            </tr>
                            <tr>
                                <td>Height</td>
                                <td style="color:#818181;"><?=$bifold->height ?>mm</td>
                            </tr>
                            <tr>
                                <td>Opening</td>
                                <td style="color:#818181;"><?=$bifold->print_string('opening') ?></td>
                            </tr>
                            <tr>
                                <td>Slide to</td>
                                <td style="color:#818181;"><?=$bifold->print_string('slide_direction') ?></td>
                            </tr>
                            <tr>
                                <td>Cill</td>
                                <td style="color:#818181;"><?=$bifold->print_string('cill') ?></td>
                            </tr>
                            <tr>
                                <td>Threshold</td>
                                <td style="color:#818181;"><?=$bifold->print_string('threshold') ?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align: top;width:203px;padding:5px 0px;">
                        <table style="width:175px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#454545;line-height:21px;" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2" style="font-size:15px;font-weight:bold;">Technical Options</td>
                            </tr>
                            <tr>
                                <td>Trickle Vents</td>
                                <td style="color:#818181;"><?=$bifold->print_string('trickle_vent') ?></td>
                            </tr>
                            <tr>
                                <td>Drainage</td>
                                <td style="color:#818181;"><?=$bifold->print_string('drainage') ?></td>
                            </tr>
                            <tr>
                                <td>Midrail</td>
                                <td style="color:#818181;"><?=$bifold->print_string('midrail') ?></td>
                            </tr>
                            <tr>
                                <td>Triple Glazing</td>
                                <td style="color:#818181;"><?=$bifold->print_string('triple_glazing')?></td>
                            </tr>
                            <tr>
                                <td>Anti Sun</td>
                                <td style="color:#818181;"><?=$bifold->print_string('anti_sun')?></td>
                            </tr>
                            <tr>
                                <td>Blinds</td>
                                <td style="color:#818181;"><?=$bifold->print_string('blind') ?></td>
                            </tr>
                            <tr>
                                <td>Magnets</td>
                                <td style="color:#818181;"><?=$bifold->print_string('magnets') ?></td>
                            </tr>
                            </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>