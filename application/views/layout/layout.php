<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('layout/partial/top'); ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77713226-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-77713226-3');
</script>
	</head>
	<body class="hold-transition skin-blue skin-custom sidebar-mini <?php echo is_sidebar_collapse() ? 'sidebar-collapse' : ''; ?>">
		<div class="wrapper">
			<?php $this->load->view('layout/partial/header', array('module' => $module)); ?>
			
			<div class="content-wrapper">
				<?php if($module != 'home'){ ?>
				<?php $this->load->view('layout/partial/content_header'); ?>
				<?php } ?>
				<?php $this->load->view('pages/'.$module.'/'.$page); ?>
			</div>
			
			<?php $this->load->view('layout/partial/footer'); ?>
			
		</div>
		
		<?php $this->load->view('layout/partial/bottom'); ?>
	</body>
</html>