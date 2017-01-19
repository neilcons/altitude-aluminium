<div class="cart" style="margin:0 10px 0px 0px">
    <table>
        <tr class="strong">
            <td>Current bifold:</td>
            <td>&pound;<span class="current_item_price"><?=number_format($item->get_total(), 2) ?></span></td>
        </tr>
<?php if($this->session->cart->get_count() > 0): ?>
        <tr class="strong">
            <td><a href="<?=site_url('designer/summary') ?>">Shopping Cart (<?=$cart->get_count() ?>)</a></td>
            <td>&pound;<?=number_format($cart->get_total(), 2) ?></td>
        </tr>
<?php endif ?>
    </table>
</div>