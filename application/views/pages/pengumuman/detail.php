<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Detail <?php echo $module_object->name; ?> - <?php echo $data->title; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
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
									<label for="inputName">Jabatan Fungsional</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->tipe_jabfung; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle">Creator</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->name; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle">Judul Berita</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->title; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputName">Tanggal Dibuat</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->created ? date('d F Y', strtotime($data->created)) : ''; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputName">Isi Pengumuman</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->detail; ?>
								</div>
							</div>
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>