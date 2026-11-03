<?php
if(!function_exists('render_tree')){
function render_tree($data, $parent_id, $level){
	$tree = '';
	foreach($data[$parent_id] as $d){
		$tree .= '<option value="'. $d->id .'">';
		for($i=0;$i<$level;$i++){
			$tree .= ' -';
		}
		$tree .= ' ' . $d->name;
		$hasChild = isset($data[$d->id]) && count($data[$d->id]) > 0 ? true : false;
		if($hasChild){
			$tree .= render_tree($data, $d->id, $level+1);
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
						<h3 class="box-title">Buat <?php echo $module_object->name; ?> Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module.'/add'); ?>" method="post">
					<div class="box-body">
						<div class="form-group row <?php if(form_error('parent_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputParentId">Kelompok <?php echo $module_object->name; ?> (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="parent_id" class="form-control select2" id="inputParentId">
									<option value="0">Top</option>
									<?php echo render_tree($parent, 0, 1); ?>
								</select>
							</div>
							<?php echo form_error('parent_id'); ?>
						</div>
						<div class="form-group row <?php if(form_error('name') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Nama <?php echo $module_object->name; ?> (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Masukkan Nama" value="<?php echo isset($inputan['name']) ? $inputan['name'] : ''; ?>">
							</div>
							<?php echo form_error('name'); ?>
						</div>
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