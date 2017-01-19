<?php $this->load->view('structure/header/admin.php') ?>

<input type="hidden" name="order-id" value="0" />
<table class="admin datatable" data-sid="<?php echo session_id(); ?>">
    <thead>
        <!-- header groups -->
        <tr>
            <th>Date</th>
            <th>Ref</th>
            <th>Customer Details</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        <!-- values -->
        <?php foreach( $orders as $order ) : ?>
        <tr>
            <td>
                <a name="order-<?php echo $order->id; ?>"></a>
                <?php echo Date('d/m/Y', strtotime($order->date)); ?>
            </td>
            <td><?php echo str_pad($order->id, 7, '0', STR_PAD_LEFT); ?></td>
            <td>
                <?php 
                    echo $order->your_name;

                    if( $order->your_address != '' ) {
                        echo ', '. $order->your_address;
                    }

                    if( $order->your_postcode != '' ) {
                        echo ', '. $order->your_postcode;
                    }

                    if( $order->your_email != '' ) {
                        echo ', <a href="mailto:'. $order->your_email .'">'. $order->your_email .'</a>';
                    }

                    if( $order->your_tel != '' ) {
                        echo ', '. $order->your_tel;
                    }
                ?>
            </td>
            <td><a class="view-quote-email" data-bifold-id="<?php echo $order->id; ?>" href="#order-<?php echo $order->id; ?>">View Order Email</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- modals -->
<div id="popup" class="modal fade colour-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="print-email btn btn-default">Print</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div class="popup-content"></div>
            <div class="modal-footer">
                <button type="button" class="print-email btn btn-default">Print</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('structure/footer/admin.php') ?>