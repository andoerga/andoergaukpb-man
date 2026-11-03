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
						<?php if($add_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module.'/add'); ?>" role="button"><i class="fa fa-plus" title="Tambah Data"></i></a>
						<?php } ?>
					</div>
				</div><!-- /.box-header -->
				<div class="box-tool">
				
				</div>
                <div class="box-body">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="title head" name="id">Id</th>
								<th class="title head" name="urutan">Urutan</th>
								<th class="title head" name="nama_ujian">Nama Ujian</th>
								<th class="title head" name="status_inpassing">Jenjang</th>
								<td class="title head"></td>
							</tr>
						</thead>
						<tbody>
							<?php if(count($data) > 0){ ?>
							<?php foreach($data as $d){ ?>
							<tr>
								<td><?php echo $d->id; ?></td>
								<td><?php echo $d->urutan; ?></td>
								<td><?php echo $d->nama_ujian; ?></td>
								<td><?php echo $d->tingkat_name; ?></td>
								<td>
									<?php if($delete_priv){ ?>
									<a class="btn btn-primary btn-delete" href="<?php echo site_url($module.'/delete/'.$d->id); ?>" role="button" title="Hapus Data"><i class="fa fa-trash"></i></a>
									<?php } ?>
									<?php if($edit_priv){ ?>
									<a class="btn btn-primary btn-edit" href="<?php echo site_url($module.'/edit/'.$d->id); ?>" role="button" title="Edit Data"><i class="fa fa-pencil"></i></a>
									<?php } ?>
									<a class="btn btn-primary btn-detail" href="<?php echo site_url($module.'/detail/'.$d->id); ?>" role="button" title="Lihat Data"><i class="fa fa-file"></i></a>
								</td>
							</tr>
							<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>