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
								<th class="title head searchable" name="nip">NIP</th>
								<th class="title head searchable" name="username">Email</th>
								<th class="title head searchable" name="instansi_id">Instansi</th>
								<th class="title head searchable" name="kelompok_instansi">Provinsi</th>
								<?php /*
								<th class="title head searchable" name="zona">Zona</th>
								*/ ?>
								
								<?php /*
								<th class="title head searchable" name="password">Password</th>
								*/ ?>
								<th class="title head searchable" name="tingkat_name">Jenis</th>
								<th class="title head searchable" name="sk">SK Terakhir</th>
								<th class="title head searchable" name="surat_usulan">Surat Usulan</th>
								<th class="title head searchable" name="status">Status</th>
								<th class="title head searchable" name="verifikator">Verifikator</th>
								<td class="head action"></td>
							</tr>
						</thead>
						<tbody>
							<?php if(count($data) > 0){ ?>
							<?php foreach($data as $d){ ?>
							<tr data-id="<?php echo $d->id; ?>">
								<td><?php echo $d->id; ?></td>
								<td><?php echo $d->nama; ?></td>
								<td><?php echo $d->nip; ?></td>
								<td><?php echo $d->username; ?></td>
								<td><?php echo $d->instansi_name; ?></td>
								<td><?php echo $d->kelompok_instansi; ?></td>
								<?php /*
								<td><?php echo $d->zona; ?></td>
								*/ ?>
								
								<?php /*
								<td><?php echo pass_peserta_decode($d->password); ?></td>
								*/ ?>
								<td><?php echo $d->tingkat_name; ?></td>
								<td><?php echo $d->doc_sk_terakhir ? '<a class="label label-success" href="'.$d->doc_sk_terakhir.'" target="_blank">Sudah</a>' : '<span class="label label-danger">Belum</span>'; ?></td>
								<td><?php echo $d->doc_pengantar ? '<a class="label label-success" href="'.$d->doc_pengantar.'" target="_blank">Sudah</a>' : '<button class="label label-danger">Belum</span>'; ?></td>
								<td class="activate">
									<?php if($d->status_approval == 'approved'){ ?>
									<span class="label label-success">Diterima</span>
									<?php }else if($d->status_approval == 'rejected'){ ?>
									<span class="label label-danger">Ditolak</span>
									<?php }else{ ?>
									<span class="label label-warning">Belum diperiksa</span>
									<?php } ?>
								</td>
								<td><?php echo $d->nama_verifikator; ?></td>
								<td class="action">
									<a class="btn btn-primary btn-detail" href="<?php echo site_url($module.'/detail/'.$d->id); ?>" role="button" title="Lihat Data"><i class="fa fa-file"></i></a>
									<?php if($edit_priv){ ?>
									<a class="btn btn-primary btn-edit" href="<?php echo site_url($module.'/edit/'.$d->id); ?>" role="button" title="Edit Data"><i class="fa fa-pencil-square-o"></i></a>
									<a class="btn btn-primary btn-edit-password" href="<?php echo site_url($module.'/edit_password/'.$d->id); ?>" role="button" title="Ganti Password"><i class="fa fa-key"></i></a>
									<?php } ?>
									<?php if($delete_priv){ ?>
									<a class="btn btn-primary btn-delete" href="<?php echo site_url($module.'/delete/'.$d->id); ?>" role="button" title="Hapus Data"><i class="fa fa-trash"></i></a>
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