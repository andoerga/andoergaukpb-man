<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Edit Pengaturan</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('PendaftaranBuka') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Waktu Buka Pendaftaran (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="PendaftaranBuka" class="form-control" id="inputName" placeholder="Waktu Buka Pendaftaran" value="<?php echo $data->Pendaftaran->Buka; ?>">
							</div>
							<?php echo form_error('PendaftaranBuka'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('PendaftaranTutup') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Waktu Tutup Pendaftaran (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="PendaftaranTutup" class="form-control" id="inputName" placeholder="Waktu Tutup Pendaftaran" value="<?php echo $data->Pendaftaran->Tutup; ?>">
							</div>
							<?php echo form_error('PendaftaranTutup'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('UjianMulai') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Waktu Mulai Ujian (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="UjianMulai" class="form-control" id="inputName" placeholder="Waktu Mulai Ujian" value="<?php echo $data->Ujian->Mulai; ?>">
							</div>
							<?php echo form_error('UjianMulai'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('UjianSelesai') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Waktu Selesai Ujian (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="UjianSelesai" class="form-control" id="inputName" placeholder="Waktu Selesai Ujian" value="<?php echo $data->Ujian->Selesai; ?>">
							</div>
							<?php echo form_error('UjianSelesai'); ?>
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