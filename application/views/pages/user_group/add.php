<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Buat Kelompok Pengguna Baru</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('user_group'); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" class="theForm" action="<?php echo site_url('user_group/add'); ?>" method="post">
					<div class="box-body">
						
						<div class="form-group row <?php if(form_error('name') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Nama Kelompok Pengguna (*)</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Masukkan Nama">
							</div>
							<?php echo form_error('name'); ?>
						</div>
						<div class="form-group row <?php if(form_error('description') != '') echo 'has-error'; ?>">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputDescription">Keterangan</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<textarea name="description" class="form-control" id="inputDescription" placeholder="Keterangan"></textarea>
							</div>
							<?php echo form_error('description'); ?>
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