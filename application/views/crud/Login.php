<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
		<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<title>
			Crud Login
		</title>
	</head>
	<body>
		<div id="wrapper">
		  <?php echo form_open('auth/login');?>
			<h2 class="form-signin-heading">Please sign in</h2>
			<label class="sr-only">Email address</label>
			<input placeholder="username" class="form-control" type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" />
			<label class="sr-only">Password</label>
			<input placeholder="password" class="form-control" type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
			<div class="checkbox">
			  <label>
				<input type="checkbox" value="remember-me"> Remember me
			  </label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		  <?php echo form_close();?>
		</div> <!-- /container -->
	</body>
</html>
