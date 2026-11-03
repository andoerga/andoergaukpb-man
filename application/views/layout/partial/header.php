			<header class="main-header">
				<a href="<?php echo base_url(); ?>" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b class="fa fa-pencil"></b></span>
					<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b class="fa fa-pencil"></b> <?php echo $this->config->item('APP_NAME'); ?></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li>
								<a href="<?php echo site_url('logout'); ?>">	
								<span class="">Sign Out</span>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<div class="sidebar" id="scrollspy">
					<ul class="sidebar-menu">
						<li class="<?php echo $module == 'home' ? 'active' : ''; ?>"><a href="#"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
						<?php $this->load->view('layout/partial/mainmenu', array('module' => $module)); ?>
					</ul>
				</div>
			</aside>