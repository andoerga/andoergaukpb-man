<?php
if(!function_exists('render_tree')){
function render_tree($data, $parent_id, $level, $value){
	$tree = '';
	foreach($data[$parent_id] as $d){
		$tree .= '<option value="'. $d->id .'" ' . ($value == $d->id ? 'selected' : '') . '>';
		for($i=0;$i<$level;$i++){
			$tree .= ' -';
		}
		$tree .= ' ' . $d->name;
		$hasChild = isset($data[$d->id]) && count($data[$d->id]) > 0 ? true : false;
		if($hasChild){
			$tree .= render_tree($data, $d->id, $level+1, $value);
		}
	}
	return $tree;
}
}
?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Edit Pengguna</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url('user'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<a class="btn btn-sm btn-rounded btn-primary btn-edit-password" href="<?php echo site_url('user/edit_password/'.$data->id); ?>" role="button"><i class="fa fa-key" title="Ganti Password"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url('user/edit/'.$data->id); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('user_group_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Kelompok Pengguna (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="user_group_id" class="form-control" id="inputUserGroupId">
									<?php foreach($user_group as $g){ ?>
										<option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('user_group_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('name') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Nama Pengguna</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Masukkan Nama" value="<?php echo $data->name; ?>">
							</div>
							<?php echo form_error('name'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('username') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputUsername">Username (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Masukkan Username" value="<?php echo $data->username; ?>">
							</div>
							<?php echo form_error('username'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('email') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputEmail">Email (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Masukkan Email" value="<?php echo $data->email; ?>">
							</div>
							<?php echo form_error('username'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('status') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputStatus">Status</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label>
									<input type="radio" name="status" id="inputStatus" value="1" <?php if($data->status) echo 'checked'; ?>>
									Aktif
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="status" id="inputStatus" value="0" <?php if(!$data->status) echo 'checked'; ?>>
									Tidak Aktif
								</label>
							</div>
							<?php echo form_error('status'); ?>
						</div>
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="form-submit" value="1">Submit</button>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>