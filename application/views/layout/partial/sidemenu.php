<?php
if(!function_exists('render_menu')){
function render_menu($modules, $crud, $parent){
	$output = '';
	if(isset($modules[$parent])){
		foreach($modules[$parent] as $m){
			if(isset($crud[$m->initial])){
				$has_child = isset($modules[$m->id]) ? true : false;
				$output .= '<li class="' . ($has_child ? 'treeview' : '') . '">';
				$output .= '<a href="' . site_url($m->initial) . '">';
				$output .= '<i class="fa ' . $m->icon . '"></i> <span>' . $m->name . '</span> ';
				if($has_child) {
					$output .= '<i class="fa fa-angle-left pull-right"></i>';
				}
				$output .= '</a>';
				if($has_child){
					$output .= '<ul class="treeview-menu">';
					$output .= render_menu($modules, $crud, $m->id);
					$output .= '</ul>';
				}
				$output .= '</li>';
			}
		}
	}
	return $output;
}
}
?>
	
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<?php /*
			<div class="user-panel">
				<div class="pull-left image">
					<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					  <p>Alexander Pierce</p>
					  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<!-- search form -->
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
			*/ ?>
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="">
					<a href="<?php echo site_url(); ?>">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<?php
				echo render_menu($modules, $crud, 0);
				?>
			</ul>
        </section>
        <!-- /.sidebar -->
	</aside>
