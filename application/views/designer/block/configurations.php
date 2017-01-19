<?php foreach($schemes as $scheme): ?>

	<?php
		// get the breakdown of this style
		$aConfig	= explode('-', $scheme->style);
		$sPanels	= $aConfig[0];
		$sHandle	= $aConfig[1];
		$sSlideTo	= $aConfig[2];
	?>

	<div class="configoptionbox">
		<a data-scheme-id="<?php echo $scheme->id; ?>" data-panels="<?php echo $sPanels; ?>" data-handle-on="<?php echo $sHandle; ?>" data-slide-to="<?php echo $sSlideTo; ?>">
			<img class="img-responsive center-block normal" src="<?php echo base_url('assets/images/schemes/'. $scheme->style); ?>.png" alt="" />
			<img class="img-responsive center-block hover hidden" src="<?php echo base_url('assets/images/schemes/'. $scheme->style); ?>-hover.png" alt="" />
		</a>
	</div>

<?php endforeach; ?>