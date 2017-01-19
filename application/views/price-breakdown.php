<table class="table">
	<thead>
		<tr>
			<th>Qty</th>
			<th>Description</th>
			<th>Price</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
<?php $total = 0; ?>
<?php foreach ($prices as $value): ?>
	<?php if(!empty($value->qty)): ?>
		<tr>
			<td><?=$value->qty ?></td>
			<td><?=$value->description ?></td>
			<td><?php $tst = $value->price; echo (empty($tst) ? '-' : '&pound;'.number_format($value->price, 2)) ?></td>
			<td><?php $tst = $value->total; echo (empty($tst) ? '-' : '&pound;'.number_format($value->total, 2)) ?></td>
		</tr>
	<?php endif ?>
<?php $total += $value->total ?>
<?php endforeach ?>
		<tr>
			<th colspan="3">NET</th>
			<th>&pound;<?=number_format($total, 2) ?></th>
		</tr>
		<tr>
			<th colspan="3">VAT</th>
			<th>&pound;<?=number_format($total * .2, 2) ?></th>
		</tr>
		<tr>
			<th colspan="3">TOTAL</th>
			<th>&pound;<?=number_format($total * 1.2, 2) ?></th>
		</tr>
	</tbody>
</table>
