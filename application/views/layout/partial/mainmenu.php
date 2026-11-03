<?php
if(!function_exists('render_menu')){
function render_menu($modules, $crud, $parent, $current_module){
	$output = '';
	if(isset($modules[$parent])){
		foreach($modules[$parent] as $m){
			if(isset($crud[$m->initial])){
				$has_child = isset($modules[$m->id]) ? true : false;
				$output .= '<li class="' . ($current_module==$m->initial ? 'active' : '') . ' ' . ($has_child ? 'treeview' : '') . '" >';
				$output .= '<a href="' . ($has_child ? '#' : site_url($m->initial)) . '">';
				$output .= '<i class="fa ' . $m->icon . '"></i> <span>' . $m->name .'</span> ';
				if($has_child) {
					$output .= '<i class="fa fa-angle-down pull-right"></i>';
				}
				$output .= '</a>';
				if($has_child){
					$output .= '<ul class="treeview-menu">';
					$output .= render_menu($modules, $crud, $m->id, $current_module);
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

<?php echo render_menu($modules, $crud, 0, $module); ?>
