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
				<form role="form" class="theForm" action="<?php echo site_url($module.'/add/'); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('nama_ujian') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Nama Mata Ujian (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="nama_ujian" class="form-control" id="inputName" placeholder="Masukkan Nama Mata Ujian" value="<?php echo isset($data->nama_ujian) ? $data->nama_ujian : ''; ?>">
							</div>
							<?php echo form_error('nama_ujian'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('tipe_registrasi_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Bidang Minat (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select class="form-control" name="tipe_registrasi_id">
									<?php foreach($tipe_registrasi as $j){ ?>
									<option value="<?php echo $j->id; ?>" <?php echo isset($data->tipe_registrasi_id) && $data->tipe_registrasi_id == $j->id ? 'selected' : ''; ?>><?php echo $j->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('tipe_registrasi_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('status_inpassing_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Jenjang (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select class="form-control" name="status_inpassing_id">
									<?php foreach($jenjang_jabfung as $j){ ?>
									<option value="<?php echo $j->id; ?>" <?php echo isset($data->status_inpassing) && $data->status_inpassing_id == $j->id ? 'selected' : ''; ?>><?php echo $j->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('status_inpassing_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('jumlah_soal') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Jumlah Soal (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="number" name="jumlah_soal" class="form-control" id="inputName" placeholder="Masukkan Total Jumlah Soal" value="<?php echo isset($data->jumlah_soal) ? $data->jumlah_soal : ''; ?>">
							</div>
							<?php echo form_error('jumlah_soal'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('waktu') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Waktu (Dalam Menit) (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="number" name="waktu" class="form-control" id="inputName" placeholder="Masukkan Waktu (Satuan Menit)" value="<?php echo isset($data->waktu) ? $data->waktu : ''; ?>">
							</div>
							<?php echo form_error('waktu'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('tipe_soal') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Jumlah Tipe Soal (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="number" name="tipe_soal" class="form-control" id="inputName" placeholder="Masukkan Jumlah Tipe Soal" value="<?php echo isset($data->tipe_soal) ? $data->tipe_soal : ''; ?>">
							</div>
							<?php echo form_error('tipe_soal'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('jenis_soal') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Jenis Soal (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select class="form-control" name="jenis_soal">
									<option value="pg" <?php echo isset($data->jenis_soal) && $data->jenis_soal == 'pg' ? 'selected' : ''; ?>>Pilihan Ganda</option>
									<option value="isian" <?php echo isset($data->jenis_soal) && $data->jenis_soal == 'isian' ? 'selected' : ''; ?>>Essai</option>
								</select>
							</div>
							<?php echo form_error('jenis_soal'); ?>
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