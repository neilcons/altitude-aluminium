<html lang="en">
<head>
<title>Altitude Aluminium Admin - Login</title>
</head>
<body>

<?php echo form_open('/admin/', array('id'=>'primaryform', 'method'=>'post')); ?>

	<div style="margin: 10% auto; width: 400px; border: 1px solid #ccc; border-radius: 5px; padding: 10px; color: #666; font-family: Arial; font-size: 12px; text-align: center;">
		<h1 style="margin: 0px; padding: 10px 0; text-align: center;">Altitude Aluminium Admin Login</h1>
		<p>
			<label style="float: left; width: 100px;">Username</label>
			<input style="width: 250px;" type="text" name="username" />
		</p>
		<p>
			<label style="float: left; width: 100px;">Password</label>
			<input style="width: 250px;" type="password" name="password" />
		</p>
		<p style="text-align: right; padding-right: 50px;">
			<input type="submit" value="Login" />
		</p>
	</div>

<?php echo form_close(); ?>

</body>
</html>