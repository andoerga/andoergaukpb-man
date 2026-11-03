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
						<h3 class="box-title">Buat <?php echo $module_object->name; ?> Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module . '/add'); ?>" method="post" enctype="multipart/form-data">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('urutan') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputTitle">Urutan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="number" name="urutan" class="form-control" id="inputUrutan" placeholder="Masukkan Urutan"></input>
							</div>
							<?php echo form_error('urutan'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('question') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputTitle">Pertanyaan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<textarea type="text" name="question" class="form-control" id="inputQuestion" placeholder="Masukkan Pertanyaan"></textarea>
							</div>
							<?php echo form_error('question'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('answer') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-md-4">
								<label for="inputTags">Jawaban(*)</label>
							</div>
							<div class="col-xs-12  col-md-8">
								<textarea name="answer" class="form-control" id="editorNaskah"></textarea>
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