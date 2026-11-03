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
							<label for="inputName">Id</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->id; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Nama Mata Ujian</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->nama_ujian; ?>
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
							<label for="inputName">Jumlah Soal</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->jumlah_soal; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Waktu</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->waktu/60; ?> Menit
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Jumlah Tipe Soal</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->tipe_soal; ?> Tipe
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Urutan Mata Ujian</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->urutan; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Jumlah Pilihan Jawaban</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->jumlah_pil; ?> Pilihan
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Jenis Soal</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php 
							switch($data->jenis_soal){
								case 'pg' : echo 'Pilihan Ganda'; Break;
								case 'isian' : echo 'Essai'; Break;
							}
							?>
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
						<a class="btn btn-primary" href="<?php echo site_url($module.'/detail/'.$data->id); ?>" role="button">Tidak</a>
					</form>
				</div>
			</div><!-- /.box -->
		</div>
	</div>
</section>