<?php
$CI =& get_instance();
$CI->load->model('bifold_pricer');
?>

<table class="table">
	<thead>
		<tr>
			<th>Qty</th>
			<th>Description</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
<?php $total = 0; ?>
<?php foreach ($CI->bifold_pricer->price_breakdown($bifold) as $value): ?>
	<?php if(!empty($value->qty)): ?>
		<tr>
			<td><?=$value->qty ?></td>
			<td><?=$value->description ?></td>
			<td><?php $tst = $value->price; echo (empty($tst) ? '-' : '&pound;'.number_format($value->price * $value->qty, 2)) ?></td>
			<td><?php $tst = $value->discount; echo (empty($tst) ? '-' : $value->discount) ?></td>
			<td><?php $tst = $value->total; echo (empty($tst) ? '-' : '&pound;'.number_format($value->total, 2)) ?></td>
		</tr>
	<?php endif ?>
<?php $total += $value->total ?>
<?php endforeach ?>
		<tr>
			<th colspan="4">total</th>
			<th>&pound;<?=number_format($total, 2) ?></th>
		</tr>
	</tbody>
</table>
