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
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<?php if($edit_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/nilai/'.$data->id); ?>" role="button"><i class="fa fa-pencil" title="Proses Nilai"></i></a>
						<?php } ?>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
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
							<label for="inputName">Jenjang</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->jenjang; ?>
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
									<th>Jawaban</th>
									<th>Skor</th>
								</tr>
								<?php $n=1; ?>
								<?php $urutan_soal = json_decode($data->soal); ?>
								<?php $jawaban = json_decode($data->jawaban); ?>
								<?php $score_detail = json_decode($data->score_detail); ?>
								
								<?php foreach($urutan_soal as $ds){ ?>
								<tr>
									<td><?php echo $n++; ?></td>
									<td><?php echo $soal[$ds]->soal; ?></td>
									<td><?php echo strip_tags($jawaban->$ds); ?></td>
									<td><?php echo $data->create_score ? $score_detail->$ds: ''; ?></td>
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