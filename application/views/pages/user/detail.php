<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Detail Pengguna</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url('user'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<?php if($edit_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-edit" href="<?php echo site_url('user/edit/'.$data->id); ?>" role="button"><i class="fa fa-pencil-square-o" title="Edit"></i></a>
						<a class="btn btn-sm btn-rounded btn-primary btn-edit-password" href="<?php echo site_url('user/edit_password/'.$data->id); ?>" role="button"><i class="fa fa-key" title="Ganti Password"></i></a>
						<?php } ?>
						<?php if($delete_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-delete" href="<?php echo site_url('user/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Hapus"></i></a>
						<?php } ?>
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
							<label for="inputName">Nama Pengguna</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Instansi</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $instansi->name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Kelompok Pengguna</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $user_group->name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Username</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->username; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Email</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->email; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Status</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->status ? 'Aktif' : 'Tidak Aktif'; ?>
						</div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>