<?php
if(!function_exists('create_text')){
function create_text($id, $name, $add_priv, $edit_priv, $delete_priv){
	$text = $name;
	if($delete_priv){
		$text .= '&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-primary btn-delete" href="' . site_url('module/delete/'.$id) . '" role="button" title="Hapus Data"><i class="fa fa-trash"></i></a>';
	}
	if($edit_priv){
		$text .= '&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-primary btn-edit" href="' . site_url('module/edit/'.$id) . '" role="button" title="Edit Data"><i class="fa fa-pencil"></i></a>';
	}
	$text .= '&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-primary btn-detail" href="' . site_url('module/detail/'.$id) . '" role="button" title="Lihat Data"><i class="fa fa-file"></i></a>';
	if($edit_priv){
		$text .= '&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-primary btn-crud" href="' . site_url('module/crud/'.$id) . '" role="button" title="Hak Akses"><i class="fa fa-ban"></i></a>';
	}
	return $text;
}
}

if(!function_exists('render_tree')){
function render_tree($data, $parent_id, $add_priv, $edit_priv, $delete_priv){
	$tree = array();
	foreach($data[$parent_id] as $d){
		$item = array(
			'text' => create_text($d->id, $d->name, $add_priv, $edit_priv, $delete_priv),
			'icon' => 'fa '. $d->icon,
			'href' => site_url('user/detail/'.$d->id),
			'state' => array(
				'expanded' => true,
			)
		);
		$hasChild = isset($data[$d->id]) && count($data[$d->id]) > 0 ? true : false;
		if($hasChild){
			$item['nodes'] = render_tree($data, $d->id, $add_priv, $edit_priv, $delete_priv);
		}
		$tree[] = $item;
	}
	return $tree;
}
}

?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header row">
					<div class="col-xs-6">
						<h3 class="box-title">Daftar Modul</h3>
					</div>
					<div class="col-xs-6 text-right">
						<?php if($add_priv){ ?>
							<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('module/add'); ?>" role="button"><i class="fa fa-plus" title="Tambah Data"></i></a>
						<?php } ?>
					</div>
				</div><!-- /.box-header -->
				<div class="box-tool">
				
				</div>
                <div class="box-body">
					<section id="tree-content" class="active">
						
					</section>
					<?php
					$tree = render_tree($data, 0, $add_priv, $edit_priv, $delete_priv);
					?>
					<script type="text/javascript">
					var tree = <?php echo json_encode($tree); ?>;
					</script>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>