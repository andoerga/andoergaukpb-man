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
								<th class="title head searchable" name="name">Nama</th>
								<th class="title head searchable" name="instansi_id">Instansi</th>
								<th class="title head searchable" name="tingkat_name">Jenis</th>
								<th class="title head searchable" name="tingkat_name">Nilai Komputer</th>
								<th class="title head searchable" name="tingkat_name">Penulisan Ilmiah</th>
								<td class="head action"></td>
							</tr>
						</thead>
						<tbody>
							<?php if(count($data) > 0){ ?>
							<?php foreach($data as $d){ ?>
							<tr>
								<td><?php echo $d->id; ?></td>
								<td><?php echo $d->nama; ?></td>
								<td><?php echo $d->instansi_name; ?></td>
								<td><?php echo $d->tingkat_name; ?></td>
								<td>
									<?php if($d->doc_tik){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $d->doc_tik; ?>" target="_blank"><i class="fa fa-download"></i></a>
									<?php }else{ ?>
									<i class="fa fa-close"></i>
									<?php } ?>
								</td>
								<td>
									<?php if($d->doc_pi){ ?>
									<i class="fa fa-check"></i>&nbsp;<a href="<?php echo $d->doc_pi; ?>" target="_blank"><i class="fa fa-download"></i></a>
									<?php }else{ ?>
									<i class="fa fa-close"></i>
									<?php } ?>
								</td>
								<td class="action">
									<a class="btn btn-primary btn-detail" href="<?php echo site_url($module.'/detail/'.$d->id); ?>" role="button" title="Lihat Data"><i class="fa fa-file"></i></a>
									<?php if($edit_priv){ ?>
									<a class="btn btn-primary btn-edit" href="<?php echo site_url($module.'/upload/'.$d->id); ?>" role="button" title="Unggah Berkas"><i class="fa fa-upload"></i></a>
									<?php } ?>
									
									
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