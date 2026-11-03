<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header row">
					<div class="col-xs-6">
						<h3 class="box-title">Daftar Soal <?php echo $module_object->name; ?></h3>
					</div>
					<div class="col-xs-6 text-right">
						<?php if($add_priv){ ?>
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" data-toggle="tooltip" data-placement="left" title="Buat <?php echo $module_object->name; ?> " href="<?php echo site_url($module . '/add'); ?>" role="button"><i class="fa fa-plus"></i></a>
						<?php } ?>
					</div>
				</div><!-- /.box-header -->
				<div class="box-tool row">
					<div class="col-xs-12">
						<form id="change-category" href="<?php echo site_url($module . '/index/'); ?>">
							<select name="category-id">
								<?php foreach($mata_ujian as $m){ ?>
								<option value="<?php echo $m->id; ?>" <?php echo $m->id == $category_id ? 'selected' : ''; ?>><?php echo $m->nama_ujian; ?></option>
								<?php } ?>
							</select>
						</form>
					</div>
				</div>
                <div class="box-body">
					<div class="row">
						<?php foreach($data as $d){ ?>
						<div class="col-xs-12">
							<p><?php echo $d->id; ?></p>
							<p>Tipe <?php echo $d->tipe_soal; ?></p>
							<p><?php echo $d->soal; ?></p>
							a). <?php echo $d->pil_1; ?>
							<br />
							b). <?php echo $d->pil_2; ?>
							<br />
							c). <?php echo $d->pil_3; ?>
							<br />
							d). <?php echo $d->pil_4; ?>
							<br />
							e). <?php echo $d->pil_5; ?>
							<br />
							<p>Kunci jawaban
							<?php switch($d->kunci){
								case 1 : echo 'A'; break;
								case 2 : echo 'B'; break;
								case 3 : echo 'C'; break;
								case 4 : echo 'D'; break;
								case 5 : echo 'E'; break;
							}
							?>
							</p>
							<hr />
						</div>
						<?php } ?>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>