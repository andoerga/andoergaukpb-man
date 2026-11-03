<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Detail <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i> Kembali</a>
						<?php if($edit_priv){ ?>
						<?php if($edit_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/process/'.$data->id); ?>" role="button"><i class="fa fa-refresh" title="Proses Nilai"></i> Proses Nilai</a>
						<?php } ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/reset_time/'.$data->id); ?>" role="button"><i class="fa fa-hourglass" title="Reset Waktu"></i> Reset Waktu</a>
						<?php } ?>
						
						<?php if($delete_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Reset Waktu"></i> Hapus</a>
						<?php } ?>
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
					<div class="form-group row">
						<div class="col-xs-12 table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>No.</th>
									<th>Pertanyaan</th>
									<th>Kompetensi</th>
									<th>Jawaban</th>
									<th>Jawaban Benar</th>
									<th>Status</th>
								</tr>
								<?php $n=1; ?>
								<?php $urutan_soal = json_decode($data->soal); ?>
								<?php $jawaban = json_decode($data->jawaban); ?>
								
								<?php foreach($urutan_soal as $ds){ ?>
								<?php 
								$pil = false;
								if($jawaban->$ds > 0 && $jawaban->$ds <=5){
									$pil = 'pil_'.$jawaban->$ds; 
								}
								$right = 'pil_'.$soal[$ds]->kunci; 
								?>
								<tr>
									<td><?php echo $n++; ?></td>
									<td><?php echo $soal[$ds]->soal; ?></td>
									<td><?php echo $soal[$ds]->kompetensi_name; ?></td>
									<td><?php echo $pil ? $soal[$ds]->$pil : ''; ?></td>
									<td><?php echo $soal[$ds]->$right; ?></td>
									<td><strong><?php echo $jawaban->$ds == $soal[$ds]->kunci ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-close text-danger"></i>'; ?></strong></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>