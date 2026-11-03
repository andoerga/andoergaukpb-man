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
						<a class="btn btn-sm btn-rounded btn-primary btn-rounded" href="<?php echo site_url($module); ?>" role="button"><i class="fa fa-reply" title="Kembali"></i> Kembali</a>
					</div>
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							<button id="doProcess" class="btn btn-primary btn-lg">PROCESS</button>
						</div>
					</div>
					<div class="row">
						<div id="target-area" class="col-xs-12"></div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
<script>
var getIdUrl = '<?php echo site_url($module . '/unprocessed_ajax/'); ?>';
var processingUrl = '<?php echo site_url($module . '/process_ajax/'); ?>';
</script>