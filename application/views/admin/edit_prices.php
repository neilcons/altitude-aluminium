<?php $this->load->view('structure/header/admin.php') ?>

<h1>1000 Series Aluminium Bifold Cost Prices Unglazed</h1>

<?=form_open('admin/save_matrix', '')?>

<h2>Scheme Price Matrix</h2>

<table class="table table-condensed">
<thead>
    <tr>
        <th colspan="5">&nbsp;</th>
        <th colspan="2">White / Grey<br>KL010 / KL005</th>
        <th rowspan="3">&nbsp;</th>
        <th colspan="2">RAL / KL<br>Sensation</th>
        <th rowspan="3">&nbsp;</th>
        <th colspan="2">Dual Colour</th>
        <th rowspan="3">&nbsp;</th>
        <th colspan="2">Glass Deductions</th>
    </tr>
    <tr>
        <th colspan="2">&nbsp;</th>
        <th colspan="2">Width</th>
        <th rowspan="2">&nbsp;</th>
        <th colspan="2">Height (up to)</th>
        <th colspan="2">Height (up to)</th>
        <th colspan="2">Height (up to)</th>
        <th colspan="2">Std Threshold</th>
    </tr>
    <tr>
        <th>Style</th>
        <th>&nbsp;</th>
        <th>From</th>
        <th>To</th>
        <th>2290</th>
        <th>2500</th>
        <th>2290</th>
        <th>2500</th>
        <th>2290</th>
        <th>2500</th>
        <th>Width</th>
        <th>Height</th>
    <tr>
</thead>
<tbody>

<?php $first_row = TRUE; $height_from = array(); foreach($matrix as $scheme_pricing): ?>

<?php $first_width = TRUE; foreach($scheme_pricing as $width_to=>$row): ?>

    <tr>

<?php if($first_width): ?>        <th rowspan="<?php echo $first_row ? 1 : 2 ?>"><nobr><?=implode('/',$row['bifold_scheme']->get_names()) ?></nobr></th><?php endif ?>

<?php if($first_row): ?>        <td rowspan="<?=count($matrix) * 2?>">&nbsp;</td><?php endif ?>

        <td><p class="form-control-static"><?=$first_width ? $row['bifold_scheme']->min_width : $width_from ?></p></td>

        <td><?php echo form_input('bifold_scheme_price_width['. $row['bifold_scheme']->id .']['.$width_to.']', $width_to, 'class="form-control"'); $width_from = $width_to + 1 ?></td>

<?php if($first_row): ?>        <td rowspan="<?=count($matrix) * 2?>">&nbsp;</td><?php endif ?>

        <td><?=form_input('bifold_scheme_price_matrix['. $row['price_white_grey']['2290']['bifold_scheme_price_matrix_id'] .'][price_white_grey]', $row['price_white_grey']['2290']['price'], 'class="form-control"') ?></td>

        <td><?=form_input('bifold_scheme_price_matrix['. $row['price_white_grey']['2500']['bifold_scheme_price_matrix_id'] .'][price_white_grey]', $row['price_white_grey']['2500']['price'], 'class="form-control"') ?></td>

<?php if($first_row): ?>        <td rowspan="<?=count($matrix) * 2?>">&nbsp;</td><?php endif ?>

        <td><?=form_input('bifold_scheme_price_matrix['. $row['price_ral_kl_sensation']['2290']['bifold_scheme_price_matrix_id'] .'][price_ral_kl_sensation]', $row['price_ral_kl_sensation']['2290']['price'], 'class="form-control"') ?></td>

        <td><?=form_input('bifold_scheme_price_matrix['. $row['price_ral_kl_sensation']['2500']['bifold_scheme_price_matrix_id'] .'][price_ral_kl_sensation]', $row['price_ral_kl_sensation']['2500']['price'], 'class="form-control"') ?></td>

<?php if($first_row): ?>        <td rowspan="<?=count($matrix) * 2?>">&nbsp;</td><?php endif ?>

        <td><?=form_input('bifold_scheme_price_matrix['. $row['price_dual']['2290']['bifold_scheme_price_matrix_id'] .'][price_dual]', $row['price_dual']['2290']['price'], 'class="form-control"') ?></td>
        <td><?=form_input('bifold_scheme_price_matrix['. $row['price_dual']['2500']['bifold_scheme_price_matrix_id'] .'][price_dual]', $row['price_dual']['2500']['price'], 'class="form-control"') ?></td>

<?php if($first_row): ?>        <td rowspan="<?=count($matrix) * 2?>">&nbsp;</td><?php endif ?>

<?php if($first_width): ?>
        <td rowspan="<?php echo $first_row ? 1 : 2 ?>"><?=form_input('bifold_scheme['. $row['bifold_scheme']->id .'][width_deduction]', $row['bifold_scheme']->width_deduction, 'class="form-control"') ?></td>
        <td rowspan="<?php echo $first_row ? 1 : 2 ?>"><?=form_input('bifold_scheme['. $row['bifold_scheme']->id .'][height_deduction]', $row['bifold_scheme']->height_deduction, 'class="form-control"') ?></td>
<?php endif ?>

    </tr>
<?php $first_row = FALSE; $first_width = FALSE; endforeach ?>
<?php endforeach ?>
</tbody>
</table>

<h2>Cill Prices</h2>

<table class="table table-condensed">
    <thead>
        <th>Name</th>
        <th>White / Grey<br>KL010 / KL005</th>
        <th>RAL / KL<br>Sensation</th>
        <th>Dual Colour</th>
    </thead>
    <tbody>
<?php foreach($cills as $cill): ?>
    <tr>
        <th><?=$cill->name ?></th>
        <td><?=form_input('bifold_cill['. $cill->id .'][price_white_grey]', $cill->price_white_grey, 'class="form-control"') ?></td>
        <td><?=form_input('bifold_cill['. $cill->id .'][price_ral_kl_sensation]', $cill->price_ral_kl_sensation, 'class="form-control"') ?></td>
        <td><?=form_input('bifold_cill['. $cill->id .'][price_dual]', $cill->price_dual, 'class="form-control"') ?></td>
    </tr>
<?php endforeach ?>
    </tbody>
</table>

<h2>Other Extras</h2>

<table class="table table-condensed">
    <thead>
        <th>Name</th>
        <th>Price</th>
    </thead>
    <tbody>
<?php foreach($extras as $extra): ?>
    <tr>
        <th><?=$extra->name ?></th>
        <td><?=form_input('bifold_extra['. $extra->id .'][price]', $extra->price, 'class="form-control"') ?></td>
    </tr>
<?php endforeach ?>
    </tbody>
</table>

<p><button class="btn btn-block btn-lg">Save Changes</button></p>
</form>
<?php $this->load->view('structure/footer/designer.php') ?>