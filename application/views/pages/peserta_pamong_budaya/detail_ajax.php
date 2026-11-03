<div class="row form-group">
	<div class="col-xs-12">
		<h4 class="text-center"><b>I. Data Pribadi</b></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Pas Foto 3x4</label>
			</div>
			<div class="col-md-8">
				<img src="<?php echo ASSET_PATH.'target/'.$data->foto; ?>" width="65" height="100" />
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Nama Lengkap</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->nama; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">NIP</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->nip; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Jenis Kelamin</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->gender == 'male' ? 'Laki-laki' : 'Perempuan'; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Email</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->username; ?>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-md-offset-1">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Tempat Lahir</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->tmp_lahir; ?>
			</div>
		</div>
		<div class="row form-group" style="margin-top: 20px;">
			<div class="col-md-4">
				<label for="inputName">Tanggal Lahir</label>
			</div>
			<div class="col-md-8">
				<?php echo date('d F Y', strtotime($data->tgl_lahir)); ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">No Handphone/Telepon</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->telepon_rumah; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Provinsi Tempat Tinggal</label>
			</div>
			<div class="col-md-8">
				<?php echo $provinsi->nama; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Kota/Kabupaten Tempat Tinggal</label>
			</div>
			<div class="col-md-8">
				<?php echo $kotkab->nama; ?>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Alamat Tempat Tinggal</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->alamat_rumah; ?>
			</div>
		</div>
	</div>
</div>
<hr />
<div class="row form-group">
	<div class="col-xs-12">
		<h4 class="text-center"><b>II. Data Pegawai</b></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">NIP</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->nip; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Golongan</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->pangkat; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Jabatan</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->perkerjaan; ?>
			</div>
		</div>
		<div class="row form-group" style="margin-top: 20px;">
			<div class="col-md-4">
				<label for="inputName">TMT Golongan</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->tmt_golongan; ?>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-md-offset-1">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Instansi/Lembaga</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->lembaga; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Unit Kerja</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->instansi; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Provinsi Unit Kerja</label>
			</div>
			<div class="col-md-8">
				<?php echo $provinsi_instansi->nama; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Kota/Kabupaten Unit Kerja</label>
			</div>
			<div class="col-md-8">
				<?php echo $kotkab_instansi->nama; ?>
			</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Alamat Unit Kerja</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->alamat_kantor; ?>
			</div>
		</div>
	</div>
</div>
<hr />
<div class="row form-group">
	<div class="col-xs-12">
		<h4 class="text-center"><b>III. Data Pendidikan Terakhir</b></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Jenjang Pendidikan</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->status_sarjana; ?>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Jurusan</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->jurusan_sarjana; ?>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-md-offset-1">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="inputName">Nama Perguruan Tinggi</label>
			</div>
			<div class="col-md-8">
				<?php echo $data->pt_sarjana; ?>
			</div>
		</div>
	<div class="row form-group">
		<div class="col-md-4">
			<label for="inputName">Tahun Lulusan</label>
		</div>
		<div class="col-md-8">
			<?php echo $data->lulus_sarjana; ?>
		</div>
	</div>
</div>
<hr />
<div class="row form-group">
	<div class="col-xs-12">
		<h4 class="text-center"><b>IV. Dokumen</b></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="inputName">Scan SK Kenaikan Pangkat Terakhir</label>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-primary view-file" name="button" data-title="Scan SK Kenaikan Pangkat Terakhir" data-target="<?php echo ASSET_PATH.'target/'.$data->SK_pangkat; ?>">Lihat Berkas</button>
				<a type="button" target="_blank" href="<?php echo ASSET_PATH.'target/'.$data->SK_pangkat; ?>" class="btn btn-success" name="button">Unduh</a>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="inputName">Scan SK Jabatan Terakhir</label>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-primary view-file" name="button" data-title="Scan SK Jabatan Terakhir" data-target="<?php echo ASSET_PATH.'target/'.$data->SK_jabatan; ?>">Lihat Berkas</button>
				<a type="button" target="_blank" href="<?php echo ASSET_PATH.'target/'.$data->SK_jabatan; ?>" class="btn btn-success" name="button">Unduh</a>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="inputName">Scan Ijazah Terakhir</label>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-primary view-file" name="button" data-title="Scan Ijazah Terakhir" data-target="<?php echo ASSET_PATH.'target/'.$data->ijazah_s; ?>">Lihat Berkas</button>
				<a type="button" target="_blank" href="<?php echo ASSET_PATH.'target/'.$data->ijazah_s; ?>" class="btn btn-success" name="button">Unduh</a>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="inputName">Surat Usulan dari Pejabat Berwenang</label>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-primary view-file" name="button" data-title="Surat Usulan dari Pejabat Berwenang" data-target="<?php echo ASSET_PATH.'target/'.$data->surat_usulan; ?>">Lihat Berkas</button>
				<a type="button" target="_blank" href="<?php echo ASSET_PATH.'target/'.$data->surat_usulan; ?>" class="btn btn-success" name="button">Unduh</a>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="inputName">Surat pernyataan telah melaksanakan kegiatan di bidang nilai budaya, kesejarahan, kesenian, permuseuman, kepurbakalaan atau kebahsaan selama 2 tahun</label>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-primary view-file" name="button" data-title="Surat pernyataan telah melaksanakan kegiatan di bidang nilai budaya, kesejarahan, kesenian, permuseuman, kepurbakalaan atau kebahsaan selama 2 tahun" data-target="<?php echo ASSET_PATH.'target/'.$data->surat_pernyataan; ?>">Lihat Berkas</button>
				<a type="button" target="_blank" href="<?php echo ASSET_PATH.'target/'.$data->surat_pernyataan; ?>" class="btn btn-success" name="button">Unduh</a>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="inputName">Surat pernyataan komitmen untuk melaksanakan kegiatan di bidang nilai budaya, kesejarahan, kesenian, permuseuman, kepurbakalaan atau kebahasaan </label>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-primary view-file" name="button" data-title="Surat pernyataan komitmen untuk melaksanakan kegiatan di bidang nilai budaya, kesejarahan, kesenian, permuseuman, kepurbakalaan atau kebahasaan" data-target="<?php echo ASSET_PATH.'target/'.$data->surat_komitmen; ?>">Lihat Berkas</button>
				<a type="button" target="_blank" href="<?php echo ASSET_PATH.'target/'.$data->surat_komitmen; ?>" class="btn btn-success" name="button">Unduh</a>
			</div>
		</div>
	</div>
</div>

<div class="row form-group">
	<div class="col-xs-12 col-sm-6 col-sm-push-6 col-md-3 col-md-push-9 text-right">
		<strong>Tingkatan inpassing : </strong>
		<select id="status_inpassing" name="status_inpassing_id" class="form-control">
			<?php foreach($status_inpassing as $s){ ?>
				<option value="<?php echo $s->id; ?>"><?php echo $s->name; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-xs-12 text-right">
		<a class="btn btn-danger btn-process" data-action-after="close" data-href="<?php echo site_url($module . '/process/cancel/' . $data->id); ?>" href="#" title="Tolak"><i class="fa fa-remove">Batalkan</i></a>&nbsp;
	</div>
</div>