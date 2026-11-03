<!-- Main content -->
<section class="content crud">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Hak Akses Modul</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('module'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('module/edit/'.$data->id); ?>" role="button"><i class="fa fa-pencil" title="Edit"></i></a>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('module/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Hapus"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url('module/crud/'.$data->id); ?>" method="post">
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
					</div><!-- /.box-body -->
					<div class="box-body with-border">
						<div class="form-group title row">
							<div class="col-xs-3 col-sm-6">
								<label>Kelompok Pengguna</label>
							</div>
							<div class="col-xs-3 col-sm-2">
								<label>Add</label>
							</div>
							<div class="col-xs-3 col-sm-2">
								<label>Edit</label>
							</div>
							<div class="col-xs-3 col-sm-2">
								<label>Delete</label>
							</div>
						</div>
						<?php foreach($user_group as $u){ ?>
							<div class="form-group row list <?php echo isset($data_crud[$u->id]) ? 'active' : 'unactive'; ?>">
								<div class="col-xs-3 col-sm-6">
									<label class="list-title"><?php echo $u->name; ?></label>
									<input class="active-flag" type="hidden" name="inputActive[<?php echo $u->id;?>]" value="<?php echo isset($data_crud[$u->id]) ? 'active' : 'unactive'; ?>" />
								</div>
								<div class="col-xs-3 col-sm-2">
									<label>
										<input type="checkbox" name="inputAdd[<?php echo $u->id; ?>]" id="inputAdd[<?php echo $u->id; ?>]" value="1" <?php if(isset($data_crud[$u->id]) && $data_crud[$u->id]->add_priv) echo 'checked'; ?>>
										<label for="inputAdd[<?php echo $u->id; ?>]">Add</label>
									</label>
								</div>
								<div class="col-xs-3 col-sm-2">
									<label>
										<input type="checkbox" name="inputEdit[<?php echo $u->id; ?>]" id="inputEdit[<?php echo $u->id; ?>]" value="1" <?php if(isset($data_crud[$u->id]) && $data_crud[$u->id]->edit_priv) echo 'checked'; ?>>
										<label for="inputEdit[<?php echo $u->id; ?>]">Edit</label>
									</label>
								</div>
								<div class="col-xs-3 col-sm-2">
									<label>
										<input type="checkbox" name="inputDelete[<?php echo $u->id; ?>]" id="inputDelete[<?php echo $u->id; ?>]" value="1" <?php if(isset($data_crud[$u->id]) && $data_crud[$u->id]->delete_priv) echo 'checked'; ?>>
										<label for="inputDelete[<?php echo $u->id; ?>]">Delete</label>
									</label>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="form-submit" value="1">Submit</button>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>