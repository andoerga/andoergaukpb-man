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
						
						<div class="form-group row <?php if(form_error('tipe_jabfung') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Jabatan Fungsional (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="tipe_jabfung" class="form-control" id="inputTipeJabfung">
									<option value="ptp" <?php echo $data->tipe_jabfung == 'ptp' ? 'selected' : ''; ?>>PTP</option>
									<option value="pamong_budaya" <?php echo $data->tipe_jabfung == 'pamong_budaya' ? 'selected' : ''; ?>>Pamong Budaya</option>
									<option value="pamong_belajar" <?php echo $data->tipe_jabfung == 'pamong_belajar' ? 'selected' : ''; ?>>Pamong Belajar</option>
									<option value="penilik" <?php echo $data->tipe_jabfung == 'penilik' ? 'selected' : ''; ?>>Penilik</option>
								</select>
							</div>
							<?php echo form_error('tipe_jabfung'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('urutan') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputUrutan">Urutan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="number" name="urutan" class="form-control" id="inputUrutan" placeholder="Masukkan Urutan" value="<?php echo $data->urutan; ?>">
							</div>
							<?php echo form_error('urutan'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('question') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputQuestion">Pertanyaan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<textarea name="question" class="form-control" id="inputQuestion" placeholder="Masukkan Pertanyaan"><?php echo $data->question; ?></textarea>
							</div>
							<?php echo form_error('question'); ?>
						</div>
						
						
						<div class="form-group row <?php if(form_error('answer') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputAnswer">Jawaban</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="answer" class="form-control" id="editorNaskah"><?php echo $data->answer; ?></textarea>
							</div>
							<?php echo form_error('answer'); ?>
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