<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header row">
					<div class="col-xs-6">
						<h3 class="box-title">Daftar <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<?php /*
						<?php if($add_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module . '/add'); ?>" role="button"><i class="fa fa-plus" title="Tambah Data"></i></a>
						<?php } ?>
						*/ ?>
					</div>
				</div><!-- /.box-header -->
				<div class="box-tool">
				
				</div>
                <div class="box-body">
					<table id="table-kegiatan" class="table table-bordered table-hover serverside" data-module-url="<?php echo site_url($module); ?>" data-source-url="<?php echo site_url($module.'/ajax'); ?>" data-process-url="<?php echo site_url($module.'/process'); ?>" data-detail-url="<?php echo site_url($module.'/detail'); ?>" data-edit-url="<?php echo site_url($module.'/edit'); ?>" data-delete-url="<?php echo site_url($module.'/delete'); ?>" data-upload-url="<?php echo site_url($module.'/upload'); ?>" data-peserta-url="<?php echo site_url($module.'/peserta'); ?>" >

						<thead>
							<tr>
								<th class="title head" name="id">Id</th>
								<th class="title head searchable" name="nama">Nama</th>
								<th class="title head searchable" name="nip">NIP</th>
								<th class="title head searchable" name="jenjang">Jenjang</th>
								<th class="title head searchable" name="time_left">Sisa Waktu</th>
								<th class="title head searchable" name="created">Waktu Mulai</th>
								<th class="title head searchable" name="updated">Waktu Selesai</th>
								<th class="title head searchable" name="nilai">Nilai</th>
							</tr>
						</thead>
						<?php /*
						<tbody>
							<?php if(count($data) > 0){ ?>
							<?php foreach($data as $d){ ?>
							<tr>
								<td><?php echo $d->id; ?></td>
								<td><?php echo $d->name; ?></td>
								<td>
									<?php if($delete_priv){ ?>
									<a class="btn btn-primary" href="<?php echo site_url($module . '/delete/'.$d->id); ?>" role="button" title="Hapus Data"><i class="fa fa-trash"></i></a>
									<?php } ?>
									<?php if($edit_priv){ ?>
									<a class="btn btn-primary" href="<?php echo site_url($module . '/edit/'.$d->id); ?>" role="button" title="Edit Data"><i class="fa fa-pencil"></i></a>
									<?php } ?>
									<a class="btn btn-primary" href="<?php echo site_url($module . '/detail/'.$d->id); ?>" role="button" title="Lihat Data"><i class="fa fa-file"></i></a>
								</td>
							</tr>
							<?php } ?>
							<?php } ?>
						</tbody>
						*/ ?>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>