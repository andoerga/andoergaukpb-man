<?php
if(!function_exists('render_tree')){
function render_tree($data, $parent_id, $level, $value){
	$tree = '';
	foreach($data[$parent_id] as $d){
		$tree .= '<option value="'. $d->id .'" ' . ($value == $d->id ? 'selected' : '') . '>';
		for($i=0;$i<$level;$i++){
			$tree .= ' -';
		}
		$tree .= ' ' . $d->name . '</option>';
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
						<a class="btn btn-sm btn-rounded btn-primary btn-edit-password" href="<?php echo site_url($module.'/edit_password/'.$data->id); ?>" role="button"><i class="fa fa-key" title="Ganti Password"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module.'/edit/'.$data->id); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('nama') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputNama">Nama Pengguna</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="nama" class="form-control" id="inputName" placeholder="Masukkan Nama" value="<?php echo $data->nama; ?>">
							</div>
							<?php echo form_error('nama'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('nip') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputEmail">NIP (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="nip" class="form-control" id="inputNip" placeholder="Masukkan NIP" value="<?php echo $data->nip; ?>">
							</div>
							<?php echo form_error('nip'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('username') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputUsername">Username (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Masukkan Username" value="<?php echo $data->username ?>">
							</div>
							<?php echo form_error('username'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('handphone') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputNohp">Nomor Handphone (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="handphone" class="form-control" id="inputNohp" placeholder="Masukkan Nomor Handphone" value="<?php echo $data->handphone; ?>">
							</div>
							<?php echo form_error('handphone'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('golongan_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Golongan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="golongan_id" class="form-control" id="inputGolonganId">
									<?php foreach($golongan as $g){ ?>
										<option value="<?php echo $g->id; ?>" <?php echo $data->golongan_id == $g->id ? 'selected' : ''; ?>><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('golongan_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('tmt_golongan') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputTmtgolongan">TMT Golongan Terakhir (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="tmt_golongan" class="datepicker form-control" id="inputTmtgolongan" placeholder="Masukkan TMT Golongan terakhir" value="<?php echo $data->tmt_golongan ? $data->tmt_golongan : ''; ?>">
							</div>
							<?php echo form_error('tmt_golongan'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('instansi_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Instansi (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<?php //var_dump($instansi[22]); ?>
								<select name="instansi_id" class="form-control select2" id="inputInstansiId">
									
									<?php echo render_tree($instansi, 0, 0, $data->instansi_id); ?>
									<?php /*
									<?php foreach($instansi as $g){ ?>
										<option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
									<?php } ?>
									*/ ?>
								</select>
							</div>
							<?php echo form_error('instansi_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('tingkat_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Jabatan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="tingkat_id" class="form-control" id="inputTingkatId">
									<?php foreach($jenis as $g){ ?>
										<option value="<?php echo $g->id; ?>" <?php echo $data->tingkat_id == $g->id ? 'selected' : ''; ?>><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('tingkat_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('status_approval') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputActive">Status</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label>
									<input type="radio" name="status_approval" id="inputActive" value="1" <?php if($data->status_approval == 'approved') echo 'checked';?>>
									Diterima
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="status_approval" id="inputActive" value="2" <?php if($data->status_approval == 'rejected') echo 'checked';?>>
									Ditolak
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="status_approval" id="inputActive" value="0" <?php if($data->status_approval == 'unset') echo 'checked';?>>
									Belum Diperiksa
								</label>
							</div>
							<?php echo form_error('status_approval'); ?>
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