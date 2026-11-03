<!-- Main content -->
<script>
var userMap = <?php echo json_encode($user); ?>;
var userMap2 = <?php echo json_encode($userMap); ?>;
var jenisPeserta = '<?php echo $jenis_peserta; ?>';
</script>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-xs-6">
						<h3 class="box-title">Daftar Peserta <?php echo $module_object->name; ?> <?php echo $data->name; ?></h3>
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
				</div>
				<form role="form" class="theForm" action="<?php echo site_url($module . '/peserta_process/' . $data->id); ?>" method="post">
					<div class="box-body">
						<div class="form-group row">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Jenis Peserta</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<select name="jenis_peserta_id" class="form-control" id="inputJenisPeserta">
									<?php echo $jenis_peserta; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-6 col-md-4">
								<label for="inputName">Masukkan Nama Peserta</label>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<input name="peserta_label" type="text" class="form-control" placeholder="nama peserta" id="inputNamaPeserta" />
								<input name="peserta_id" type="hidden" class="form-control" placeholder="nama peserta" id="inputNamaPesertaId" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-6 col-md-4">
								
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<button type="submit" class="btn btn-primary" name="form-submit" value="1">Submit</button>
							</div>
						</div>
					</div>
				</form>
				<div class="box-body">
					<table id="tablePeserta" class="table table-bordered table-hover" data-edit-url="<?php echo site_url('kegiatan/edit_peserta/'); ?>" data-delete-url="<?php echo site_url('kegiatan/delete_peserta/'.$data->id.'/'); ?>">
						<tr>
							<th>Nama</th>
							<th>Jenis Peserta</th>
							<th>Aksi</th>
						</tr>
						<?php if(count($peserta) > 0){ ?>
						<?php foreach($peserta as $p){ ?>
							<tr class="theRow" data-id="<?php echo $p->id; ?>">
								<td data-user-id="<?php echo $p->peserta_id; ?>"><?php echo $p->name; ?></td>
								<td class="jenis-peserta" data-jenis-peserta-id="<?php echo $p->jenis_peserta_id; ?>" style="cursor:pointer;"><?php echo $p->jenis_peserta; ?></td>
								<td><a type="button" class="btn btn-sm btn-primary btn-delete" data-peserta-id="<?php echo $p->peserta_id; ?>"><i class="fa fa-close"></i></a></td>
							</tr>
						<?php } ?>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>