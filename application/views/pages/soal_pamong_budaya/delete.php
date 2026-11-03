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
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/index/' . $data->ujian_id); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
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
						<div class="col-xs-12 col-sm-4">
							<label for="inputName">Mata Ujian</label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<?php echo $mata_ujian[$data->ujian_id]->nama_ujian; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-4">
							<label for="inputTitle">Tipe Soal</label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<?php echo $data->tipe_soal; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-4">
							<label for="inputTitle">Jenis Soal</label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<?php echo $data->jenis == 'pg' ? 'Pilihan Ganda' : 'Essai'; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-4">
							<label for="inputTitle">Soal</label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<?php echo $data->soal; ?>
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
						<a class="btn btn-primary" href="<?php echo site_url($module . '/detail/'.$data->id); ?>" role="button">Tidak</a>
					</form>
				</div>
			</div><!-- /.box -->
		</div>
	</div>
</section>