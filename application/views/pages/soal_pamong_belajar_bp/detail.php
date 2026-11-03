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
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module . '/index/' . $data->ujian_id); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<?php if($edit_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-edit" href="<?php echo site_url($module . '/edit/'.$data->id); ?>" role="button"><i class="fa fa-pencil-square-o" title="Edit"></i></a>
						<?php } ?>
						<?php if($delete_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-delete" href="<?php echo site_url($module . '/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Hapus"></i></a>
						<?php } ?>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12 col-sm-8">
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputName">Id</label>
								</div>
								<div class="col-xs-12 col-sm-8">
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
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle" class="<?php echo $data->kunci == '1' ? 'text-danger' : ''; ?>">Pilihan 1</label>
								</div>
								<div class="col-xs-12 col-sm-8 <?php echo $data->kunci == '1' ? 'text-danger' : ''; ?>">
									<?php echo $data->pil_1; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle" class="<?php echo $data->kunci == '2' ? 'text-danger' : ''; ?>">Pilihan 2</label>
								</div>
								<div class="col-xs-12 col-sm-8 <?php echo $data->kunci == '2' ? 'text-danger' : ''; ?>">
									<?php echo $data->pil_2; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle" class="<?php echo $data->kunci == '3' ? 'text-danger' : ''; ?>">Pilihan 3</label>
								</div>
								<div class="col-xs-12 col-sm-8 <?php echo $data->kunci == '3' ? 'text-danger' : ''; ?>">
									<?php echo $data->pil_3; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle" class="<?php echo $data->kunci == '4' ? 'text-danger' : ''; ?>">Pilihan 4</label>
								</div>
								<div class="col-xs-12 col-sm-8 <?php echo $data->kunci == '4' ? 'text-danger' : ''; ?>">
									<?php echo $data->pil_4; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle" class="<?php echo $data->kunci == '5' ? 'text-danger' : ''; ?>">Pilihan 5</label>
								</div>
								<div class="col-xs-12 col-sm-8 <?php echo $data->kunci == '5' ? 'text-danger' : ''; ?>">
									<?php echo $data->pil_5; ?>
								</div>
							</div>
							
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>