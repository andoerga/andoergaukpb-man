<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Buat Kegiatan Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module . '/add'); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('name') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Nama Kegiatan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Masukkan Nama">
							</div>
							<?php echo form_error('name'); ?>
						</div>
						<div class="form-group row <?php if(form_error('user_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputPIC">PIC (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="user_id" class="form-control" id="inputPIC">
									<?php foreach($user as $u){ ?>
										<option value="<?php echo $u->id; ?>"><?php echo $u->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('pj_id'); ?>
						</div>
						<div class="form-group row <?php if(form_error('tahun_anggaran') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputTahunAnggaran">Tahun Anggaran (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<?php $thisYear = date('Y'); ?>
								<select name="tahun_anggaran" class="form-control" id="inputTahunAnggaran">
									<?php for($i=$thisYear; $i>1970; $i--){ ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('tahun_anggaran'); ?>
						</div>
						<div class="form-group row <?php if(form_error('start_date') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputStartDate">Tanggal Mulai Kegiatan</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="start_date" class="datepicker form-control" id="inputStartDate" placeholder="Masukkan Tanggal Mulai Kegiatan">
							</div>
							<?php echo form_error('start_date'); ?>
						</div>
						<div class="form-group row <?php if(form_error('end_date') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputEndDate">Tanggal Mulai Kegiatan</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="end_date" class="datepicker form-control" id="inputEndDate" placeholder="Masukkan Tanggal Berakhir Kegiatan">
							</div>
							<?php echo form_error('end_date'); ?>
						</div>
						<div class="form-group row <?php if(form_error('location') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputLocation">Lokasi Kegiatan (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="location" class="form-control" id="inputLocation" placeholder="Masukkan Lokasi Kegiatan">
							</div>
							<?php echo form_error('location'); ?>
						</div>
						<div class="form-group row <?php if(form_error('status') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputStatus">Status</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label>
									<input type="radio" name="status" id="inputStatus" value="1" <?php echo isset($inputan['status']) && $inputan['status'] == '1' ? 'checked' : ''; ?>>
									Aktif
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="status" id="inputStatus" value="0" <?php echo isset($inputan['status']) && $inputan['status'] == '0' ? 'checked' : ''; ?>>
									Tidak Aktif
								</label>
							</div>
							<?php echo form_error('status'); ?>
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