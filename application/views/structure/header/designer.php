<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $this->page->page_title('Sliding Door Designer') ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=960,user-scalable=yes">

	<?php echo $this->page->render_css() ?>

	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
<script>
	var base_url = '<?=base_url() ?>';
	var site_url = '<?=site_url('/') ?>';
	var MBF_SID = '<?=htmlspecialchars(SID) ?>';
</script>
</head>
<body>
