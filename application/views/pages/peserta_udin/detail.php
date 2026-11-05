<!-- Main content -->
<section class="content">
	<div class="row">
		<div id="data-detail" class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Detail <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<a class="btn btn-sm btn-rounded btn-primary btn-detail" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<?php if($edit_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-edit" href="<?php echo site_url($module.'/edit/'.$data->id); ?>" role="button"><i class="fa fa-pencil-square-o" title="Edit"></i></a>
						<a class="btn btn-sm btn-rounded btn-primary btn-edit-password" href="<?php echo site_url($module.'/edit_password/'.$data->id); ?>" role="button"><i class="fa fa-key" title="Ganti Password"></i></a>
						<?php } ?>
						<?php if($delete_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-delete" href="<?php echo site_url($module.'/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Hapus"></i></a>
						<?php } ?>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Status</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php if($data->status_approval == 'approved'){ ?>
							<span class="label label-success">Diterima</span>
							<?php }else if($data->status_approval == 'rejected'){ ?>
							<span class="label label-danger">Ditolak</span>
							<?php }else{ ?>
							<span class="label label-warning">Belum diperiksa</span>
							<?php } ?>
						</div>
					</div>
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
							<label for="inputName">Username</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->username; ?>
						</div>
					</div>
					<?php /*
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Password</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo pass_peserta_decode($data->password); ?>
						</div>
					</div>
					*/ ?>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Nomor Handphone</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->handphone; ?>
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
							<label for="inputName">TMT Golongan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo !empty($data->tmt_golongan) ? date('d F Y', strtotime($data->tmt_golongan)) : '-'; ?>
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
							<label for="inputName">Jabatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->tingkat_name; ?>
						</div>
					</div>
					
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan SK Jabatan Terakhir : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status sk_terakhir">
								<?php if($data->doc_sk_terakhir){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_sk_terakhir; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/sk_terakhir/'.$data->id); ?>" data-type="sk_terakhir" title="Hapus Scan SK Jabatan terakhir"><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/sk_terakhir/'.$data->id); ?>" data-type="sk_terakhir" data-title="Upload Scan SK Jabatan terakhir">Upload</button>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan SK Kenaikan Pangkat/Golongan Terakhir : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status doc_sk_pengangkatan">
								<?php if($data->doc_sk_pengangkatan){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_sk_pengangkatan; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/doc_sk_pengangkatan/'.$data->id); ?>" data-type="doc_sk_pengangkatan" title="Hapus Scan SK Kenaikan Pangkat/Golongan Terakhir :"><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/doc_sk_pengangkatan/'.$data->id); ?>" data-type="doc_sk_pengangkatan" data-title="Scan SK Kenaikan Pangkat/Golongan Terakhir :">Upload</button>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan Pakta integritas yang ditandatangani di atas materai : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status doc_pakta">
								<?php if($data->doc_pakta){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_pakta; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/doc_pakta/'.$data->id); ?>" data-type="doc_pakta" title="Hapus Scan Pakta integritas"><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/doc_pakta/'.$data->id); ?>" data-type="doc_pakta" data-title="Upload Scan Pakta integritas">Upload</button>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan SK PAK terakhir : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status doc_sk_pengangkatan">
								<?php if($data->doc_pak){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_pak; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/doc_pak/'.$data->id); ?>" data-type="doc_pak" title="Hapus SK PAK terakhir "><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/doc_pak/'.$data->id); ?>" data-type="doc_pak" data-title="Scan SK PAK terakhir ">Upload</button>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan dokumen penilaian prestasi kerja paling kurang bernilai baik dalam 1 (satu) tahun terakhir : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status doc_sk_pengangkatan">
								<?php if($data->doc_skp){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_skp; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/doc_skp/'.$data->id); ?>" data-type="doc_skp" title="Hapus dokumen penilaian prestasi kerja paling kurang bernilai baik dalam 1 (satu) tahun terakhir "><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/doc_skp/'.$data->id); ?>" data-type="doc_skp" data-title="dokumen penilaian prestasi kerja paling kurang bernilai baik dalam 1 (satu) tahun terakhir ">Upload</button>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan Surat usulan dari Dinas Pendidikan untuk mengikuti UKKJ : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status pengantar">
								<?php if($data->doc_pengantar){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_pengantar; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/pengantar/'.$data->id); ?>" data-type="pengantar" title="Hapus Scan Surat Pengantar"><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/pengantar/'.$data->id); ?>" data-type="pengantar" data-title="Upload Surat Pengantar">Upload</button>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Scan Surat Penetapan dari Kemenpan RB : </label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<span class="upload_status pengantar">
								<?php if($data->doc_pengantar){ ?>
									<span class="label label-success">
									<i class="fa fa-check"></i> Dokumen tersedia
									</span>&nbsp;
									
									<a class="btn btn-xs btn-info" href="<?php echo $data->doc_kebutuhan; ?>" target="_blank" title="unduh dokumen"><span class="fa fa-download"></span></a>
									
									<button class="btn btn-danger btn-xs remove-document" data-action="<?php echo site_url($module.'/remove_document/doc_kebutuhan/'.$data->id); ?>" data-type="pengantar" title="Hapus Scan Surat Pengantar"><span class="fa fa-trash"></span></button>
									<br />
								<?php }else{ ?>
									<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span>
									<br />
								<?php } ?>
							</span>
							<?php if($edit_priv){ ?>
							<br /><button class="btn btn-primary btn-upload" data-action="<?php echo site_url($module . '/upload_process/doc_kebutuhan/'.$data->id); ?>" data-type="pengantar" data-title="Upload Surat Pengantar">Upload</button>
							<?php } ?>
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