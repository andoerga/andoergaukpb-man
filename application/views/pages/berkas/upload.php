<!-- Main content -->
<section class="content" id="files">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Detail <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						
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
							<label for="inputName">Nama Peserta</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->nama; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">NIP</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->nip; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Instansi</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->instansi_name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Golongan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->golongan_name; ?>
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
							<label for="inputName">Password</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo pass_peserta_decode($data->password); ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Jenis</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->tingkat_name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Penilaian Penguasaan Komputer</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status tik">
								<?php if($data->doc_tik){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_tik; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/tik/'.$data->id); ?>" data-type="tik" data-title="Upload Penilaian Pengetahuan Komputer">Upload</button>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Penulisan Ilmiah</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status pi">
								<?php if($data->doc_pi){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_pi; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/pi/'.$data->id); ?>" data-type="pi" data-title="Upload Penulisan Ilmiah">Upload</button>
							
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
<?php /* Upload Desain */ ?>
<div id="dialog" class="thedialog" title="Basic dialog">
	<form id="upload" method="post" action="<?php echo site_url($module . '/upload_process/desain/'.$data->id); ?>" enctype="multipart/form-data">
	<div id="drop">
	Drop Here

	<a>Browse</a>
	<input type="file" name="upl" multiple />
	</div>

	<ul>
	<!-- The file uploads will be shown here -->
	</ul>

	</form>
</div>