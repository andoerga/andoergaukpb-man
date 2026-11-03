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
						<h3 class="box-title">Buat Pengguna Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url('user'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url('user/add'); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('instansi_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Instansi (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="instansi_id" class="form-control" id="inputInstansiId">
									<?php foreach($instansi as $g){ ?>
										<option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php echo form_error('instansi_id'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('user_group_id') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputserGroupId">Kelompok Pengguna (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="user_group_id" class="form-control" id="inputInstansiId">
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
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Masukkan Nama" value="<?php echo isset($inputan['name']) ? $inputan['name'] : ''; ?>">
							</div>
							<?php echo form_error('name'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('username') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputUsername">Username (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Masukkan Username" value="<?php echo isset($inputan['username']) ? $inputan['username'] : ''; ?>">
							</div>
							<?php echo form_error('username'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('password') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputPassword">Password (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Masukkan Password">
							</div>
							<?php echo form_error('password'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('retype-password') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputRetypePassword">Ulangi Password (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="password" name="retype-password" class="form-control" id="inputRetypePassword" placeholder="Masukkan Password Kembali">
							</div>
							<?php echo form_error('retype-password'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('email') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputEmail">Email (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Masukkan Email" value="<?php echo isset($inputan['email']) ? $inputan['email'] : ''; ?>">
							</div>
							<?php echo form_error('email'); ?>
						</div>
						
						<div class="form-group row <?php if(form_error('status') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputStatus">Status</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label>
									<input type="radio" name="status" id="inputStatus" value="1" <?php echo isset($inputan['status']) && $inputan['status'] == '1' ? 'checked' : ''; ?>>
									Aktif
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="status" id="inputStatus" value="0" <?php echo isset($inputan['status']) && $inputan['status'] == '0' ? 'checked' : ''; ?>>
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