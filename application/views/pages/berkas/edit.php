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
						
						<div class="form-group row <?php if(form_error('golongan_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Golongan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="golongan_id" class="form-control" id="inputGolonganId">
									<?php foreach($golongan as $g){ ?>
										<option value="<?php echo $g->id; ?>" <?php $data->golongan_id == $g->id ? 'selected' : ''; ?>><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('golongan_id'); ?>
						</div>
					
						<div class="form-group row <?php if(form_error('instansi_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Instansi (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="instansi_id" class="form-control" id="inputInstansiId">
									<?php foreach($instansi as $g){ ?>
										<option value="<?php echo $g->id; ?>" <?php $data->instansi_id == $g->id ? 'selected' : ''; ?>><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('instansi_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('tingkat_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Jenis (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="tingkat_id" class="form-control" id="inputInstansiId">
									<?php foreach($jenis as $g){ ?>
										<option value="<?php echo $g->id; ?>" <?php $data->tingkat_id == $g->id ? 'selected' : ''; ?>><?php echo $g->name; ?></option>
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