<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $this->page->page_title('Altitude Aluminium Admin') ?></title>
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
</script>
</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Altitude Aluminium Admin</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
                      <?php if(1 == 2) : ?>
                      <li><a href="#">Home</a></li>
                      <li class="active"><a href="#about">Pricing</a></li>
                      <li><a href="#codes">Discount Codes</a></li>
                      <li><a href="#contact">Orders</a></li>
                      <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

