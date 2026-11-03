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
						<h3 class="box-title">Buat Modul Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('module'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url('module/add'); ?>" method="post">
					<div class="box-body">
						<div class="form-group row <?php if(form_error('parent_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputParentId">Kelompok Modul (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="parent_id" class="form-control" id="inputParentId">
									<option value="0">Top</option>
									<?php echo render_tree($parent, 0, 1); ?>
								</select>
							</div>
							<?php echo form_error('parent_id'); ?>
						</div>
						<div class="form-group row <?php if(form_error('name') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Nama Modul (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Masukkan Nama" value="<?php echo isset($inputan['name']) ? $inputan['name'] : ''; ?>">
							</div>
							<?php echo form_error('name'); ?>
						</div>
						<div class="form-group row <?php if(form_error('initial') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputInitial">Initial (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="initial" class="form-control" id="inputInitial" placeholder="Masukkan Initial" value="<?php echo isset($inputan['initial']) ? $inputan['initial'] : ''; ?>">
							</div>
							<?php echo form_error('initial'); ?>
						</div>
						<div class="form-group row <?php if(form_error('icon') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputIcon">Icon (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="icon" class="form-control" id="inputIcon" placeholder="Masukkan Icon" value="<?php echo isset($inputan['icon']) ? $inputan['icon'] : ''; ?>">
							</div>
							<?php echo form_error('icon'); ?>
						</div>
						<div class="form-group row <?php if(form_error('ordered_number') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputOrderedNumber">Urutan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="ordered_number" class="form-control" id="inputOrderedNumber" placeholder="Masukkan Urutan" value="<?php echo isset($inputan['ordered_number']) ? $inputan['ordered_number'] : ''; ?>">
							</div>
							<?php echo form_error('ordered_number'); ?>
						</div>
						<div class="form-group row <?php if(form_error('active') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputActive">Status</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label>
									<input type="radio" name="active" id="inputActive" value="1">
									Aktif
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="active" id="inputActive" value="0" checked>
									Tidak Aktif
								</label>
							</div>
							<?php echo form_error('active'); ?>
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