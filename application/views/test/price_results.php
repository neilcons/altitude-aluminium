<?php $this->load->view('structure/header/test.php') ?>

<h1>Test Results</h1>

<style type="text/css">
	.test-pass{
		background-color: #0F0;
	}
	.test-fail{
		background-color: #F00;
	}
	.test-faint-pass{
		background-color: #d0edcc;
	}
	.test-faint-fail{
		background-color: #efc4cb;
	}
</style>
<div style="overflow:auto;">
<?php foreach($this->unit->result() as $key=>$result): ?>
<div style="padding:5px;margin:5px;" class="pull-left <?=($result['Result'] == 'Passed' ? 'test-faint-pass' : 'test-faint-fail') ?>"><strong><?=$key+1 ?></strong></div>
<?php endforeach ?>
</div>


<?php foreach($this->unit->result() as $key=>$result): ?>
<h2 style="padding:5px" class="<?=($result['Result'] == 'Passed' ? 'test-pass' : 'test-fail') ?>">Test #<?=$key+1 ?></h2>
<div class="row">
	<div class="col-md-6"><?=$result['Test Name']?></div>
	<div class="col-md-6 <?=($result['Result'] == 'Passed' ? 'test-faint-pass' : 'test-faint-fail') ?>"><?=$result['Notes']?></div>
</div>


<?php endforeach ?>

<?php $this->load->view('structure/footer/test.php') ?>