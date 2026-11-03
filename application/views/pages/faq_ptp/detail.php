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
									<label for="inputName">Urutan</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->urutan; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputTitle">Pertanyaan</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->question; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-12 col-sm-4">
									<label for="inputName">Jawaban</label>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?php echo $data->answer; ?>
								</div>
							</div>
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>