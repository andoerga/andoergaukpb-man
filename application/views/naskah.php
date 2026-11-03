<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Sistem Terpadu Penjaringan Berita TV Edukasi</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		
		<!-- CustomStyle -->
		<link rel="stylesheet" href="includes/css/style.css">
		<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.css">
		<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.structure.css">
		<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.theme.css">
	</head>
	<body class="hold-transition skin-blue skin-custom sidebar-mini sidebar-collapse">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<?php echo $content; ?>
					</div>
				</div>
		</div>
		
		<!-- jQuery 2.1.4 -->
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.5 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>