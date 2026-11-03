		<base href="<?php echo base_url(); ?>" />
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $this->config->item('APP_NAME'); ?></title>
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
		<!-- iCheck -->
		<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
		<!-- Morris chart -->
		<link rel="stylesheet" href="plugins/morris/morris.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<!-- Select 2 -->
		<link rel="stylesheet" href="plugins/select2/select2.min.css">
		<!-- Date Picker -->
		<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		
		<!-- Bootstrap treeview -->
		<link rel="stylesheet" href="includes/css/bootstrap-treeview.css">
		
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,700" rel="stylesheet">
		
		<!-- WYSIHTML5  -->
		<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		
		<!-- CustomStyle -->
		<link rel="stylesheet" href="includes/css/style.css">
		<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.css">
		<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.structure.css">
		<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.theme.css">
		
		<?php 
		if(isset($additionalcss)){ 
			if(is_array($additionalcss)){
				foreach($additionalcss as $c){
					echo '<link rel="stylesheet" href="'.$c.'">';
				}
			};
		}
		if(isset($customcss)){ 
			if(is_array($customcss)){
				foreach($customcss as $c){
					echo '<link rel="stylesheet" href="includes/css/'.$c.'">';
				}
			};
		}
		?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script>
		var tree = false;
		</script>
		<style>
		#my-video {
			display: none;
		}
		</style>