<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Ganti Password <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url($module.	'/edit_password/'.$data->id); ?>" method="post">
					<div class="box-body">
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
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="form-submit" value="1">Submit</button>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>