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
						<h3 class="box-title">Buat <?php echo $module_object->name; ?> Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module.'/add'); ?>" method="post">
					<div class="box-body">
						<div class="form-group row <?php if(form_error('nama') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputNama">Nama Pengguna (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="nama" class="form-control" id="inputNama" placeholder="Masukkan Nama" value="<?php echo isset($inputan['nama']) ? $inputan['nama'] : ''; ?>">
							</div>
							<?php echo form_error('nama'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('nip') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputEmail">NIP (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="nip" class="form-control" id="inputNip" placeholder="Masukkan NIP" value="<?php echo isset($inputan['nip']) ? $inputan['nip'] : ''; ?>">
							</div>
							<?php echo form_error('nip'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('username') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputUsername">Username (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Masukkan Username" value="<?php echo isset($inputan['username']) ? $inputan['username'] : ''; ?>">
							</div>
							<?php echo form_error('username'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('password') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputPassword">Password (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Masukkan Password" value="<?php echo isset($inputan['password']) ? $inputan['password'] : ''; ?>">
							</div>
							<?php echo form_error('password'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('retype-password') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputRetypePassword">Ulangi Password (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="password" name="retype-password" class="form-control" id="inputRetypePassword" placeholder="Masukkan Password Kembali" value="<?php echo isset($inputan['retype-password']) ? $inputan['retype-password'] : ''; ?>">
							</div>
							<?php echo form_error('retype-password'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('handphone') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputNohp">Nomor Handphone (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="handphone" class="form-control" id="inputNohp" placeholder="Masukkan Nomor Handphone" value="<?php echo isset($inputan['handphone']) ? $inputan['handphone'] : ''; ?>">
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
										<option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
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
								<input type="text" name="tmt_golongan" class="datepicker form-control" id="inputTmtgolongan" placeholder="Masukkan TMT Golongan terakhir" value="<?php echo isset($inputan['tmt_golongan']) ? $inputan['tmt_golongan'] : ''; ?>">
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
									
									<?php echo render_tree($instansi, 0, 0, 0); ?>
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
										<option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('tingkat_id'); ?>
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