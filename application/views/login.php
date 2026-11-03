<!DOCTYPE html>
<html >
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta charset="UTF-8">
		<title><?php echo $this->config->item('APP_NAME'); ?></title>
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
		
		<link rel="stylesheet" href="includes/css/style_login.css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77713226-3"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-77713226-3');
		</script>
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php /*
					<div class="col-xs-12 col-md-6 first-column">
						<div class="row">
							<div class="col-xs-12">
								<img src="includes/img/logo.png" class="img-responsive logo" />
								<br />
								<br />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-offset-3 col-xs-3">
								<img src="includes/img/pustekkom.jpg" class="img-responsive" />
							</div>
							<div class="col-xs-3">
								<img src="includes/img/tve.jpg" class="img-responsive" />
							</div>
						</div>
						
					</div>
					*/ ?>
					<div id="login-box" class="col-xs-12">
						<h1>Selamat Datang</h1>
						<?php /*<h3><?php echo $this->config->item('APP_NAME'); ?></h3>*/ ?>
						<h3>SIM Uji Kompetensi Kenaikan Jenjang Jabatan <br />Penilik dan Pamong Belajar</h3>
						
						<form class="form" action="<?php echo site_url('login'); ?>" method="post">
							<input type="text" name="username" placeholder="Username">
							<input type="password" name="password" placeholder="Password">
							<?php if(validation_errors()){ ?>
								<?php echo validation_errors(); ?>
								<br />
							<?php } ?>
							<?php if($message_error){ ?>
								<p><?php echo $message_error; ?></p>
								<br />
							<?php } ?>
							<button type="submit" id="login-button" name="form-submit" value="1">Login</button>
							
						</form>
					</div>
					
				</div>
				
			</div>
			<div class="logo-container">
				<div class="container">
					
				</div>
			</div>
			
		</div>
		<!-- jQuery 2.1.4 -->
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="includes/js/login.js"></script>
	</body>
</html>
