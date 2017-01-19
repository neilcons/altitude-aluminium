<?php $this->load->view('structure/header/thanks.php') ?>

<div id="centerbox">
	<div id="designer" class="container text-center">
		<h1 style="padding-top: 20px;">THANK YOU</h1>

		<p style="padding-top: 20px;">Thank you for your requesting a quote, we will contact you shortly.</p>
		<p>&nbsp;</p>

		<p><img style="max-width: 600px; width: auto;" src="<?php echo site_url(); ?>/ajax/image/<?php echo $image_id; ?>" /></p>

		<p>&nbsp;</p>
		<p style="padding: 10px 0 20px 0">Please check your email for a summary of your newly designed sliding door.</p>

		<a href="<?php echo site_url('designer'); ?>" class="btn btn-lg restart">Re-Design Another</a>

	</div>
</div>