<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header row">
					<div class="col-xs-6">
						<h3 class="box-title">Daftar Pengguna</h3>
					</div>
					<div class="col-xs-6 text-right">
						<?php if($add_priv){ ?>
							<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url('user/add'); ?>" role="button"><i class="fa fa-plus" title="Tambah Data"></i></a>
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
								<th class="title head searchable" name="user_group_id">Kelompok Pengguna</th>
								<th class="title head searchable" name="instansi_id">Instansi</th>
								<th class="title head searchable" name="username">Username</th>
								<th class="title head searchable" name="name">Nama</th>
								<th class="title head searchable" name="email">Email</th>
								<th class="title head searchable" name="status">Status</th>
								<td class="head action"></td>
							</tr>
						</thead>
						<tbody>
							<?php if(count($data) > 0){ ?>
							<?php foreach($data as $d){ ?>
							<tr>
								<td><?php echo $d->id; ?></td>
								<td><?php echo $user_group[$d->user_group_id]->name; ?></td>
								<td><?php echo $instansi[$d->instansi_id]->name; ?></td>
								<td><?php echo $d->username; ?></td>
								<td><?php echo $d->name; ?></td>
								<td><?php echo $d->email; ?></td>
								<td><?php echo $d->status ? 'Aktif' : 'Tidak Aktif'; ?></td>
								<td class="action">
									<a class="btn btn-primary btn-detail" href="<?php echo site_url('user/detail/'.$d->id); ?>" role="button" title="Lihat Data"><i class="fa fa-file"></i></a>
									<?php if($edit_priv){ ?>
									<a class="btn btn-primary btn-edit" href="<?php echo site_url('user/edit/'.$d->id); ?>" role="button" title="Edit Data"><i class="fa fa-pencil-square-o"></i></a>
									<a class="btn btn-primary btn-edit-password" href="<?php echo site_url('user/edit_password/'.$d->id); ?>" role="button" title="Ganti Password"><i class="fa fa-key"></i></a>
									<?php } ?>
									<?php if($delete_priv){ ?>
									<a class="btn btn-primary btn-delete" href="<?php echo site_url('user/delete/'.$d->id); ?>" role="button" title="Hapus Data"><i class="fa fa-trash"></i></a>
									<?php } ?>
									
									
								</td>
							</tr>
							<?php } ?>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Kelompok Pengguna</th>
								<th>Instansi</th>
								<th>Username</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Status</th>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>