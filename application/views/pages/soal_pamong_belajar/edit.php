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
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module . '/index/' . $data->ujian_id); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module . '/edit/'.$data->id); ?>" method="post" enctype="multipart/form-data">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('ujian_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputUjianId">Mata Ujian (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="ujian_id" class="form-control" id="inputUjianId">
									<?php foreach($mata_ujian as $m){ ?>
									<option value="<?php echo $m->id; ?>" <?php echo $data->ujian_id == $m->id ? 'selected' : ''; ?>><?php echo $m->nama_ujian; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('ujian_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('jenis') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputJenis">Jenis Soal (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="jenis" class="form-control" id="inputJenis">
									<option value="pg" <?php echo $data->jenis == 'pg' ? 'selected' : ''; ?>>Pilihan Ganda</option>
									<option value="isian" <?php echo $data->jenis == 'isian' ? 'selected' : ''; ?>>Essai</option>
								</select>
							</div>
							<?php echo form_error('jenis'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('tipe_soal') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputTitle">Tipe Soal (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="number" name="tipe_soal" class="form-control" id="inputTitle" placeholder="Masukkan Tipe Soal" value="<?php echo $data->tipe_soal; ?>">
							</div>
							<?php echo form_error('tipe_soal'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('soal') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Soal (*)</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="soal" class="form-control ckeditor"><?php echo $data->soal; ?></textarea>
							</div>
							<?php echo form_error('soal'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('pil_1') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Pilihan 1</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="pil_1" class="form-control ckeditor"><?php echo $data->pil_1; ?></textarea>
							</div>
							<?php echo form_error('pil_1;'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('pil_2') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Pilihan 2</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="pil_2" class="form-control ckeditor"><?php echo $data->pil_2; ?></textarea>
							</div>
							<?php echo form_error('pil_2;'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('pil_3') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Pilihan 3</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="pil_3" class="form-control ckeditor"><?php echo $data->pil_3; ?></textarea>
							</div>
							<?php echo form_error('pil_3;'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('pil_4') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Pilihan 4</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="pil_4" class="form-control ckeditor"><?php echo $data->pil_4; ?></textarea>
							</div>
							<?php echo form_error('pil_4'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('pil_5') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Pilihan 5</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="pil_5" class="form-control ckeditor"><?php echo $data->pil_5; ?></textarea>
							</div>
							<?php echo form_error('pil_5'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('kunci') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputJenis">Kunci Jawaban (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="kunci" class="form-control" id="inputJenis">
									<option value="1" <?php echo $data->kunci == '1' ? 'selected' : ''; ?>>Pilihan 1</option>
									<option value="2" <?php echo $data->kunci == '2' ? 'selected' : ''; ?>>Pilihan 2</option>
									<option value="3" <?php echo $data->kunci == '3' ? 'selected' : ''; ?>>Pilihan 3</option>
									<option value="4" <?php echo $data->kunci == '4' ? 'selected' : ''; ?>>Pilihan 4</option>
									<option value="5" <?php echo $data->kunci == '5' ? 'selected' : ''; ?>>Pilihan 5</option>
								</select>
							</div>
							<?php echo form_error('kunci'); ?>
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