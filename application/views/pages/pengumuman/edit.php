<?php
if(!function_exists('render_tree')){
function render_tree($data, $parent_id, $level, $value){
	$tree = '';
	foreach($data[$parent_id] as $d){
		$tree .= '<option value="'. $d->id .'" ' . ($value == $d->id ? 'selected' : '') . '>';
		for($i=0;$i<$level;$i++){
			$tree .= ' -';
		}
		$tree .= ' ' . $d->name;
		$hasChild = isset($data[$d->id]) && count($data[$d->id]) > 0 ? true : false;
		if($hasChild){
			$tree .= render_tree($data, $d->id, $level+1, $value);
		}
	}
	return $tree;
}
}
?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Edit <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module . '/edit/'.$data->id); ?>" method="post" enctype="multipart/form-data">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('title') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputTitle">Judul Pengumuman (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="title" class="form-control" id="inputTitle" placeholder="Masukkan Judul Pengumuman" value="<?php echo $data->title; ?>">
							</div>
							<?php echo form_error('title'); ?>
						</div>
						
						
						<div class="form-group row <?php if(form_error('detail') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Isi Pengumuman</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="detail" class="form-control textarea" id="editor1"><?php echo $data->detail; ?></textarea>
							</div>
							<?php echo form_error('detail'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('status') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Publikasi</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="status" class="form-control" id="inputStatus">
									<option value="aktif" <?php echo $data->status == "aktif" ? "selected" : ""; ?>>Aktif</option>
									<option value="tidak aktif" <?php echo $data->status == "tidak aktif" ? "selected" : ""; ?>>Tidak Aktif</option>
								</select>
							</div>
							<?php echo form_error('status'); ?>
						</div>
						
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="form-submit" value="1">Submit</button>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>