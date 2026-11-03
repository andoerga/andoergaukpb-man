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
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i></a>
						<?php if($edit_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/edit/'.$data->id); ?>" role="button"><i class="fa fa-pencil" title="Edit"></i></a>
						<?php } ?>
						<?php if($delete_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/delete/'.$data->id); ?>" role="button"><i class="fa fa-trash" title="Hapus"></i></a>
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
							<label for="inputName">Nama Kegiatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">PIC</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->user_name; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Tahun Anggaran</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->tahun_anggaran; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Tanggal Mulai</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->start_date ? date('d F Y', strtotime($data->start_date)) : ''; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Tanggal Berakhir</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->end_date ? date('d F Y', strtotime($data->end_date)) : ''; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Lokasi Kegiatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php echo $data->location; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Desain Kegiatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php if($data->doc_design){ ?>
								<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_design; ?>">Download</a>
							<?php }else{ ?>
								<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Surat Tugas</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php if($data->doc_surat_tugas){ ?>
								<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_surat_tugas; ?>">Download</a>
							<?php }else{ ?>
								<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Laporan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php if($data->doc_laporan){ ?>
								<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_laporan; ?>">Download</a>
							<?php }else{ ?>
								<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Biodata Peserta</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php if($data->doc_biodata){ ?>
								<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_biodata; ?>">Download</a>
							<?php }else{ ?>
								<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label for="inputName">Hasil Kegiatan</label>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php if($data->doc_hasil){ ?>
								<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $data->doc_hasil; ?>">Download</a>
							<?php }else{ ?>
								<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen
							<?php } ?>
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>