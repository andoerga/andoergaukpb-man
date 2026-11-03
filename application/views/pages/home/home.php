        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="info-box bg-aqua">
						<div class="info-box-content">
							<h1>Selamat Datang</h1>
							<h3><?php echo $this->config->item('APP_NAME'); ?></h3>
						</div>
						<!-- /.info-box-content -->
					</div>
				</div>
			</div>
			<div class="row">
				<?php /*
				<div class="col-xs-6 col-md-3">
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?php echo $data['pendaftar_ptp']; ?></h3>
							<p>Pendaftar Baru PTP</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
							<a href="#" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="small-box bg-light-blue">
						<div class="inner">
							<h3><?php echo $data['pendaftar_pamong_budaya']; ?></h3>
							<p>Pendaftar Baru Pamong Budaya</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
							<a href="#" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="small-box bg-teal">
						<div class="inner">
							<h3><?php echo $data['pendaftar_pamong_belajar']; ?></h3>
							<p>Pendaftar Baru Pamong Belajar</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="small-box bg-purple">
						<div class="inner">
							<h3><?php echo $data['pendaftar_penilik']; ?></h3>
							<p>Pendaftar Baru Penilik</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				*/ ?>
			</div>
		</section>
			<?php /*
			<div class="row">
			<?php if($berita_terbaru !== false){ ?>
				<div class="col-xs-12 <?php echo $berita_saya!==false ? 'col-md-6' : ''; ?>">
					<div class="box box-primary">
						<div class="box-header with-border row">
							<div class="col-xs-12">
								<h1>Berita Kontribusi Terbaru</h1>
							</div>
						</div>
						<div class="box-body row">
							<div class="col-xs-12">
								<?php if(count($berita_terbaru) > 0){ ?>
									<table id="table-kegiatan" class="table table-bordered table-hover serverside dataTable">
										<thead>
											<tr>
												<th class="title head" name="id">Id</th>
												<th class="title head searchable" name="user_name">Author</th>
												<th class="title head searchable" name="title">Judul</th>
												<th class="title head searchable" name="division_name">Unit Kerja</th>
												<th class="title head searchable" name="created">Dibuat</th>
												<th class="title head searchable" name="status">Status</th>
												<th class="title head"></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($berita_terbaru as $d){ ?>
											<tr>
												<td><?php echo $d->id; ?></td>
												<td><?php echo $d->user_name; ?></td>
												<td><?php echo $d->division_name; ?></td>
												<td><?php echo $d->title; ?></td>
												<td><?php echo $d->created; ?></td>
												<td><?php echo $d->status; ?></td>
												<td>
													<a class="btn btn-primary btn-detail" href="<?php echo site_url('berita/detail/'.$d->id); ?>" title="View Detail"><i class="fa fa-file"></i></a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
									<br />
									<a class="btn btn-primary" href="<?php echo site_url('berita'); ?>" title="Selengkapnya">Selengkapnya</a>
								<?php }else{ ?>
									<p>Belum ada berita kontribusi terbaru</p>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php if($berita_saya !== false){ ?>
				<div class="col-xs-12 <?php echo $berita_terbaru!==false ? 'col-md-6' : ''; ?>">
					<div class="box box-primary">
						<div class="box-header with-border row">
							<div class="col-xs-12">
								<h1>Berita Anda</h1>
							</div>
						</div>
						<div class="box-body row">
							<div class="col-xs-12">
								<?php if(count($berita_saya) > 0){ ?>
									<table id="table-kegiatan" class="table table-bordered table-hover serverside dataTable">
										<thead>
											<tr>
												<th class="title head" name="id">Id</th>
												<th class="title head searchable" name="title">Judul</th>
												<th class="title head searchable" name="created">Dibuat</th>
												<th class="title head searchable" name="status">Status</th>
												<th class="title head"></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($berita_saya as $d){ ?>
											<tr>
												<td><?php echo $d->id; ?></td>
												<td><?php echo $d->title; ?></td>
												<td><?php echo $d->created; ?></td>
												<td><?php echo $d->status; ?></td>
												<td>
													<a class="btn btn-primary btn-detail" href="<?php echo site_url('berita/detail/'.$d->id); ?>" title="View Detail"><i class="fa fa-file"></i></a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
									<br />
									<a class="btn btn-primary" href="<?php echo site_url('berita'); ?>" title="Selengkapnya">Selengkapnya</a>
								<?php }else{ ?>
									<div class="callout callout-info text-center">
										<h2>Anda belum membuat berita</h2>
										<a href="<?php echo site_url('berita/add'); ?>" class="btn btn-danger" role="button">Buat Berita Sekarang</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			
			</div>
			
			<?php if(count($berita_disetujui) < 1){ ?>
			<div class="row">
				<div class="col-xs-12">
					<div class="callout callout-danger">
						<h4>Belum ada berita yang disetujui</h4>
					</div>
				</div>
			</div>
			<?php }else{ ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="box box-primary">
							<div class="box-header row">
								<div class="col-xs-12">
									<h1>Hasil Kontribusi</h1>
								</div>
							</div>
							<div class="box-body row">
								<?php foreach($berita_disetujui as $d){ ?>
									<div class="col-xs-12 col-sm-6 col-md-3 data-kontribusi">
										<div class="box box-success">
											<div class="box-header row">
												<div class="col-xs-12">
													<h3><a href="<?php echo site_url('kontribusi/detail/'.$d->id); ?>"><?php echo $d->title; ?></a></h3>
													<p><?php echo $d->user_name; ?></p>
													<p><?php echo $d->division_name; ?></p>
													<p><?php echo date('d F Y H:i', strtotime($d->created)); ?></p>
												</div>
											</div>
											<div class="box-body row">
												<div class="col-xs-6 col-sm-12">
													<img src="<?php echo $d->image; ?>" class="img img-responsive img-thumbnail" />
												</div>
												<div class="col-xs-12 text-right">
													<br />
													<a href="<?php echo site_url('kontribusi/detail/'.$d->id); ?>" class="btn btn-sm btn-primary">Detail</a>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="box-footer">
								<a href="<?php echo site_url('kontribusi'); ?>" class="btn btn-primary" role="button">Selengkapnya</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					
				</div>
			<?php } ?>
			
			
        </section><!-- /.content -->
		*/ ?>