<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Hapus Modul</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('module'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
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
							<label for="inputName">Kelompok Modul</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $parent ? $parent->name : '-'; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Nama Modul</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Initial</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->initial; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Icon</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<i class="fa <?php echo $data->icon; ?>"></i>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Urutan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->ordered_number; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Status</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->active ? 'Aktif' : 'Tidak Aktif'; ?>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<form role="form" class="theForm" action="<?php echo site_url('module/delete/'.$data->id); ?>" method="post">
						<div class="form-group row">
							<div class="col-xs-12">
								<label>Apakah anda yakin akan menghapus data tesebut?</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary" name="form-submit" value="1">Ya</button>
						<a class="btn btn-primary" href="<?php echo site_url('module/detail/'.$data->id); ?>" role="button">Tidak</a>
					</form>
				</div>
			</div><!-- /.box -->
		</div>
	</div>
</section>