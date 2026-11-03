<script>
var special_user = <?php echo $special_user ? 'true' : 'false'; ?>;
var status_berita = '<?php echo $data->status; ?>';
</script>
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
						<a class="btn btn-sm btn-rounded btn-primary btn-edit" href="<?php echo site_url($module . '/edit/'.$data->id); ?>" role="button"><i class="fa fa-pencil" title="Edit"></i></a>
						<?php } ?>
						<?php if($delete_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-delete" href="<?php echo site_url($module . '/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Hapus"></i></a>
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
							<label for="inputTitle">Judul Berita</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->title; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Tanggal Diupload</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->created ? date('d F Y', strtotime($data->created)) : ''; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Tanggal Diupdate</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->updated ? date('d F Y', strtotime($data->updated)) : ''; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Status</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->status; ?>
						</div>
					</div>
					<hr />
					<?php if($special_user || $data->status == 'belum diperiksa'){ ?>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Upload File</label>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
							
							<form id="upload" method="post" action="<?php echo site_url($module . '/upload_process/desain/'.$data->id); ?>" enctype="multipart/form-data">
							<div id="drop">
							Drop Here

							<a>Browse</a>
							<input type="file" name="upl" multiple />
							</div>

							</form>
						</div>
					</div>
					<hr />
					<?php } ?>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Daftar File</label>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<span>Nama File</span>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4">
							<span>Keterangan</span>
						</div>
						<?php if($special_user) { ?>
						<div class="col-xs-4 col-sm-2 col-md-2">
							<span>Status</span>
						</div>
						<?php } ?>
						<div class="col-xs-4 col-sm-2 col-md-2">
							
						</div>
					</div>
					<div id="files">
						<?php foreach($data_component as $component) { ?>
						<div class="form-group row file" data-id="<?php echo $component->id; ?>">
							<div class="col-xs-4 col-sm-4 col-md-4">
								<span data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/title'); ?>" data-field-name="title" data-id="<?php echo $component->id; ?>" data-type="text" class=""><?php echo $component->title; ?></span>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4">
								<span data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/description'); ?>" data-field-name="description" data-id="<?php echo $component->id; ?>" data-type="textarea" class="editable description"><?php echo $component->description ? $component->description : "Keterangan"; ?></span>
							</div>
							<?php if($special_user) { ?>
							<div class="col-xs-4 col-sm-2 col-md-2">
								<?php if($component->status == 'published'){ ?>
									<button class="btn btn-success btn-xs unpublish" title="Non Aktifkan" data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/status'); ?>">Aktif</button>
								<?php }else{ ?>
									<button class="btn btn-danger btn-xs publish" title="Aktifkan" data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/status'); ?>">Tidak Aktif</button>
								<?php } ?>
							</div>
							<?php } ?>
							<div class="col-xs-4 col-sm-2 col-md-2">
								<a class="btn btn-xs btn-rounded btn-primary" role="button" href="<?php echo $component->source; ?>" target="_blank"><i class="fa fa-download" title="Unduh File"></i></a>
								<?php if($special_user || $data->status == 'belum diperiksa'){ ?>
								<button class="btn btn-xs btn-rounded btn-primary btn-remove-file" data-id="<?php echo $component->id; ?>" role="button" data-href="<?php echo site_url($module . '/remove_component/' . $component->id); ?>"><i class="fa fa-close" title="Hapus File"></i></button>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
					
					<?php /*
					<?php $n = 0; ?>
					<?php if(count($data_component) > 0){ ?>
						<div id="files">
						<?php foreach($data_component as $component) { ?>
						<div class="form-group row file">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">File <?php echo ($n+1); ?></label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<span class="upload_status upload_file">
									<?php if($component->source){ ?>
										<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $component->source; ?>" target="_blank">Download</a>
										<br />
									<?php }else{ ?>
										<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
										<br />
									<?php } ?>
								</span>
								<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/exist/'.$data->id.'/'.$component->id); ?>" data-sequence="<?php echo $n; ?>" data-type="design" data-title="Upload File">Upload</button>
							</div>
						</div>
						<?php $n++; ?>
						<?php } ?>
						</div>
					<?php }else{ ?>
						<div id="files">
						<h3 class="title">Belum Ada File</h3>
						</div>
					<?php } ?>
					
					<hr />
					<button class="btn btn-primary btn-add-file" data-source="<?php echo site_url($module . '/upload_process/new/'.$data->id); ?>">Tambah File</button>
					*/ ?>
					<?php /*
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Desain Kegiatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status design">
								<?php if($data->doc_design){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_design; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/design/'.$data->id); ?>" data-type="design" data-title="Upload Desain Kegiatan">Upload</button>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Surat Tugas</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status surat_tugas">
								<?php if($data->doc_surat_tugas){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_surat_tugas; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/surat_tugas/'.$data->id); ?>" data-type="surat_tugas" data-title="Upload Surat Tugas">Upload</button>
							
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Laporan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status laporan">
								<?php if($data->doc_laporan){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_laporan; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/laporan/'.$data->id); ?>" data-type="laporan" data-title="Upload Laporan Kegiatan">Upload</button>
							
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Biodata Peserta</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status biodata">
								<?php if($data->doc_biodata){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_biodata; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/biodata/'.$data->id); ?>" data-type="biodata" data-title="Upload Biodata Peserta">Upload</button>
							
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Hasil Kegiatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status hasil">
								<?php if($data->doc_hasil){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_hasil; ?>" target="_blank">Download</a>
									<br />
								<?php }else{ ?>
									<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
									<br />
								<?php } ?>
							</span>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/hasil/'.$data->id); ?>" data-type="hasil" data-title="Upload Hasil Kegiatan">Upload</button>
						</div>
					</div>
					*/ ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
<?php /* Upload Desain */ ?>
<?php /*
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
*/ ?>