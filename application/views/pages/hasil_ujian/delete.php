<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Hapus <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Mata Ujian</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $ujian->nama_ujian; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Nama Peserta</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->nama; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">NIP</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->nip; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Tingkat</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->tingkat_name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Sisa Waktu</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->time_left; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Waktu Mulai</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->created; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Waktu Selesai</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->updated; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Nilai</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->nilai; ?>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<form role="form" class="theForm" action="<?php echo site_url($module.'/delete/'.$data->id); ?>" method="post">
						<div class="form-group row">
							<div class="col-xs-12">
								<label>Apakah anda yakin akan menghapus data tesebut?</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary" name="form-submit" value="1">Ya</button>
						<a class="btn btn-primary" href="<?php echo site_url('bidang/detail/'.$data->id); ?>" role="button">Tidak</a>
					</form>
				</div>
				
			</div><!-- /.box -->
		</div>
	</div>
</section>