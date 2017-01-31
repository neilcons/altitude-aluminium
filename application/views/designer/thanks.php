<?php
	$this->load->view('structure/header/designer.php');

	$price = $data['quote_total'];
	$dPrice = str_replace(',', '', $price);
	$dNet = $dPrice / 1.2;
	$dVAT = $dPrice - $dNet;
?>
<div id="centerbox">
	<div id="designer" class="container text-center">
		<p style="text-align:center; margin-top:15px;">
			<img src="<?php echo base_url(); ?>/assets/images/altalum-lrg.png" alt="" />
		</p>
		<h1 style="padding-top: 20px;">THANK YOU</h1>

		<p style="padding-bottom:10px;">Thank you for your requesting a quote, we will contact you shortly.</p>

		<h2 class="center">Your Basic Quote: &pound;<span id="price"><?php echo $price; ?></h2>
		<h3 class="center">
			Net &pound;<span id="net"><?php echo number_format($dNet, 2); ?></span>
			&nbsp;+&nbsp;
			VAT &pound;<span id="vat"><?php echo number_format($dVAT, 2); ?></span>
		</h3>
		<p>&nbsp;</p>

		<p><img style="max-width:600px; max-height:270px" src="<?php echo site_url(); ?>/ajax/image/<?php echo $data['image'] ?>" /></p>

		<p>&nbsp;</p>
		<p style="padding: 0 0 15px 0">Please check your email for a summary of your newly designed lift and slide door.</p>

		<a href="<?php echo site_url('designer'); ?>" class="btn btn-lg restart">Design Another</a>

	</div>
</div>

<?php $this->load->view('structure/footer/designer.php') ?>